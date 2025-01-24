<?php

namespace Controllers;

use Managers\RoomManager;
use Managers\CategoryManager;
use Models\Room;

class RoomController extends BaseController
{

    public function __construct()
    {
        $this->roomManager = new RoomManager();
        $this->categoryManager = new CategoryManager();
    }

    /**
     * Liste tous les salons.
     */
    public function listRooms(): void
    {
        $rooms = $this->roomManager->findAll();
        $this->render('room/list', [
            'rooms' => $rooms
        ]);
    }

    /**
     * Liste les salons d'une catégorie en particulier.
     */
    public function listRoomsByCategory(): void
    {
        $categoryId = $_GET['category_id'] ?? null;

        if ($categoryId) {
            $rooms = $this->roomManager->findAllByCategory((int) $categoryId);
            $category = $this->categoryManager->find((int) $categoryId);

            $this->render('room/list', [
                'rooms' => $rooms,
                'category' => $category
            ]);
        } else {
            echo "Catégorie non spécifiée.";
        }
    }

    /**
     * Formulaire de création de salon.
     */
    public function createRoom(): void
    {
        // Pour afficher la liste des catégories (si besoin d'un <select>)
        $categories = $this->categoryManager->findAll();

        $this->render('room/create', [
            'categories' => $categories
        ]);
    }

    /**
     * Traitement du formulaire de création
     */
    public function storeRoom(): void
    {
        if (!empty($_POST['category_id']) && !empty($_POST['name'])) {
            $room = new Room();
            $room->setCategoryId((int) $_POST['category_id']);
            $room->setName($_POST['name']);

            $this->roomManager->insert($room);
            header('Location: index.php?route=/rooms');
            exit;
        } else {
            $this->render('room/create', [
                'error' => 'Tous les champs sont requis.',
                'categories' => $this->categoryManager->findAll()
            ]);
        }
    }

    /**
     * Formulaire de modification
     */
    public function editRoom(): void
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $room = $this->roomManager->find((int)$id);
            $categories = $this->categoryManager->findAll();

            if ($room) {
                $this->render('room/edit', [
                    'room' => $room,
                    'categories' => $categories
                ]);
            } else {
                echo "Salon introuvable.";
            }
        } else {
            echo "Identifiant non spécifié.";
        }
    }

    /**
     * Traitement de la modification
     */
    public function updateRoom(): void
    {
        if (!empty($_POST['id']) && !empty($_POST['category_id']) && !empty($_POST['name'])) {
            $room = $this->roomManager->find((int)$_POST['id']);

            if ($room) {
                $room->setCategoryId((int)$_POST['category_id']);
                $room->setName($_POST['name']);

                $this->roomManager->update($room);
                header('Location: index.php?route=/rooms');
                exit;
            } else {
                echo "Salon introuvable.";
            }
        } else {
            echo "Les champs sont requis.";
        }
    }

    /**
     * Suppression
     */
    public function deleteRoom(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->roomManager->delete((int) $id);
            header('Location: index.php?route=/rooms');
            exit;
        } else {
            echo "Identifiant non spécifié.";
        }
    }
}
