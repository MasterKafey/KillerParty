<?php

namespace AppBundle\Controller\KillerCard;

use AppBundle\Entity\KillerCard;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeletionController extends Controller
{
    public function deleteKillerCardAction(KillerCard $killerCard)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($killerCard);
        $em->flush();

        return $this->redirectToRoute('app_killer_card_listing_list_killer_card');
    }
}