<?php

namespace App\DTO;

use App\Entity\HandFamilyOrder;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class HandOrderFamilyDto
{
    private Collection $handFamilyOrders;

    public function __construct()
    {
        $this->handFamilyOrders = new ArrayCollection();
    }

    public function getHandFamilyOrders(): Collection
    {
        return $this->handFamilyOrders;
    }

    public function setHandFamilyOrders(Collection $handFamilyOrders): static
    {
        $this->handFamilyOrders = $handFamilyOrders;

        return $this;
    }

    public function add(HandFamilyOrder $handFamilyOrder): static
    {
        $this->handFamilyOrders->add($handFamilyOrder);

        return $this;
    }

    public function remove(HandFamilyOrder $handFamilyOrder): static
    {
        $this->handFamilyOrders->removeElement($handFamilyOrder);

        return $this;
    }
}
