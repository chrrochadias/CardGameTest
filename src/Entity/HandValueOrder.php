<?php

namespace App\Entity;

use App\Repository\HandFamilyOrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HandFamilyOrderRepository::class)]
class HandValueOrder implements \Stringable
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
    private CardValue $cardValue;

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

    public function getCardValue(): CardValue
    {
        return $this->cardValue;
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
        return $this->cardValue->getValue();
    }

    public function __construct(CardValue $cardValue, Hand $hand, ?int $position = null)
    {
        $this->cardValue = $cardValue;
        $this->hand = $hand;
        $this->position = $position;
    }
}
