<?php

namespace AppBundle\Controller\CardType;

use AppBundle\Entity\CardType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeletionController extends Controller
{
    public function deleteCardTypeAction(CardType $cardType)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($cardType);
        $em->flush();

        return $this->redirectToRoute('app_card_type_listing_list_card_type');
    }
}