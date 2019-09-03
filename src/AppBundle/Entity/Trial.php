<?php

namespace AppBundle\Entity;

/**
 * Trial
 */
class Trial
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Contract
     */
    private $contract;

    /**
     * @var Clue[]
     */
    private $clues;

    /**
     * @var Vote[]
     */
    private $votes;

    /**
     * @var boolean
     */
    private $completed = false;

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
     * Set contract.
     *
     * @param Contract $contract
     * @return Trial
     */
    public function setContract($contract)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * Get contract.
     *
     * @return Contract
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set clues.
     *
     * @param Clue[] $clues
     * @return Trial
     */
    public function setClues($clues)
    {
        $this->clues = $clues;

        return $this;
    }

    /**
     * Get clues.
     *
     * @return Clue[]
     */
    public function getClues()
    {
        return $this->clues;
    }

    /**
     * Get votes.
     *
     * @return Vote[]
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * Set votes.
     *
     * @param Vote $votes
     * @return Trial
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;

        return $this;
    }

    /**
     * Add vote.
     *
     * @param Vote $vote
     * @return Trial
     */
    public function addVote($vote)
    {
        $this->votes[] = $vote;

        return $this;
    }

    /**
     * Get completed.
     *
     * @return bool
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set completed.
     *
     * @param boolean $completed
     * @return Trial
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }
}

