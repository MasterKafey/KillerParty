<?php

namespace AppBundle\Service\Messenger\Trial\Creation;


use AppBundle\Entity\Trial;
use AppBundle\Service\API\PushBulletAPI;
use AppBundle\Service\Business\PlayerBusiness;
use AppBundle\Service\Messenger\AbstractMessenger;

class CreateTrialMessenger extends AbstractMessenger
{
    private $playerBusiness;

    public function __construct(PushBulletAPI $pushBulletAPI, \Twig_Environment $twig, PlayerBusiness $playerBusiness)
    {
        parent::__construct($pushBulletAPI, $twig);
        $this->playerBusiness = $playerBusiness;
    }

    public function sendCreationTrialMessage(Trial $trial)
    {
        foreach($trial->getContract()->getOwner()->getParty()->getPlayers() as $player) {
            if($this->playerBusiness->isPlayerDead($player)) {
                continue;
            }

            $this->send($player->getUser()->getPhoneNumber(), '@Message/Trial/Creation/create_trial.html.twig', array(
                'trial' => $trial,
            ));
        }
    }
}
