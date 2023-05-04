<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Model\FavManager;
use App\Model\FollowManager;

class UserController extends AbstractController
{
    public function login(): string
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Clean $_POST
            $data = array_map('trim', $_POST);
            // Check if login is filled
            if (!isset($data['login']) || empty($data['login'])) {
                $this->errors[] = 'Please fill in login field.';
            }
            // Check if password is filled
            if (!isset($data['password']) || empty($data['password'])) {
                $this->errors[] = 'Please fill in password field.';
            }
            // user and password field are filled
            if (empty($this->errors)) {
                $userManager = new UserManager();
                $user = $userManager->selectUserByName($data['login']);
                // Check if user exists and password is correct
                if ($user && password_verify($data['password'], $user['password'])) {
                    $_SESSION['id'] = $user['id'];
                    header('Location: /user');
                    exit();
                }
                $this->errors[] = 'Invalid username or password.';
            }
        }
        return $this->twig->render('User/login.html.twig', [
            'errors' => $this->errors
        ]);
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
        $favManager = new FavManager();
        $favIds = $favManager->selectUserFavs($this->user['id']);

        $userManager = new UserManager();
        $photos = $userManager->selectAllFavs($this->user['id']);
        $userPhotos = $userManager->selectUserPictures($this->user['id']);

        $followManager = new FollowManager();
        $followByUser = $followManager->selectFollowedByUser($this->user['id']);

        return $this->twig->render('User/profil.html.twig', [
            'photos' => $photos,
            'userPhotos' => $userPhotos,
            'favIds' => $favIds,
            'followedUsers' => $followByUser,
        ]);
    }
}
