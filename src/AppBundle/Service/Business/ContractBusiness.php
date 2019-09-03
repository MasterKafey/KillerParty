<?php

namespace AppBundle\Service\Business;

use AppBundle\Entity\Contract;
use AppBundle\Entity\Party;
use AppBundle\Entity\Player;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ContractBusiness
{
    private $registry;

    public function __construct(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    public function getCurrentContract(Player $player)
    {
        foreach ($player->getContracts() as $contract) {
            if (!$contract->getCompleted() && !$contract->getCancelled()) {
                return $contract;
            }
        }
    }

    public function getMurdererContract(Player $target)
    {
        return $this->registry->getRepository(Contract::class)->findOneBy(array(
            'target' => $target,
            'completed' => true,
        ));
    }

    public function getSubmittedContracts(Party $party)
    {
        $players = $party->getPlayers();
        $contracts = array();

        foreach ($players as $player) {
            foreach ($player->getContracts() as $contract) {
                if($contract->getSubmitted() && !$contract->getCancelled() && !$contract->getCompleted()) {
                    $contracts[] = $contract;
                }
            }
        }

        return $contracts;
    }

    public function getNextContract(Contract $contract)
    {
        $target = $contract->getTarget();
        $owner = $contract->getOwner();
        $contractToSwitch = $this->getCurrentContract($target);
        $nextContract = new Contract();
        $nextContract
            ->setOwner($owner)
            ->setTarget($contractToSwitch->getTarget())
            ->setKillerCard($contractToSwitch->getKillerCard())
        ;

        return $nextContract;
    }
}
