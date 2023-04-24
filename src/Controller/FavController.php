<?php

namespace App\Controller;

use App\Model\FavManager;

class FavController extends AbstractController
{
    public function addFav(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = array_map('trim', $_POST);
            if (isset($data['addfav']) && !empty($data['addfav'])) {
                $idfav = (int)$data['addfav'];
                $userId = $_SESSION['id'];
                $favManager = new FavManager();
                $favManager->insertfav($idfav, $userId);
            }
        }
        header('Location: /');
    }
}
