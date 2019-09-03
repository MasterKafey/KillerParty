<?php

namespace AppBundle\Controller\Party;

use AppBundle\Entity\Party;
use AppBundle\Entity\Player;
use AppBundle\Form\Type\Party\Creation\CreatePartyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createPartyAction(Request $request)
    {
        $party = new Party();
        $player = new Player();

        $player
            ->setUser($this->getUser())
            ->setGameMaster(true)
            ->setParty($party)
        ;
        $party->addPlayer($player);

        $form = $this->createForm(CreatePartyType::class, $party);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($party);
            $em->flush();
            return $this->redirectToRoute('app_party_listing_list_party');
        }

        return $this->render('@Page/Party/Creation/create_party.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}