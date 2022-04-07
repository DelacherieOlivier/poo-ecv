<?php
declare(strict_types=1);
namespace App\Game;

use App\Data\infoGame;
use App\Data\wordJson;
use App\Game\Word;

class Game{

    public string $word;
    public int $numberEssay;
    public array $tabMotPropose = [];

    public function init(){

        if(infoGame::infoStartGame() == true){

            $infogame = json_decode(InfoGame::getInfoGame());
            $this->word = $infogame->word;
            $this->numberEssay = $infogame->numberEssay - 1;
            $this->tabMotPropose = $infogame->tabMotPropose;

            if ($this->numberEssay + 1 > 0) {

                $motPropose = '';
                for ($i = 0; $i < strlen($this->word); $i++) {
                    if(isset($_GET['letter'.$i])) {
                        $motPropose .= $_GET['letter' . $i];
                    }
                }
                $this->tabMotPropose[] = $motPropose;

                for ($i = 0; $i < count($this->tabMotPropose) ; $i++) {
                    echo "mot propose : " . $this->tabMotPropose[$i] . "</br>";
                }

                $word1 = str_split($motPropose);
                $word2 = str_split($this->word);

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

                if ($motPropose == $this->word){
                    echo "Bravo vous avez gagné";
                    echo "<br>";
                    echo "Le mot était : ".$this->word;
                    infoGame::DeleteInfoGame();
                    return;
                }
            }
            if($this->numberEssay + 1 <= 0) {
                $this->numberEssay = 0;
                echo "Vous avez perdu !<br><br>";
                echo "Le mot a trouver etait : " . $this->word;
                infoGame::DeleteInfoGame();
                return;
            }

            $infogame = array(
                "word" => $this->word,
                "numberEssay" => $this->numberEssay,
                "tabMotPropose" => $this->tabMotPropose
            );
            infoGame::setInfoGame($infogame);
            return;
        }

        $this->word = wordJson::getRandomWord();
        $this->numberEssay = 6;
        $infogame = array(
            "word" => $this->word,
            "numberEssay" => $this->numberEssay,
            "tabMotPropose" => $this->tabMotPropose
        );
        infoGame::setInfoGame($infogame);
    }
}


