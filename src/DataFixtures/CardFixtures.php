<?php

namespace App\DataFixtures;

use App\Entity\Card;
use App\Entity\CardFamily;
use App\Entity\CardValue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CardFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $cardFamilies = $manager->getRepository(CardFamily::class)->findAll();
        $cardValues = $manager->getRepository(CardValue::class)->findAll();

        foreach ($cardFamilies as $family) {
            foreach ($cardValues as $value) {
                $card = new Card($family, $value);
                $manager->persist($card);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CardFamilyFixtures::class,
            CardValueFixtures::class,
        ];
    }
}
