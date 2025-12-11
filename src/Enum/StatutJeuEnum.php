<?php

namespace App\Enum;

enum StatutJeuEnum: string
{
    case POSSEDE = 'POSSEDE';
    case SOUHAITE = 'SOUHAITE';
    case EN_COURS = 'EN_COURS';
    case TERMINE = 'TERMINE';
    case ABANDONNE = 'ABANDONNE';
    case PRETE = 'PRETE';
    case VENDU = 'VENDU';
    case PLATINE = 'PLATINE';

    public function getLabel(): string
    {
        // Retourne une valeur « human-readable »
        return match($this) {
            self::POSSEDE => 'Possédé',
            self::SOUHAITE => 'Souhaité',
            self::EN_COURS => 'En cours',
            self::TERMINE => 'Terminé',
            self::ABANDONNE => 'Abandonné',
            self::PRETE => 'Prêté',
            self::VENDU => 'Vendu',
            self::PLATINE => 'Platine',
        };
    }

    public function getBadgeClass(): string
    {
        // Retourne une classe CSS pour styler les badges
        return match($this) {
            self::POSSEDE => 'badge-possede',
            self::SOUHAITE => 'badge-souhaite',
            self::EN_COURS => 'badge-en-cours',
            self::TERMINE => 'badge-termine',
            self::ABANDONNE => 'badge-abandonne',
            self::PRETE => 'badge-prete',
            self::VENDU => 'badge-vendu',
            self::PLATINE => 'badge-platine',
        };
    }
}
