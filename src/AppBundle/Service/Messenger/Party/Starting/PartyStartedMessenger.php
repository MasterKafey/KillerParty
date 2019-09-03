<?php

namespace AppBundle\Service\Messenger\Party\Starting;


use AppBundle\Entity\Player;
use AppBundle\Service\Messenger\AbstractMessenger;

class PartyStartedMessenger extends AbstractMessenger
{
    public function sendPartyStartedMessage(Player $player)
    {
        $this->send($player->getUser()->getPhoneNumber(), "@Message/Party/Started/party_started.html.twig", array(
            'party' => $player->getParty(),
        ));
    }
}
