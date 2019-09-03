<?php

namespace AppBundle\Controller\CardType;

use AppBundle\Entity\CardType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowingController extends Controller
{
    public function showCardTypeAction(CardType $cardType)
    {
        return $this->render('@Page/CardType/Showing/show_card_type.html.twig', array(
            'card_type' => $cardType,
        ));
    }
}