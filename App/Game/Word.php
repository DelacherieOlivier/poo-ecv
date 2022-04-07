<?php
declare(strict_types=1);
namespace App\Game;

use App\Data\infoGame;

class Word{


    public function printLetter($letter, $casestatus) {
        if($casestatus == 0 ) { $color = "bleu"; }  // bien placé
        if($casestatus == 1 ) { $color = "jaune"; } // mal placé
        if($casestatus == 2 ) { $color = "rouge"; } // ne fait pas partis du mot
        ?>
            <span class="case <?=$color?>"><?=$letter?></span>
        <?php
    }

   public static function getSimilarText(){

   }
}


