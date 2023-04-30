<?php

namespace App\Controller;

use App\Model\FollowManager;

class FollowController extends AbstractController
{
    public function toggleFollow(): void
    {
        // allowed only for users
        if (!$this->user) {
            header('Location: /');
            exit();
        }

        $errors = [];
        $userId = $this->user['id'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = array_map('trim', $_POST);
            // is there a followed id ?
            if (!isset($data['followedId']) || empty($data['followedId'])) {
                $errors[] = 'No user to be followed';
            }
            // user can't follow himself
            if ($data['followedId'] == $userId) {
                $errors[] = 'You can\'t follow yourself !';
            }
            // if validated, followed user is stored in database
            if (empty($errors)) {
                $followedId = (int)$data['followedId'];
                $followManager = new FollowManager();
                $followManager->insertFollowed($userId, $followedId);
            }
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
