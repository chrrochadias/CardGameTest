<?php

namespace App\Service;

class ArrangeCardsService
{
    public function sortFamily(array $cards, array $handFamilyOrders): array
    {
        usort($cards, function ($a, $b) use ($handFamilyOrders) {
            $aFamilyOrder = array_filter($handFamilyOrders, fn ($familyOrder) => $familyOrder->getCardFamily()->getId() === $a->getCardFamily()->getId());
            $bFamilyOrder = array_filter($handFamilyOrders, fn ($familyOrder) => $familyOrder->getCardFamily()->getId() === $b->getCardFamily()->getId());

            $aFamilyOrder = array_shift($aFamilyOrder);
            $bFamilyOrder = array_shift($bFamilyOrder);

            return $aFamilyOrder->getPosition() <=> $bFamilyOrder->getPosition();
        });

        return $cards;
    }

    public function sortValue(array $cards, array $handValueOrders): array
    {
        usort($cards, function ($a, $b) use ($handValueOrders) {
            $aValueOrder = array_filter($handValueOrders, fn ($valueOrder) => $valueOrder->getCardValue()->getId() === $a->getCardValue()->getId());
            $bValueOrder = array_filter($handValueOrders, fn ($valueOrder) => $valueOrder->getCardValue()->getId() === $b->getCardValue()->getId());

            $aValueOrder = array_shift($aValueOrder);
            $bValueOrder = array_shift($bValueOrder);

            return $aValueOrder->getPosition() <=> $bValueOrder->getPosition();
        });

        return $cards;
    }

}
