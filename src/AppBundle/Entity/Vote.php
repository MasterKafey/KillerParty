<?php

namespace AppBundle\Entity;

/**
 * Vote
 */
class Vote
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Player
     */
    private $owner;

    /**
     * @var Trial
     */
    private $trial;

    /**
     * @var Player
     */
    private $target;

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
     * Get owner.
     *
     * @return Player
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set owner.
     *
     * @param Player $owner
     *
     * @return Vote
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Get trial.
     *
     * @return Trial
     */
    public function getTrial()
    {
        return $this->trial;
    }

    /**
     * Set trial.
     *
     * @param Trial $trial
     *
     * @return Vote
     */
    public function setTrial($trial)
    {
        $this->trial = $trial;
        return $this;
    }

    /**
     * Get target.
     *
     * @return Player
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set target.
     *
     * @param Player $target
     *
     * @return Vote
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }
}

