<?php

namespace AppBundle\Controller\Trial;


use AppBundle\Entity\Contract;
use AppBundle\Entity\Party;
use AppBundle\Entity\Trial;
use AppBundle\Form\Type\Trial\Creation\CreateTrialType;
use AppBundle\Service\Messenger\Trial\Creation\CreateTrialMessenger;
use AppBundle\Service\Util\Console\Console;
use AppBundle\Service\Util\Console\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createTrialAction(Request $request, Party $party, Console $console, CreateTrialMessenger $messenger)
    {
        $trials = $this->getDoctrine()->getRepository(Trial::class)->getCurrentTrials($party);

        if(count($trials) !== 0) {
            $console->add('Un procès est déjà en cours', Message::TYPE_WARNING);
            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }

        $trial = new Trial();
        $contracts = array();
        foreach ($party->getPlayers() as $player) {
            foreach ($player->getContracts() as $contract) {
                if ($contract->getCompleted() && $contract->getTrial() === null) {
                    $contracts[] = $contract;
                }
            }
        }

        if(count($contracts) === 0) {
            $console->add('Aucun contrat n\'a encore été validé', Message::TYPE_WARNING);
            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }

        $form = $this->createForm(CreateTrialType::class, $trial, array(
            'contracts' => $contracts,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trial);
            $em->flush();
            $messenger->sendCreationTrialMessage($trial);

            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }

        return $this->render('@Page/Trial/Creation/create_trial.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
