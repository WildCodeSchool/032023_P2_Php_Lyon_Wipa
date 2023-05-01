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
        header("Location: /user");
    }
}
