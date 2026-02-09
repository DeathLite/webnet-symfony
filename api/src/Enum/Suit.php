<?php
// src/Enum/Suit.php
namespace App\Enum;

enum Suit: string {
    case DIAMOND = 'Carreau';
    case HEART = 'Cœur';
    case SPADE = 'Pique';
    case CLUB = 'Trèfle';
}