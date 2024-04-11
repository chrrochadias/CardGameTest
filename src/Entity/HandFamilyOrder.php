<?php

namespace App\Entity;

use App\Repository\HandFamilyOrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HandFamilyOrderRepository::class)]
class HandFamilyOrder implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'handFamilyOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private Hand $hand;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private CardFamily $cardFamily;

    #[ORM\Column]
    private ?int $position = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHand(): Hand
    {
        return $this->hand;
    }

    public function setHand(Hand $hand): static
    {
        $this->hand = $hand;

        return $this;
    }

    public function getCardFamily(): CardFamily
    {
        return $this->cardFamily;
    }

    public function setCardFamily(CardFamily $cardFamily): static
    {
        $this->cardFamily = $cardFamily;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function __toString(): string
    {
        return $this->cardFamily->getName();
    }

    public function __construct(CardFamily $cardFamily, Hand $hand, int $position = 0)
    {
        $this->cardFamily = $cardFamily;
        $this->hand = $hand;
        $this->position = $position;
    }
}
