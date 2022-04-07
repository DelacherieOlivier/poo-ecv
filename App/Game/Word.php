<?php
declare(strict_types=1);
namespace App\Game;

use App\Data\infoGame;

class Word{

    public static function PositionLetter($word1,$word2){
        $word1 = str_split($word1);
        $word2 = str_split($word2);

        for ($i = 0; $i < count($word1); $i++) {
            if ($word1[$i] == $word2[$i]) {
                echo "<span style='color:green'>" . $word1[$i]."</span>" ; // bien placé
            }
            if (in_array($word1[$i], $word2) && $word1[$i] != $word2[$i]) {
                echo "<span style='color:#FFD700'>" . $word1[$i]."</span>" ; // mal placé
            }
            if (!in_array($word1[$i], $word2)) {
                echo "<span style='color:red'>" . $word1[$i]."</span>"; // exist pas
            }
        }
    }

}


