<?php

namespace App\Entity;

use App\Repository\HandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HandRepository::class)]
class Hand implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    /**
     * @var Collection<int, Card>
     */
    #[ORM\ManyToMany(targetEntity: Card::class)]
    private Collection $cards;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game;

    /**
     * @var Collection<int, HandFamilyOrder>
     */
    #[ORM\OneToMany(targetEntity: HandFamilyOrder::class, mappedBy: 'hand', orphanRemoval: true)]
    private Collection $handFamilyOrders;

    #[ORM\OneToMany(targetEntity: HandValueOrder::class, mappedBy: 'hand', orphanRemoval: true)]
    private Collection $handValueOrders;

    public function __construct()
    {
        $this->cards = new ArrayCollection();
        $this->handFamilyOrders = new ArrayCollection();
        $this->handValueOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Card>
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function addCard(Card $card): static
    {
        if (!$this->cards->contains($card)) {
            $this->cards->add($card);
        }

        return $this;
    }

    public function removeCard(Card $card): static
    {
        $this->cards->removeElement($card);

        return $this;
    }

    public function setCards(Collection $cards): static
    {
        $this->cards = $cards;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return Collection<int, HandFamilyOrder>
     */
    public function getHandFamilyOrders(): Collection
    {
        return $this->handFamilyOrders;
    }

    public function addHandFamilyOrder(HandFamilyOrder $handFamilyOrder): static
    {
        if (!$this->handFamilyOrders->contains($handFamilyOrder)) {
            $this->handFamilyOrders->add($handFamilyOrder);
            $handFamilyOrder->setHand($this);
        }

        return $this;
    }

    public function removeHandFamilyOrder(HandFamilyOrder $handFamilyOrder): static
    {
        if ($this->handFamilyOrders->removeElement($handFamilyOrder)) {
            // set the owning side to null (unless already changed)
            if ($handFamilyOrder->getHand() === $this) {
                $handFamilyOrder->setHand(null);
            }
        }

        return $this;
    }

    public function setHandFamilyOrders(Collection $handFamilyOrders): static
    {
        $this->handFamilyOrders = $handFamilyOrders;

        return $this;
    }

    /**
     * @return Collection<int, HandValueOrder>
     */
    public function getHandValueOrders(): Collection
    {
        return $this->handValueOrders;
    }

    public function addHandValueOrder(HandValueOrder $handValueOrder): static
    {
        if (!$this->handValueOrders->contains($handValueOrder)) {
            $this->handValueOrders->add($handValueOrder);
            $handValueOrder->setHand($this);
        }

        return $this;
    }

    public function removeHandValueOrder(HandValueOrder $handValueOrder): static
    {
        if ($this->handValueOrders->removeElement($handValueOrder)) {
            // set the owning side to null (unless already changed)
            if ($handValueOrder->getHand() === $this) {
                $handValueOrder->setHand(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return 'Current Hand';
    }

}
