<?php
declare(strict_types=1);
namespace App\Data;


class DbSelector{

    public static function getConnector(): ConnectorInterface{
        if(APP_ENV === 'dev'){
            return new WordJson();
        }

        throw new \logicException('Unknown environment');
    }
}

