<?php

namespace App\Model;

use PDO;

class FollowManager extends AbstractManager
{
    public const TABLE = 'follower_followed';

    public function insertFollowed(int $idfav, int $userId): void
    {
        $dbFields = '(`photo_id`,`user_id`)';
        $placeholderFields = '(:photo_id, :user_id)';
        $whereFields = " WHERE photo_id=:photo_id AND user_id=:user_id";

        // request to test if a user is already followed
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . $whereFields);
        $statement->bindValue('photo_id', $idfav, PDO::PARAM_INT);
        $statement->bindValue('user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
        $isFav = $statement->fetch();
        // if user is not already a followed => follow him
        if (!$isFav) {
            $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " $dbFields VALUES $placeholderFields");
            $statement->bindValue('photo_id', $idfav, PDO::PARAM_INT);
            $statement->bindValue('user_id', $userId, PDO::PARAM_INT);
            $statement->execute();
        }
        // if user is followed => delete following
        if ($isFav) {
            $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . $whereFields);
            $statement->bindValue('photo_id', $idfav, PDO::PARAM_INT);
            $statement->bindValue('user_id', $userId, PDO::PARAM_INT);
            $statement->execute();
        }
    }
}
