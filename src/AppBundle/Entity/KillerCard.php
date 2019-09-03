<?php

namespace AppBundle\Entity;

/**
 * KillerCard
 */
class KillerCard
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $place;

    /**
     * @var string
     */
    private $weapon;

    /**
     * @var string
     */
    private $objective;

    /**
     * @var CardType
     */
    private $type;


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
     * Set title
     *
     * @param string $title
     *
     * @return KillerCard
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set place
     *
     * @param string $place
     *
     * @return KillerCard
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set weapon
     *
     * @param string $weapon
     *
     * @return KillerCard
     */
    public function setWeapon($weapon)
    {
        $this->weapon = $weapon;

        return $this;
    }

    /**
     * Get weapon
     *
     * @return string
     */
    public function getWeapon()
    {
        return $this->weapon;
    }

    /**
     * Set objective
     *
     * @param string $objective
     *
     * @return KillerCard
     */
    public function setObjective($objective)
    {
        $this->objective = $objective;

        return $this;
    }

    /**
     * Get objective
     *
     * @return string
     */
    public function getObjective()
    {
        return $this->objective;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return CardType
     */
    public function getType()
    {
        return $this->type;
    }
}

