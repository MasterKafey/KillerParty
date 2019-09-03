<?php

namespace AppBundle\Controller\Party;

use AppBundle\Entity\Party;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeletionController extends Controller
{
    public function deletePartyAction(Party $party)
    {
        $em = $this->getDoctrine()->getManager();
        foreach ($party->getPlayers() as $player) {
            $em->remove($player);
        }
        $em->flush();
        $em->remove($party);
        $em->flush();

        return $this->redirectToRoute('app_party_listing_list_party');
    }
}