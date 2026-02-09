<?php
// src/Service/CardSorter.php
namespace App\Service;

class CardSorter {
    public function sort(array $hand, array $suitOrder, array $valueOrder): array {
        usort($hand, function($a, $b) use ($suitOrder, $valueOrder) {
            $suitPosA = array_search($a->suit->value, $suitOrder);
            $suitPosB = array_search($b->suit->value, $suitOrder);

            if ($suitPosA !== $suitPosB) {
                return $suitPosA <=> $suitPosB;
            }

            $valPosA = array_search($a->value->value, $valueOrder);
            $valPosB = array_search($b->value->value, $valueOrder);

            return $valPosA <=> $valPosB;
        });

        return $hand;
    }
}