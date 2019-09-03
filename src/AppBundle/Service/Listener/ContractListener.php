<?php

namespace AppBundle\Service\Listener;


use AppBundle\Entity\Contract;
use AppBundle\Service\Business\PartyBusiness;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ContractListener
{
    /**
     * @var PartyBusiness
     */
    private $partyBusiness;

    public function __construct(PartyBusiness $partyBusiness)
    {
        $this->partyBusiness = $partyBusiness;
    }

    public function prePersist(Contract $contract, LifecycleEventArgs $args)
    {
        $this->updateParty($contract, $args);
    }

    public function preUpdate(Contract $contract, LifecycleEventArgs $args)
    {
        $this->updateParty($contract, $args);
    }

    protected function updateParty(Contract $contract, LifecycleEventArgs $args)
    {
        $party = $contract->getOwner()->getParty();
        if ($this->partyBusiness->isPartyOver($contract->getOwner()->getParty())) {
            $party->setEndingDate(new \DateTime());
            $args->getEntityManager()->persist($party);
        }
    }
}
