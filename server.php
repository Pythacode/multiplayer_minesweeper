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

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new GameServer($gameManager, $_ENV['API_DOC_URL'])
        )
    ),
    8080
);

echo "Server started on port 8080\n";
$server->run();