<?php

namespace App\Controller;

use App\Model\FavManager;

class FavController extends AbstractController
{
    public function toggleFav(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = array_map('trim', $_POST);
            if (isset($data['addfav']) && !empty($data['addfav'])) {
                $idFav = (int)$data['addfav'];
                $userId = $this->user['id'];
                $favManager = new FavManager();
                $favManager->insertFav($idFav, $userId);
            }
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
