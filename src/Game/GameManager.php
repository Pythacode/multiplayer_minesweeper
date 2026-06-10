<?php

namespace App\Game;

class GameManager
{
    public $game;

    public function __construct()
    {
        $this->game = new Game();
    }
}

?>