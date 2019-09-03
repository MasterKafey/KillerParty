<?php

namespace AppBundle\Controller\KillerCard;

use AppBundle\Entity\KillerCard;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowingController extends Controller
{
    public function showKillerCardAction(KillerCard $killerCard)
    {
        return $this->render('@Page/KillerCard/Showing/show_killer_card.html.twig', array(
            'killer_card' => $killerCard,
        ));
    }
}