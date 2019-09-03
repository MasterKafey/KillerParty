<?php

namespace AppBundle\Service\Messenger\Contract\Completting;

use AppBundle\Entity\Contract;
use AppBundle\Service\Messenger\AbstractMessenger;

class CompletedContractMessenger extends AbstractMessenger
{
    public function sendCompletedContract(Contract $contract)
    {
        $this->send($contract->getOwner()->getUser()->getPhoneNumber(), '@Message/Contract/Completing/completed_contract.html.twig', array(
            'contract' => $contract,
        ));
    }
}
