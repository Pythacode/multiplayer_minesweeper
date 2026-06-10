<?php

require 'vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Game\GameServer;
use App\Game\GameManager;

$gameManager = new GameManager();

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new GameServer($gameManager)
        )
    ),
    8080
);

echo "Server started on port 8080\n";
$server->run();