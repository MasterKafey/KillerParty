<?php


namespace AppBundle\Service\Messenger\Player\Killing;


use AppBundle\Entity\Player;
use AppBundle\Service\Messenger\AbstractMessenger;

class KillPlayerMessenger extends AbstractMessenger
{
    public function sendKillPlayerMessage(Player $target, Player $murderer)
    {
        $this->send($target->getUser()->getPhoneNumber(), "@Message/Player/Killing/target_killed.html.twig", array(
            'target' => $target,
            'murderer' => $murderer,
            'party' => $murderer->getParty(),
        ));

        if(!$murderer->getGameMaster()) {
            $this->send($murderer->getUser()->getPhoneNumber(), "@Message/Player/Killing/murderer_killing.html.twig", array(
                'target' => $target,
                'murderer' => $murderer,
                'party' => $murderer->getParty(),
            ));
        }
    }
}