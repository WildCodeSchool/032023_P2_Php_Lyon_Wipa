<?php

namespace App\Controller;

use App\Model\FavManager;

class FavController extends AbstractController
{
    public function addFav(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idfav = $_POST['addfav'];
            $favManager = new FavManager();
            $favManager->insertfav($idfav);
        }
        header('Location: /');
    }
}
