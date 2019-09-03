<?php

namespace AppBundle\Service\Business;

use AppBundle\Entity\Contract;
use AppBundle\Entity\KillerCard;
use AppBundle\Entity\Party;
use AppBundle\Entity\Player;
use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PartyBusiness
{
    private $registry;

    private $playerBusiness;

    public function __construct(RegistryInterface $registry, PlayerBusiness $playerBusiness)
    {
        $this->registry = $registry;
        $this->playerBusiness = $playerBusiness;
    }

    public function isUserOwner(Party $party, User $user)
    {
        $player = $this->getUserPlayer($party, $user);
        if (null !== $player) {
            return $player->getGameMaster();
        }
        return false;
    }

    public function getUserPlayer(Party $party, User $user)
    {
        return $this->registry->getRepository(Player::class)->findOneBy(array(
            'party' => $party,
            'user' => $user,
        ));
    }

    public function startParty(Party $party)
    {
        $players = $this->registry->getRepository(Player::class)->findBy(array(
            'party' => $party,
            'isGameMaster' => false,
        ));
        $cardTypes = $party->getCardTypes();
        $cards = array();
        foreach ($cardTypes as $type) {
            $cards = array_merge($cards, $this->registry->getRepository(KillerCard::class)->findBy(array('type' => $type)));
        }

        shuffle($players);
        shuffle($cards);
        $em = $this->registry->getManager();

        for ($i = 0; $i < count($players); ++$i) {
            $contract = new Contract();
            if ($i + 1 === count($players)) {
                $target = $players[0];
            } else {
                $target = $players[$i + 1];
            }
            $card = array_pop($cards);
            $contract
                ->setTarget($target)
                ->setOwner($players[$i])
                ->setKillerCard($card);
            $em->persist($contract);
        }

        $party->setStarted(true);
        $em->persist($party);
        $em->flush();
    }

    public function isPartyOver(Party $party)
    {
        $players = $party->getPlayers();
        $playerAlive = 0;
        foreach ($players as $player) {
            if (!$this->playerBusiness->isPlayerDead($player) and !$player->getGameMaster()) {
                ++$playerAlive;
            }
        }

        return $playerAlive < 2;
    }

    public function getGameMaster(Party $party)
    {
        return $this->registry->getRepository(Player::class)->findOneBy(array(
            'party' => $party,
            'isGameMaster' => true,
        ));
    }
}
