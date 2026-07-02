<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="theCSS.css">
    <title>E</title>
</head>
<html>
    <body>
    
        <?php
            require 'vendor/autoload.php';

            // require -> erreur si le fichier exsiste ps
            // _once -> charge ps le fichier si il est déjà chargé
            // $_SERVER['DOCUMENT_ROOT'] -> Racine du site
            // . -> concaténtion

            require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Game/GameManager';

            $gameManager = new GameManager();
            $size = $gameManager->getSize();

            $gameManager->reveal(0,0);

            for ($i = 0; $i < $size; $i++) {
                echo "<div>";
                for ($j = 0; $j < $size; $j++) {
                    echo "<span id=" . $gameManager->getDiv($i,$j) . ">";
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
