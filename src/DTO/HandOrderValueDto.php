<?php

namespace App\DTO;

use App\Entity\HandValueOrder;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class HandOrderValueDto
{
    private Collection $handValueOrders;

    public function __construct()
    {
        $this->handValueOrders = new ArrayCollection();
    }

    public function getHandValueOrders(): Collection
    {
        return $this->handValueOrders;
    }

    public function setHandValueOrders(Collection $handValueOrders): static
    {
        $this->handValueOrders = $handValueOrders;

        return $this;
    }

    public function add(HandValueOrder $handValueOrder): static
    {
        $this->handValueOrders->add($handValueOrder);

        return $this;
    }

    public function remove(HandValueOrder $handValueOrder): static
    {
        $this->handValueOrders->removeElement($handValueOrder);

        return $this;
    }
}
