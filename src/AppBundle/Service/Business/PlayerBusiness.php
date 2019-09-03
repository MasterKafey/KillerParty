<?php

namespace AppBundle\Service\Business;

use AppBundle\Entity\Contract;
use AppBundle\Entity\Player;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PlayerBusiness
{
    /**
     * @var RegistryInterface
     */
    private $registry;

    /**
     * @var ContractBusiness
     */
    private $contractBusiness;

    public function __construct(RegistryInterface $registry, ContractBusiness $contractBusiness)
    {
        $this->registry = $registry;
        $this->contractBusiness = $contractBusiness;
    }

    public function killPlayerByGameMaster(Player $player)
    {
        $party = $player->getParty();
        $gameMaster = $this->registry->getRepository(Player::class)->findOneBy(array(
            'party' => $party,
            'isGameMaster' => true,
        ));

        $murdererContract = $this->registry->getRepository(Contract::class)->findOneBy(array(
            'target' => $player,
            'completed' => false,
            'cancelled' => false,
        ));
        $targetContract = $this->contractBusiness->getCurrentContract($player);
        $targetContract->setCancelled(true);


        $contract = new Contract();
        $contract
            ->setOwner($gameMaster)
            ->setTarget($player)
            ->setSubmitted(true)
            ->setCompleted(true);

        $em = $this->registry->getManager();
        $em->persist($contract);
        $em->persist($targetContract);
        if ($murdererContract) {
            $murdererContract->setCancelled(true);
            $em->persist($murdererContract);
            if ($murdererContract->getOwner() !== $targetContract->getTarget()) {
                $newMurdererContract = new Contract();
                $newMurdererContract
                    ->setOwner($murdererContract->getOwner())
                    ->setTarget($targetContract->getTarget())
                    ->setKillerCard($targetContract->getKillerCard());
                $em->persist($newMurdererContract);
            }
        }
        $em->flush();

    }

    public function isPlayerDead(Player $player)
    {
        $contract = $this->registry->getRepository(Contract::class)->findOneBy(array(
            'target' => $player,
            'completed' => true,
        ));

        return null !== $contract;
    }

}
