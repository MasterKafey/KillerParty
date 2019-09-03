<?php

namespace AppBundle\Controller\KillerCard;

use AppBundle\Entity\KillerCard;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListingController extends Controller
{
    public function listKillerCardAction()
    {
        $killerCards = $this->getDoctrine()->getRepository(KillerCard::class)->findAll();

        return $this->render('@Page/KillerCard/Listing/list_killer_card.html.twig', array(
            'killer_cards' => $killerCards,
        ));
    }
}