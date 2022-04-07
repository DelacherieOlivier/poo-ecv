<?php

declare(strict_types=1);

namespace App\Game;

use App\Data\infoGame;
use App\Data\wordJson;

class Game
{
    public string $word;
    public int $numberEssay;
    public array $tabMotPropose = [];

    public function init(): void
    {
        if (true === infoGame::isGameStarted()) {
            $infogame = json_decode(InfoGame::getInfoGame()); // je pense que le json_decode est de la responsabilité de InfoGame
            $this->word = $infogame->word;
            $this->numberEssay = $infogame->numberEssay - 1;
            $this->tabMotPropose = $infogame->tabMotPropose;

            // tu ne vérifie pas si l'utilisateur veux vraiment faire une saisie.
            // si je recharge la page, a chaque fois le système pense que c'est un nouveau mot :(
            if ($this->numberEssay + 1 > 0) {
                $motPropose = '';
                for ($i = 0; $i < \strlen($this->word); ++$i) { // appeler une fonction dans un for est coûteux. Il vaut mieux stocker le résultat en amont

                    // tu peux envoyer des tableaux dans les URL
                    // http://localhost:8000/?letter0=&letter1=&letter2=&letter3=&letter4=&letter5=
                    // devient
                    // http://localhost:8000/?letter[]=a&letter[]=b&letter[]=c&letter[]=d
                    if (isset($_GET['letter'.$i])) {
                        $motPropose .= $_GET['letter'.$i];
                    }
                }
                $this->tabMotPropose[] = $motPropose;

                for ($i = 0; $i < \count($this->tabMotPropose); ++$i) { // appeler une fonction dans un for est coûteux. Il vaut mieux stocker le résultat en amont
                    echo 'mot propose : ';
                    echo Word::PositionLetter($this->tabMotPropose[$i], $this->word).'<br>';
                }

                // Toutes ces inclusions de if manquent de souplesse.
                // Il aurait fallu utiliser un design pattern afin de responsabiliser une classe par condition et de les vérifier de façon séquentielle ou évènementielles.
                if ($motPropose === $this->word) {
                    echo 'Bravo vous avez gagné';
                    echo '<br>';
                    echo 'Le mot était : '.$this->word;
                    infoGame::DeleteInfoGame();

                    return;
                }
            }
            if ($this->numberEssay + 1 <= 0) {
                $this->numberEssay = 0;
                echo 'Vous avez perdu !<br><br>';
                echo 'Le mot a trouver etait : '.$this->word;
                infoGame::DeleteInfoGame();

                return;
            }

            $infogame = [
                'word' => $this->word,
                'numberEssay' => $this->numberEssay,
                'tabMotPropose' => $this->tabMotPropose,
            ];
            infoGame::setInfoGame($infogame);

            return;
        }

        $this->word = wordJson::getRandomWord();
        $this->numberEssay = 6;
        $infogame = [
            'word' => $this->word,
            'numberEssay' => $this->numberEssay,
            'tabMotPropose' => $this->tabMotPropose,
        ];
        infoGame::setInfoGame($infogame);
    }
}
