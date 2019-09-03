<?php

namespace AppBundle\Entity;

/**
 * Player
 */
class Player
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Party
     */
    private $party;

    /**
     * @var boolean
     */
    private $isGameMaster = false;

    /**
     * @var Contract[]
     */
    private $contracts;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user.
     *
     * @param User $user
     * @return Player
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get party.
     *
     * @return Party
     */
    public function getParty()
    {
        return $this->party;
    }

    /**
     * Set party
     *
     * @param Party $party
     * @return Player
     */
    public function setParty($party)
    {
        $this->party = $party;

        return $this;
    }

    /**
     * Set game master.
     *
     * @param boolean $isGameMaster
     * @return Player
     */
    public function setGameMaster($isGameMaster)
    {
        $this->isGameMaster = $isGameMaster;

        return $this;
    }

    /**
     * Get game master.
     *
     * @return bool
     */
    public function getGameMaster()
    {
        return $this->isGameMaster;
    }

    /**
     * Set contracts.
     *
     * @param Contract[] $contracts
     *
     * @return Player
     */
    public function setContracts($contracts)
    {
        $this->contracts = $contracts;

        return $this;
    }

    /**
     * Get contracts.
     *
     * Get contracts.
     *
     * @return Contract[]
     */
    public function getContracts()
    {
        return $this->contracts;
    }

    /**
     * Add contracts.
     *
     * @param Contract $contract
     * @return Player
     */
    public function addContract(Contract $contract)
    {
        $this->contracts[] = $contract;

        return $this;
    }
}