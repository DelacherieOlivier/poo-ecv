<?php

declare(strict_types=1);

namespace App\Data;

class infoGame
{
    public static function getInfoGame()
    {
        return $_COOKIE['infoGame'];
    }

    public static function isGameStarted(): bool
    {
        return isset($_COOKIE['infoGame']);
    }

    public static function setInfoGame($infoGame): void
    {
        setcookie('infoGame', json_encode($infoGame), time() + (86400 * 30), '/');
    }

    public static function DeleteInfoGame(): void
    {
        setcookie('infoGame', '', time() - 3600, '/');
    }
}
