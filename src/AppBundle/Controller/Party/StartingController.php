<?php

namespace AppBundle\Controller\Party;


use AppBundle\Entity\Party;
use AppBundle\Service\Business\PartyBusiness;
use AppBundle\Service\Messenger\Party\Starting\PartyStartedMessenger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StartingController extends Controller
{
    public function startPartyAction(Party $party, PartyBusiness $business, PartyStartedMessenger $messenger)
    {

        if ($business->isUserOwner($party, $this->getUser()) && !$party->getStarted()) {
            $business->startParty($party);
            $em = $this->getDoctrine()->getManager();
            $em->persist($party);
            $em->flush();
            foreach ($party->getPlayers() as $player) {
                if(!$player->getGameMaster()) {
                    $messenger->sendPartyStartedMessage($player);
                }
            }
        }


        return $this->redirectToRoute('app_party_showing_show_party', array(
            'id' => $party->getId(),
        ));
    }
}
