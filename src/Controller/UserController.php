<?php

namespace App\Controller;

use App\Model\FavManager;
use App\Model\UserManager;

class UserController extends AbstractController
{
    public function login(): string
    {
        if ($this->user) {
            header('Location: /user');
            exit();
        }

        $messages = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Clean $_POST
            $data = array_map('trim', $_POST);
            // Check if form is filled
            if (!isset($data['login']) || empty($data['login'])) {
                $messages[] = ['Please fill in login field.'];
            } elseif (!isset($data['password']) || empty($data['password'])) {
                $messages[] = ['Please fill in password field.'];
            } else {
                $userManager = new UserManager();
                $user = $userManager->selectUserByName($data['login']);
                // Check if user exists and password is correct
                if ($user && password_verify($data['password'], $user['password'])) {
                    $_SESSION['id'] = $user['id'];
                    header('Location: /user');
                    exit();
                } else {
                    $messages[] = ['Invalid username or password.'];
                }
            }
        }

        return $this->twig->render('User/login.html.twig', ['messages' => $messages]);
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /');
        exit();
    }

    public function profil()
    {
        if (!$this->user) {
            header('Location: /');
            exit();
        }

        $photoFavUser = new FavManager();
        $photos = $photoFavUser->selectAllFav($this->user['id']);

        return $this->twig->render('User/profil.html.twig', ['photos' => $photos]);
    }
}
