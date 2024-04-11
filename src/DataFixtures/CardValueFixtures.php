<?php

namespace App\DataFixtures;

use App\Entity\CardValue;
use App\Enum\CardValueEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CardValueFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach (CardValueEnum::cases() as $value) {
            $cardValue = new CardValue($value->name);
            $manager->persist($cardValue);
        }

        $manager->flush();
    }


}
