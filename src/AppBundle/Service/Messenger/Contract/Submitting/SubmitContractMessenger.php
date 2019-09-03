<?php

namespace AppBundle\Service\Messenger\Contract\Submitting;


use AppBundle\Entity\Contract;
use AppBundle\Service\API\PushBulletAPI;
use AppBundle\Service\Business\PartyBusiness;
use AppBundle\Service\Messenger\AbstractMessenger;

class SubmitContractMessenger extends AbstractMessenger
{
    private $partyBusiness;

    public function __construct(PushBulletAPI $pushBulletAPI, \Twig_Environment $twig, PartyBusiness $partyBusiness)
    {
        parent::__construct($pushBulletAPI, $twig);
        $this->partyBusiness = $partyBusiness;
    }

    public function sendSubmittedContract(Contract $contract)
    {
        $gameMaster = $this->partyBusiness->getGameMaster($contract->getOwner()->getParty());
        $this->send($gameMaster->getUser()->getPhoneNumber(), '@Message/Contract/Submitting/submit_contract.html.twig', array(
            'contract' => $contract,
        ));
    }
}
