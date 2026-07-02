<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="theCSS.css">
    <title>E</title>
</head>
<html>
    <body>
    
        <?php
            require 'vendor/autoload.php';

            use App\Game\GameManager;
            use App\Game\GameServer;

            $gameManager = new GameManager();
            $size = $gameManager->getSize();

            $gameManager->reveal(0,0);

            for ($i = 0; $i < $size; $i++) {
                echo "<div>";
                for ($j = 0; $j < $size; $j++) {
                    echo "<span id=";
                    echo $gameManager->getDiv($i,$j);
                    echo ">";
                    echo $gameManager->getAtXY($i,$j);
                    echo "</span>";
                }
                echo "</div>";
            }

            echo "\n";
            echo "--------------------------";
        ?>

    </body>
</html>
