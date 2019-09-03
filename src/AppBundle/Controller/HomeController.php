<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Player;
use AppBundle\Service\Business\PartyBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction(PartyBusiness $business)
    {
        $players = $this->getDoctrine()->getRepository(Player::class)->findBy(array(
            'user' => $this->getUser(),
        ));

        $parties = array();
        foreach ($players as $player) {
            $party = $player->getParty();
            if ($party->getStarted() && !$business->isPartyOver($party)) {
                $parties[] = $party;
            }
        }

        return $this->render('@Page/Home/index.html.twig', array(
            'parties' => $parties,
        ));
    }
}
