<?php

namespace App\Game;

class GameManager
{
    public $game;

    public function __construct()
    {
        $this->game = new Game();
    }

    public function getSize() {
        return $this->game->getSize();
    }

    public function getAtXY($x, $y) {
        return $this->game->getXY($x, $y);
    }

    public function getDiv($x, $y) {
        $v = $this->getAtXY($x, $y);
        //echo "["; echo $v; echo "]";
        switch ($v) {
            case '#': return "mHidden";

            case '*': return "mBlank";

            case "1": return "m1";
            case 1:   return "m1";

            case '2': return "m2";
            case 2:   return "m2";

            case '3': return "m3";
            case 3:   return "m3";

            case '4': return "m4";
            case 4:   return "m4";

            case '5': return "m5";
            case 5:   return "m5";

            case '6': return "m6";
            case 6:   return "m6";

            case '7': return "m7";
            case 7:   return "m7";

            case '8': return "m8";
            case 8:   return "m8";

            case '9': return "m9";
            case 9:   return "m9";

            default: return "mHidden";
        }
    }

    public function reveal($x,$y) {
        $this->game->reveal($x,$y);
    }
}

?>