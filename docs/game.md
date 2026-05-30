# Class Cell

Is a class for represent a cell of game.

- `public $type = 0;` // Type of cell : `-1` for negativ bomb, `1` for a positive bomb, `0` else
- `public $revealed = false;` // If this cell are revealed
- `public $have_neighbor_mines = false;` // If this cell have mine neighbor
- `public $count_neighbor_mine = 0;` // Count of neighbor mine

# Class Game

Is a game engine

## Varibles :

- `public $size;` // Size of game
- `public $mode;` // Level of game
- `public $mines;` // Number of mine
- `public $game_matrice;` // Matrix for player representation.
    It is a 2D matrix with `#` for unrevealed cell and `count_neighbor_mine` else.
- `private $mines_matrice;` // Matrix for game
- `private $mine_placed = false;` // If mine are placed

## Functions :

- #### `public __construct()`
    Build the class

- #### `private function place_mine($X, $Y)`
    Place all mine of game.
    Take two arguments : start position for not loose in first play

- #### `private function neighbor_sum($x, $y)`
    Return the sum of mine arround `$x` `$y` cell.
    Take two arguments : cell position

- #### `private function create_neighbor_mines_matrice()`
    Attribute for all cell sum of mine arround.

- #### `private function deploy($x,$y)`
    Reveal the cell arround `$x` `$y` cell.

- #### `public function play($x, $y)`
    Play the `$x` `$y` cell.
    Return `false` if cell is  mine, `true` else.


    