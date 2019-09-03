<?php

namespace AppBundle\Controller\Party;

use AppBundle\Entity\Party;
use AppBundle\Entity\Player;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListingController extends Controller
{
    public function listPartyAction()
    {
        $parties = $this->getDoctrine()->getRepository(Party::class)->findAll();

        return $this->render('@Page/Party/Listing/list_party.html.twig', array(
            'parties' => $parties,
        ));
    }

    public function listPersonalPartyAction()
    {
        $players = $this->getDoctrine()->getRepository(Player::class)->findBy(array(
            'isGameMaster' => true,
            'user' => $this->getUser(),
        ));
        $parties = array();

        foreach($players as $player)
        {
            $parties[] = $player->getParty();
        }

        return $this->render('@Page/Party/Listing/list_party.html.twig', array(
            'parties' => $parties,
        ));
    }
}