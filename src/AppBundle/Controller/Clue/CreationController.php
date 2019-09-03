<?php

namespace AppBundle\Controller\Clue;

use AppBundle\Entity\Clue;
use AppBundle\Entity\Trial;
use AppBundle\Form\Type\Clue\Creation\CreateClueType;
use AppBundle\Service\Business\PartyBusiness;
use AppBundle\Service\Business\PlayerBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createClueAction(Request $request, Trial $trial, PartyBusiness $partyBusiness, PlayerBusiness $playerBusiness)
    {
        $party = $trial->getContract()->getOwner()->getParty();
        $player = $partyBusiness->getUserPlayer($party, $this->getUser());
        if($playerBusiness->isPlayerDead($player)) {
            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }
        $clue = new Clue();
        $form = $this->createForm(CreateClueType::class, $clue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clue
                ->setTrial($trial)
                ->setCreator($partyBusiness->getUserPlayer($party, $this->getUser()))
            ;
            $em = $this->getDoctrine()->getManager();
            $em->persist($clue);
            $em->flush();

            return $this->redirectToRoute('app_party_showing_show_party', array(
                'id' => $party->getId(),
            ));
        }

        return $this->render('@Page/Clue/Creation/create_clue.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}
