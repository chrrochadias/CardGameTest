<?php

namespace App\DataFixtures;

use App\Entity\CardFamily;
use App\Enum\CardFamilyEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CardFamilyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (CardFamilyEnum::cases() as $family) {
            $cardFamily = new CardFamily($family->name);
            $manager->persist($cardFamily);
        }

        $manager->flush();
    }
}
