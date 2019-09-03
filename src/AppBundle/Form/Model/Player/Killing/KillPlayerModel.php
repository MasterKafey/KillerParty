<?php

namespace AppBundle\Form\Model\Player\Killing;


use AppBundle\Entity\Player;

class KillPlayerModel
{
    /**
     * @var Player
     */
    private $player;

    /**
     * Get player.
     *
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set player.
     *
     * @param Player $player
     *
     * @return KillPlayerModel
     */
    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }
}
