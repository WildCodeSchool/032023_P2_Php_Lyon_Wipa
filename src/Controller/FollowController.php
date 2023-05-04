<?php

namespace App\Controller;

use App\Model\FollowManager;
use App\Model\FavManager;
use App\Model\UserManager;

class FollowController extends AbstractController
{
    public function toggleFollow(): void
    {
        // allowed only for users
        if (!$this->user) {
            header('Location: /');
            exit();
        }

        $userId = $this->user['id'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = array_map('trim', $_POST);
            // is there a followed id ?
            if (!isset($data['followedId']) || empty($data['followedId'])) {
                $this->errors[] = 'No user selected to be followed';
            }
            // user can't follow himself
            if ($data['followedId'] == $userId) {
                $this->errors[] = 'You can\'t follow yourself !';
            }
            // if validated, followed user is stored in database
            if (empty($this->errors)) {
                $followedId = (int)$data['followedId'];
                $followManager = new FollowManager();
                $success = $followManager->insertFollowed($userId, $followedId);
                $this->successes[] = $success;
            }
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function userFollowed(): string
    {

        if ($this->user) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data = array_map('trim', $_GET);
                // is there a userfollowed id ?
                if (isset($data['followedId']) && !empty($data['followedId'])) {
                    $userManager = new UserManager();
                    $photos = $userManager->selectUserPictures($data['followedId']);
                    $favManager = new FavManager();
                    $favIds = $favManager->selectUserFavs($this->user['id']);
                    $followManager = new FollowManager();
                    $userFollowed = $followManager->selectUsernameFollowedByUser($data['followedId']);
                    return $this->twig->render('User/followedUser.html.twig', [
                    'photos' => $photos,
                    'favIds' => $favIds,
                    'userFollowed' => $userFollowed,
                    ]);
                }
            }
        }
        header('location : /');
        die();
    }
}
