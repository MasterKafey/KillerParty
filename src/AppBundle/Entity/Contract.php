<?php

namespace AppBundle\Entity;

/**
 * Contract
 */
class Contract
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
     * @var Player
     */
    private $target;

    /**
     * @var KillerCard
     */
    private $killerCard;

    /**
     * @var boolean
     */
    private $submitted = false;

    /**
     * @var boolean
     */
    private $completed = false;

    /**
     * @var boolean
     */
    private $cancelled = false;

    /**
     * @var Trial
     */
    private $trial;

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
     * Set owner.
     *
     * @param Player $owner
     *
     * @return Contract
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
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
     * Set target.
     *
     * @param Player $target
     *
     * @return Contract
     */
    public function setTarget($target)
    {
        $this->target = $target;

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
     * Set killer card.
     *
     * @param KillerCard $killerCard
     *
     * @return Contract
     */
    public function setKillerCard($killerCard)
    {
        $this->killerCard = $killerCard;

        return $this;
    }

    /**
     * Get killer card.
     *
     * @return KillerCard
     */
    public function getKillerCard()
    {
        return $this->killerCard;
    }

    /**
     * Set completed.
     *
     * @param bool $completed
     *
     * @return Contract
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

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
     * Set submitted.
     *
     * @param bool $submitted
     *
     * @return Contract
     */
    public function setSubmitted($submitted)
    {
        $this->submitted = $submitted;

        return $this;
    }

    /**
     * Get submitted.
     *
     * @return bool
     */
    public function getSubmitted()
    {
        return $this->submitted;
    }

    /**
     * Set cancelled.
     *
     * @param boolean $cancelled
     * @return Contract
     */
    public function setCancelled($cancelled)
    {
        $this->cancelled = $cancelled;

        return $this;
    }

    /**
     * Get cancelled.
     *
     * @return boolean
     */
    public function getCancelled()
    {
        return $this->cancelled;
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
     * @return Contract
     */
    public function setTrial($trial)
    {
        $this->trial = $trial;

        return $this;
    }
}