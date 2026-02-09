<?php
namespace App\Controller;

use App\Enum\CardValue;
use App\Enum\Suit;
use App\Model\Card;
use App\Service\CardSorter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/card-game', name: 'api_card_game_')]
class CardGameController extends AbstractController
{
    public function __construct(
        private CardSorter $cardSorter
    ) {}

    #[Route('/play', name: 'play', methods: ['POST'])]
    public function play(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $numberOfCards = $data['count'] ?? 10;

        $suits = array_map(fn($s) => $s->value, Suit::cases());
        $values = array_map(fn($v) => $v->value, CardValue::cases());
        
        $suitOrder = $data['suitOrder'] ?? $this->shuffleArray($suits);
        $valueOrder = $data['valueOrder'] ?? $this->shuffleArray($values);

        $deck = [];
        foreach (Suit::cases() as $suit) {
            foreach (CardValue::cases() as $value) {
                $deck[] = new Card($suit, $value);
            }
        }

        shuffle($deck);
        $hand = array_slice($deck, 0, $numberOfCards);
        
        $unsortedHand = array_map(fn($c) => $c->toString(), $hand);

        $sortedHandObjects = $this->cardSorter->sort($hand, $suitOrder, $valueOrder);
        $sortedHand = array_map(fn($c) => $c->toString(), $sortedHandObjects);

        return $this->json([
            'rules' => [
                'suits' => $suitOrder,
                'values' => $valueOrder
            ],
            'unsortedHand' => $unsortedHand,
            'sortedHand' => $sortedHand
        ]);
    }

    private function shuffleArray(array $array): array
    {
        shuffle($array);
        return $array;
    }
}