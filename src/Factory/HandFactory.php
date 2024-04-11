<?php

namespace App\Factory;

use App\Entity\Game;
use App\Entity\Hand;
use Doctrine\Common\Collections\ArrayCollection;

class HandFactory
{
    public static function create(Game $game, ArrayCollection $cards): Hand
    {
        $hand = new Hand();
        $hand->setCards($cards);
        $hand->setGame($game);

        return $hand;
    }
}
