<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private CardValue $cardValue;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private CardFamily $cardFamily;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCardValue(): CardValue
    {
        return $this->cardValue;
    }

    public function setCardValue(CardValue $cardValue): static
    {
        $this->cardValue = $cardValue;

        return $this;
    }

    public function getCardFamily(): ?CardFamily
    {
        return $this->cardFamily;
    }

    public function setCardFamily(CardFamily $cardFamily): static
    {
        $this->cardFamily = $cardFamily;

        return $this;
    }

    public function __construct(CardFamily $cardFamily, CardValue $cardValue)
    {
        $this->cardFamily = $cardFamily;
        $this->cardValue = $cardValue;
    }

}
