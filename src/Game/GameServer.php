<?php

namespace App\Game;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class GameServer implements MessageComponentInterface
{
    private string $doc_url;
    private array $handlers;
    private GameManager $manager;

    public function __construct(GameManager $gameManager, string $doc_url)
    {
        $this->doc_url = $doc_url;
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
            $from->send(json_encode(['type' => 'error', 'action' => null, 'message' => "unknown action: $action. See " . $doc_url]));
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
            $conn->send(json_encode(['type' => 'error', 'action' => 'reveal', 'message' => "missing parameter. See " . $doc_url]));
            return;
        }

        $conn->send(json_encode(['type' => 'succes', 'return' => $this->manager->game->reveal(0,0)]));
    }
}

