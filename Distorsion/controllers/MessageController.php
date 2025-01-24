<?php

namespace Controllers;

use Managers\MessageManager;
use Managers\RoomManager;
use Models\Message;

class MessageController extends BaseController
{
    protected MessageManager $messageManager;
    protected RoomManager $roomManager;

    public function __construct()
    {
        parent::__construct();
        $this->messageManager = new MessageManager();
        $this->roomManager = new RoomManager();
    }

    /**
     * Liste les messages d'un salon
     */
    public function listMessages(): void
    {
        $roomId = $_GET['room_id'] ?? null;

        if ($roomId) {
            $messages = $this->messageManager->findAllByRoom((int) $roomId);
            $room = $this->roomManager->find((int) $roomId);

            if ($room) {
                $this->render('room/messages', [
                    'room' => $room,
                    'messages' => $messages
                ]);
            } else {
                echo "Salon introuvable.";
            }
        } else {
            echo "room_id non spécifié.";
        }
    }

    /**
     * Ajoute un message à un salon
     */
    public function storeMessage(): void
    {
        if (!empty($_POST['room_id']) && !empty($_POST['content'])) {
            $room = $this->roomManager->find((int)$_POST['room_id']);

            if ($room) {
                // Création du message
                $msg = new Message();
                $msg->setRoomId((int)$_POST['room_id']);
                $msg->setContent($_POST['content']);

                $this->messageManager->insert($msg);

                // On revient à la liste des messages
                header('Location: index.php?route=/messages/list&room_id=' . $room->getId());
                exit;
            } else {
                echo "Salon introuvable pour ce message.";
            }
        } else {
            echo "Données manquantes.";
        }
    }

    /**
     * Suppression (optionnelle) d'un message
     */
    public function deleteMessage(): void
    {
        $id = $_GET['id'] ?? null;
        $roomId = $_GET['room_id'] ?? null;

        if ($id && $roomId) {
            $this->messageManager->delete((int) $id);
            header('Location: index.php?route=/messages/list&room_id=' . (int) $roomId);
            exit;
        } else {
            echo "Paramètres manquants.";
        }
    }
}
