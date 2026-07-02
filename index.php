<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="res/css/theCSS.css">
    <title>Minesweeper</title>
    <script>
        function updateBoard(x,y) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = "hellow";
                }
            };
            xmlhttp.open("GET", "index.php?x="+x+"&y="+y, true);
            xmlhttp.send();
        }
    </script>
</head>
<html>
    <body>
        <div id=gameboard>
        <?php
            require 'vendor/autoload.php';

            // require -> erreur si le fichier exsiste ps
            // _once -> charge ps le fichier si il est déjà chargé
            // $_SERVER['DOCUMENT_ROOT'] -> Racine du site
            // . -> concaténation

            require_once $_SERVER['DOCUMENT_ROOT'] . 'src/Game/GameManager.php';

            $xu = $_REQUEST["x"];
            $yu = $_REQUEST["y"];

            use App\Game\GameManager;

            $gameManager = new GameManager();
            $size = $gameManager->getSize();

            $gameManager->reveal(0,0);

            function refresh($gameManager,$size) {
                for ($i = 0; $i < $size; $i++) {
                    echo "<div>";
                    for ($j = 0; $j < $size; $j++) {
                        echo "<span onclick=\"updateBoard(3,3);\" class=\"cell\" id=" . $gameManager->getDiv($i,$j) . ">";
                        echo $gameManager->getAtXY($i,$j);
                        echo "</span>";
                    }
                    echo "</div>";
                }
            }

            refresh($gameManager,$size);

            echo "\n";
            echo "-------------------------- ";
            echo $xu;
            echo " | ";
            echo $yu;

        ?>
        </div>
        <span id="txtHint">hey</span>
    </body>
</html>
