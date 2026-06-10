<?php

namespace App\Game;

class Cell
{
    public $type = 0;
    public $revealed = false;
    public $have_neighbor_mines = false;
    public $count_neighbor_mine = 0;
}

class Game
{

    public $size;
    public $mode;
    public $mines;
    public $game_matrice;
    private $mines_matrice;
    private $mine_placed = false;

    public function __construct(
        $mode="intermediate",
        $size=16,
        $mines=40
    )
    {
        switch ($mode) {
            case "easy":
                $size=9;
                $mines=10;
                break;
            case "intermediate":
                $size=16;
                $mines=40;
                break;
            case "expert":
                $size=30;
                $mines=99;
                break;
            case "custom":
                break;
        }

        $mines_matrice = [];
        for ($i = 0; $i < $size; $i++) {
            $row = [];
            for ($j = 0; $j < $size; $j++) {
                $row[] = new Cell();
            }
            $mines_matrice[] = $row;
        }

        $game_matrice = [];
        for ($i=0; $i<$size; $i++) {
            $game_matrice[] = array_fill(0,$size,'#');
        }

        $this->mode  = $mode;
        $this->size  = $size;
        $this->mines = $mines;
        $this->game_matrice = $game_matrice;
        $this->mines_matrice = $mines_matrice;
    }

    private function place_mine($X, $Y) {
        $placed_mine = 0;
        $neighbor = [
            [$X-1, $Y-1], [$X, $Y-1], [$X+1, $Y-1],
            [$X-1, $Y], [$X, $Y], [$X+1, $Y],
            [$X-1, $Y+1], [$X, $Y+1], [$X+1, $Y+1]
        ];
        while ($placed_mine < $this->mines) {
            $x = rand(0, $this->size-1);
            $y = rand(0, $this->size-1);
            
            if (!in_array([$x, $y], $neighbor)) {
                $this->mines_matrice[$y][$x]->type = (rand(0, 1) == 0) ? 1 : -1;
                $placed_mine += 1;
            }
        }
        $this->create_neighbor_mines_matrice();
        $this->mine_placed = true;
    }

    private function neighbor_sum($x, $y) {
        if ($this->mines_matrice[$y][$x]->type == 1 or $this->mines_matrice[$y][$x]->type == -1) {
            return '@';// $this->mines_matrice[$y][$x]->type;
        }

        $neighbor = [
            [$x-1, $y-1], [$x, $y-1], [$x+1, $y-1],
            [$x-1, $y], [$x+1, $y],
            [$x-1, $y+1], [$x, $y+1], [$x+1, $y+1]
        ];

        $sum = 0;
        foreach ($neighbor as $case) {
            if (
                $case[0] >= 0 and
                $case[0] < $this->size and
                $case[1] >= 0 and
                $case[1] < $this->size
            ) {
                $sum += $this->mines_matrice[$case[1]][$case[0]]->type;
            }
        };

        return $sum;
    }

    private function create_neighbor_mines_matrice() {
        for ($y=0; $y<$this->size; $y++) {
            for ($x=0; $x<$this->size; $x++) {
                $this->mines_matrice[$y][$x]->count_neighbor_mine = $this->neighbor_sum($x, $y);

                $neighbor = [
                    [$x-1, $y-1], [$x, $y-1], [$x+1, $y-1],
                    [$x-1, $y], [$x+1, $y],
                    [$x-1, $y+1], [$x, $y+1], [$x+1, $y+1]
                ];

                foreach ($neighbor as $case) {
                    if (
                        $case[0] >= 0 and
                        $case[0] < $this->size and
                        $case[1] >= 0 and
                        $case[1] < $this->size
                    ) {
                        if ($this->mines_matrice[$case[1]][$case[0]]->type == 1 or $this->mines_matrice[$case[1]][$case[0]]->type == -1) {
                            $this->mines_matrice[$y][$x]->have_neighbor_mines = true;
                            break;
                        }
                    }
                }
            }
        }
    }

    private function deploy($x,$y) {
        if (!$this->mines_matrice[$x][$y]->revealed) {
            $this->game_matrice[$y][$x] = $this->mines_matrice[$y][$x]->count_neighbor_mine;
            $this->mines_matrice[$x][$y]->revealed = true;

            
            if (!$this->mines_matrice[$y][$x]->have_neighbor_mines) {
                $neighbor = [
                    [$x-1, $y-1], [$x, $y-1], [$x+1, $y-1],
                    [$x-1, $y], [$x+1, $y],
                    [$x-1, $y+1], [$x, $y+1], [$x+1, $y+1]
                    ];
                    foreach ($neighbor as $case) {
                    if (
                        $case[0] >= 0 and
                        $case[0] < $this->size and
                        $case[1] >= 0 and
                        $case[1] < $this->size and
                        !$this->mines_matrice[$case[1]][$case[0]]->revealed
                    ) {
                        $this->deploy($case[0], $case[1]);
                    }
                }
            }
        }
    }

    public function reveal($x, $y) {
        if (!$this->mine_placed) {
            $this->place_mine($x, $y);
        }
        if ($this->mines_matrice[$y][$x]->type == 1 or $this->mines_matrice[$y][$x]->type == -1) {
            return false;
        } else {
            $this->deploy($x, $y);
            return true;
        }
    }
}

?>