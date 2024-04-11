<?php

namespace Tests\Service;

use App\Entity\Card;
use App\Entity\CardValue;
use App\Entity\Game;
use App\Entity\Hand;
use App\Entity\HandFamilyOrder;
use App\Entity\HandValueOrder;
use App\Service\ArrangeCardsService;
use App\Tests\Entity\CardFamilyStub;
use App\Tests\Entity\CardValueStub;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class ArrangeCardsServiceTest extends TestCase
{
    use ProphecyTrait;
    private $arrangeCardsService;

    protected function setUp(): void
    {
        $this->arrangeCardsService = new ArrangeCardsService();
    }

    /**
     * @dataProvider provideCards
     */
    public function testSortFamilyOrdersCardsCorrectly($cards)
    {
        $game = new Game();
        foreach ($cards as $card) {
            $game->addCard($card);
        }

        $hand = new Hand($game->getCards(), $game);
        $handFamilyOrders = [];
        foreach ($cards as $card) {
            $handFamilyOrders[] = new HandFamilyOrder($card->getCardFamily(), $hand, $card->getCardFamily()->getId());
        }

        $result = $game->getCards()->toArray();
        $result = $this->arrangeCardsService->sortFamily($result, $handFamilyOrders);

        $this->assertNotEmpty($result);

        $expectedValue = [
            new Card(new CardFamilyStub(1, 'CLUBS'), new CardValueStub(1,'8')),
            new Card(new CardFamilyStub(2, 'SPADES'), new CardValueStub(2,'4')),
            new Card(new CardFamilyStub(3, 'DIAMONDS'), new CardValueStub(3,'7')),
            new Card(new CardFamilyStub(4, 'HEARTS'), new CardValueStub(4,'10')),
        ];

        $this->assertEquals($expectedValue, $result);

    }

    /**
     * @dataProvider provideCards
     */
    public function testSortValueOrdersCardsCorrectly($cards)
    {
        $game = new Game();
        foreach ($cards as $card) {
            $game->addCard($card);
        }

        $hand = new Hand($game->getCards(), $game);
        $handValueOrders = [];
        foreach ($cards as $card) {
            $handValueOrders[] = new HandValueOrder($card->getCardValue(), $hand,(int) $card->getCardValue()->getValue());
        }

        $result = $game->getCards()->toArray();
        $result = $this->arrangeCardsService->sortValue($result, $handValueOrders);

        $this->assertNotEmpty($result);

        $expectedValue = [
            new Card(new CardFamilyStub(2, 'SPADES'), new CardValueStub(2,'4')),
            new Card(new CardFamilyStub(3, 'DIAMONDS'), new CardValueStub(3,'7')),
            new Card(new CardFamilyStub(1, 'CLUBS'), new CardValueStub(1,'8')),
            new Card(new CardFamilyStub(4, 'HEARTS'), new CardValueStub(4,'10')),
        ];

        $this->assertEquals($expectedValue, $result);

    }


    public function provideCards(): \Generator
    {
        yield [
                [
                    new Card(new CardFamilyStub(4, 'HEARTS'), new CardValueStub(4,'10')),
                    new Card(new CardFamilyStub(2, 'SPADES'), new CardValueStub(2,'4')),
                    new Card(new CardFamilyStub(1, 'CLUBS'), new CardValueStub(1,'8')),
                    new Card(new CardFamilyStub(3, 'DIAMONDS'), new CardValueStub(3,'7')),
                ]
        ];
    }

}