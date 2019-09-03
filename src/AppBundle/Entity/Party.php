<?php

namespace AppBundle\Entity;


/**
 * Party
 */
class Party
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var CardType[]
     */
    private $cardTypes;

    /**
     * @var Player[]
     */
    private $players;

    /**
     * @var \DateTime
     */
    private $creationDate;

    /**
     * @var boolean
     */
    private $started = false;

    public function __construct()
    {
        $this->creationDate = new \DateTime();
    }


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
     * Set name
     *
     * @param string $name
     *
     * @return Party
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set card types.
     *
     * @param CardType[] $cardTypes
     * @return Party
     */
    public function setCardTypes($cardTypes)
    {
        $this->cardTypes = $cardTypes;

        return $this;
    }

    /**
     * Get card types.
     *
     * @return CardType[]
     */
    public function getCardTypes()
    {
        return $this->cardTypes;
    }

    /**
     * Set players.
     *
     * @param Player[] $players
     * @return Party
     */
    public function setPlayers($players)
    {
        $this->players = $players;

        return $this;
    }

    /**
     * Get players.
     *
     * @return Player[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Add player.
     *
     * @param Player $player
     * @return Party
     */
    public function addPlayer($player)
    {
        $this->players[] = $player;
        return $this;
    }

    /**
     * Set creation date.
     *
     * @param \DateTime $creationDate
     * @return Party
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creation date.
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Get started.
     *
     * @return bool
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set started.
     *
     * @param bool $started
     * @return Party
     */
    public function setStarted($started)
    {
        $this->started = $started;

        return $this;
    }
}