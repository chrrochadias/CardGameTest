<?php

namespace App\Factory;

use App\Entity\Game;
use Doctrine\Common\Collections\ArrayCollection;

class GameFactory
{
    public static function create(ArrayCollection $cards): Game
    {
        $game = new Game();
        $game->setCards($cards);

        return $game;
    }
}
