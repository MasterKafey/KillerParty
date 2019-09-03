<?php

namespace AppBundle\Entity;

/**
 * Clue
 */
class Clue
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var boolean
     */
    private $displayed = false;

    /**
     * @var Trial
     */
    private $trial;

    /**
     * @var Player
     */
    private $creator;


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
     * Set text
     *
     * @param string $text
     *
     * @return Clue
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
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
     * Set trial
     *
     * @param Trial $trial
     * @return Clue
     */
    public function setTrial($trial)
    {
        $this->trial = $trial;

        return $this;
    }

    /**
     * Get displayed.
     *
     * @return bool
     */
    public function getDisplayed()
    {
        return $this->displayed;
    }

    /**
     * Set displayed.
     *
     * @param boolean $displayed
     * @return Clue
     */
    public function setDisplayed($displayed)
    {
        $this->displayed = $displayed;

        return $this;
    }

    /**
     * Get creator.
     *
     * @return Player
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set creator.
     *
     * @param Player $creator
     *
     * @return Clue
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;

        return $this;
    }
}

