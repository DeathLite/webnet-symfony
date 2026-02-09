<?php
// src/Model/Card.php
namespace App\Model;

use App\Enum\Suit;
use App\Enum\CardValue;

class Card {
    public function __construct(
        public readonly Suit $suit,
        public readonly CardValue $value
    ) {}

    public function toString(): string {
        return "{$this->value->value} {$this->suit->value}";
    }
}