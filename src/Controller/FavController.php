<?php

namespace App\Controller;

use App\Model\FavManager;

class FavController extends AbstractController
{
    public function addFav(): void
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_SESSION["user"])) {
                // Send the user to login page if not login
                 header('Location: /login');
                 exit;
            }


            $idfav = $_POST['addfav'];
            $userId = $_SESSION["user_id"];
            $favManager = new FavManager();
            $favManager->insertfav($idfav, $userId);
        }

        header('Location: /');
    }
}
