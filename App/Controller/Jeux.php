<?php
declare(strict_types=1);

namespace App\Controller;
use App\Game\Game;

class Jeux implements Controller
{
    public function render(){
        $game = new Game();
        $game->init();
        require __DIR__ . '/template.php';
    }
}
