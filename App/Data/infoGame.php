<?php

namespace App\Data;

class infoGame{

    public static function getInfoGame(){
        return $_COOKIE['infoGame'];
    }

    public static function infoStartGame(){
        return isset($_COOKIE['infoGame']);
    }

    public static function setInfoGame($infoGame){
        setcookie('infoGame', json_encode($infoGame), time() + (86400 * 30), "/");
    }

    public static function DeleteInfoGame(){
        setcookie('infoGame', '', time() - 3600, "/");
    }
}