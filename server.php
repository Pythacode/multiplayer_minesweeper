<?php

require 'vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Game\GameServer;
use App\Game\GameManager;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$required_var = ['API_DOC_URL'];
foreach ($required_var as $var) {
    if (!isset($_ENV[$var])) {
        die("Missing " . $var . " in environment");
    }
}

$gameManager = new GameManager();
$gameManager->reveal(0,0);
$size = $gameManager->getSize();

/*$x = $_GET['x'];
$y = $_GET['y'];
$rev = $_GET['reveal'];


try {
    if($x != null && $y != null && $x >= 0 && $x < $size && $y >= 0 && $y < $size) {
        if ($rev == null) {
            //echo "null reveal";
        } else if($rev == 1) {
            $gameManager->reveal($x,$y);
            echo "revealed at ".$x.", ".$y;
        } else if($rev == 0) {
            echo $gameManager->getAtXY($x,$y);
            //echo "refreshed";
        } else {
            echo "?";
            //echo "invalid reveal : ".$rev;
        }
    } else {
        echo "invalid parameters : ";
        echo $x; echo ", "; echo $y;
    }
} catch (Exception $exn) {
    echo "nope";
}*/
/*
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new GameServer($gameManager, $_ENV['API_DOC_URL'])
        )
    ),
    8080
);

echo "Server starting on port 8080\n";
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL | E_STRICT);
$server->run();
echo "Server running on port 8080\n";
*/
?>