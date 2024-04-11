<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\HandOrderFamilyDto;
use App\DTO\HandOrderValueDto;
use App\Entity\Hand;
use App\Entity\HandFamilyOrder;
use App\Entity\HandValueOrder;
use App\Factory\GameFactory;
use App\Factory\HandFactory;
use App\Form\HandFamilyOrdersType;
use App\Form\HandValueOrdersType;
use App\Repository\CardFamilyRepository;
use App\Repository\CardRepository;
use App\Repository\CardValueRepository;
use App\Repository\HandRepository;
use App\Service\ArrangeCardsService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/game')]
class GameController extends AbstractController
{
    public function __construct(
        private readonly CardRepository              $cardRepository,
        private readonly EntityManagerInterface      $entityManager,
        private readonly CardFamilyRepository        $cardFamilyRepository,
        private readonly CardValueRepository         $cardValueRepository,
        private readonly HandRepository              $handRepository,
        private readonly ArrangeCardsService         $arrangeCardsService,
    ) {
    }

    #[Route('/start', 'init_party')]
    public function index(): Response
    {
        $cards = $this->cardRepository->findAll();
        $game = GameFactory::create(new ArrayCollection($cards));

        $randomKeys = array_rand($cards, 10);
        $randomCards = new ArrayCollection();
        foreach ($randomKeys as $key) {
            $randomCards->add($cards[$key]);
        }

        $hand = HandFactory::create($game, $randomCards);

        $this->entityManager->persist($game);
        $this->entityManager->persist($hand);
        $this->entityManager->flush();

        return $this->render('game/draw.html.twig', [
            'hand' => $hand,
        ]);
    }

    #[Route('/{id}/order/color', 'order_cards_family', methods: ['GET', 'POST'])]
    public function orderFamily(Request $request, Hand $hand): Response
    {
        $handFamilyOrderDTO = new HandOrderFamilyDto();
        $distinctFamilyInHands = $this->handRepository->findDistinctFamilyInHand($hand);

        foreach ($distinctFamilyInHands as $familyId) {
            $handFamilyOrderDTO->add(new HandFamilyOrder($this->cardFamilyRepository->find($familyId), $hand));
        }

        $form = $this->createForm(HandFamilyOrdersType::class, $handFamilyOrderDTO);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $handFamilyOrders = $form->getData();

            foreach ($handFamilyOrders->getHandFamilyOrders() as $handFamilyOrder) {
                $this->entityManager->persist($handFamilyOrder);
            }
            $this->entityManager->flush();

            return $this->redirectToRoute('order_cards_value', ['id' => $hand->getId()]);
        }

        return $this->render('game/sort-family.html.twig', [
            'form' => $form,
            'hand' => $hand,
        ]);
    }

    #[Route('/{id}/order/value', 'order_cards_value', methods: ['GET', 'POST'])]
    public function orderValue(Request $request, Hand $hand): Response
    {
        $handValueOrderDTO = new HandOrderValueDto();
        $distinctValuesInHands = $this->handRepository->findDistinctValuesInHand($hand);

        foreach ($distinctValuesInHands as $valueId) {
            $handValueOrderDTO->add(new HandValueOrder($this->cardValueRepository->find($valueId), $hand));
        }

        $form = $this->createForm(HandValueOrdersType::class, $handValueOrderDTO);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $handValueOrders = $form->getData();
            foreach ($handValueOrders->getHandValueOrders() as $handValueOrder) {
                $this->entityManager->persist($handValueOrder);
            }
            $this->entityManager->flush();

            return $this->redirectToRoute('result', ['id' => $hand->getId()]);
        }

        return $this->render('game/sort-value.html.twig', [
            'form' => $form,
            'hand' => $hand,
        ]);
    }

    #[Route('/{id}/result', 'result')]
    public function result(Hand $hand): Response
    {

        $orderFamily = $hand->getHandFamilyOrders()->toArray();
        usort($orderFamily, fn ($a, $b) => $a->getPosition() <=> $b->getPosition());
        $orderValue = $hand->getHandValueOrders()->toArray();
        usort($orderValue, fn ($a, $b) => $a->getPosition() <=> $b->getPosition());

        $arrangedHand = $hand->getCards()->toArray();
        $arrangedHand = $this->arrangeCardsService->sortFamily($arrangedHand, $orderFamily);

        $dividedArray = array_reduce($arrangedHand, function ($carry, $item) {
            $cardFamilyName = $item->getCardFamily()->getName();
            $carry[$cardFamilyName][] = $item;
            return $carry;
        }, []);

        $finalArray = [];
        foreach ($dividedArray as $array) {
            $finalArray[] = array_values($this->arrangeCardsService->sortValue($array, $orderValue));
        }

        return $this->render('game/result.html.twig', [
            'hand' => $hand,
            'arrangedHand' => $arrangedHand,
            'arrangedHandValues' => array_values($finalArray),
            'orderFamily' => $orderFamily,
            'orderValue' => $orderValue,
        ]);
    }

}
