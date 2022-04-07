<?php
declare(strict_types=1);
namespace App\Data;


class WordJson {

    private const FILE_PATH = __DIR__ . '/Word.json';
    private static array $words = [];

    private static function loadFile() {

        if(empty(self::$words)) {
            self::$words = json_decode(file_get_contents(self::FILE_PATH), true);
        }
        return self::$words;
    }

    public static function getRandomWord() {
        $words = self::loadFile();
        $randomKey = array_rand($words);
        return $words[$randomKey];
    }
}
