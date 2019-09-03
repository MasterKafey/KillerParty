<?php

namespace AppBundle\Resources\views\Message;

use AppBundle\Entity\Clue;
use AppBundle\Service\API\PushBulletAPI;
use AppBundle\Service\Business\PlayerBusiness;
use AppBundle\Service\Messenger\AbstractMessenger;

class DisplayedClueMessenger extends AbstractMessenger
{
    private $playerBusiness;

    public function __construct(PushBulletAPI $pushBulletAPI, \Twig_Environment $twig, PlayerBusiness $playerBusiness)
    {
        parent::__construct($pushBulletAPI, $twig);
        $this->playerBusiness = $playerBusiness;
    }

    public function sendDisplayedClueMessage(Clue $clue)
    {
        foreach($clue->getTrial()->getContract()->getOwner()->getParty()->getPlayers() as $player) {
            if($this->playerBusiness->isPlayerDead($player)) {
                continue;
            }

            $this->send($player->getUser()->getPhoneNumber(), '@Message/Clue/Displaying/displayed_clue.html.twig', array(
                'clue' => $clue,
            ));
        }
    }
}
