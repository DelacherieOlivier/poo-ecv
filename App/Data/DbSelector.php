<?php

declare(strict_types=1);

namespace App\Data;

// cette classe n'est pas utilisée et l'interface ConnectorInterface n'existe pas.
class DbSelector
{
    public static function getConnector(): ConnectorInterface
    {
        if (APP_ENV === 'dev') {
            return new WordJson();
        }

        throw new \LogicException('Unknown environment');
    }
}
