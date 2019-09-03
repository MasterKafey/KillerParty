<?php

namespace AppBundle\Controller\CardType;

use AppBundle\Entity\CardType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListingController extends Controller
{
    public function listCardTypeAction()
    {
        $cardTypes = $this->getDoctrine()->getRepository(CardType::class)->findAll();

        return $this->render('@Page/CardType/Listing/list_card_type.html.twig', array(
            'card_types' => $cardTypes,
        ));
    }
}