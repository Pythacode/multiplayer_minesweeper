<?php

namespace App\Game;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class GameServer implements MessageComponentInterface
{
    private array $handlers;
    private GameManager $manager;

    public function __construct(GameManager $gameManager)
    {
        $this->manager = $gameManager;
        $this->handlers = [
            'reveal' => [$this, 'handleReveal'],
        ];
    }

    public function onOpen(ConnectionInterface $conn): void
    {
        // New player
    }

    public function onMessage(ConnectionInterface $from, $msg): void
    {
        $data = json_decode($msg, true);

        if (!isset($data['action'])) {
            $from->send(json_encode(['error' => 'missing action']));
            return;
        }

        $action = $data['action'];

        if (!isset($this->handlers[$action])) {
            $from->send(json_encode(['type' => 'error', 'action' => null, 'message' => "unknown action: $action. See https://https://github.com/Pythacode/multiplayer_minesweeper/blob/main/docs/src/game/WebSowketAPI.md"]));
            return;
        }

        ($this->handlers[$action])($from, $data);
    }

    public function onClose(ConnectionInterface $conn): void
    {
        $conn->close();
    }

    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        $conn->close();
    }

    // --- Handlers ---

    private function handleReveal(ConnectionInterface $conn, array $data): void
    {
        if (!isset($data['x']) or !isset($data['x'])) {
            $conn->send(json_encode(['type' => 'error', 'action' => 'reveal', 'message' => "missing parameter. See https://https://github.com/Pythacode/multiplayer_minesweeper/blob/main/docs/src/game/WebSowketAPI.md"]));
            return;
        }

        $conn->send(json_encode(['return' => $this->manager->game->reveal(0,0)]));
    }
}

