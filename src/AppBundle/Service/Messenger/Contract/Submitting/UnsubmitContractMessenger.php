<?php

namespace AppBundle\Service\Messenger\Contract\Submitting;


use AppBundle\Entity\Contract;
use AppBundle\Service\Messenger\AbstractMessenger;

class UnsubmitContractMessenger extends AbstractMessenger
{
    public function sendUnsubmittedContract(Contract $contract)
    {
        $this->send($contract->getOwner()->getUser()->getPhoneNumber(), '@Message/Contract/Submitting/unsubmit_contract.html.twig', array(
            'contract' => $contract,
        ));
    }
}
