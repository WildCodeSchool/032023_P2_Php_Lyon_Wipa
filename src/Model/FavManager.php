<?php

namespace App\Model;

use PDO;

class FavManager extends AbstractManager
{
    public const TABLE = 'fav_photo';

    public function insertfav(int $idfav, int $userId): void
    {
        $dbFields = '(`fav_photo_id`,`fav_user_id`)';
        $placeholderFields = '(:fav_photo_id, :fav_user_id)';
        $whereFields = " WHERE fav_photo_id=:fav_photo_id AND fav_user_id=:fav_user_id";

        // request to test if a photo is already a fav
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . $whereFields);
        $statement->bindValue('fav_photo_id', $idfav, PDO::PARAM_INT);
        $statement->bindValue('fav_user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
        $isFav = $statement->fetch();
        // if photo is not already a favorite => add it as favorite
        if (!$isFav) {
            $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " $dbFields VALUES $placeholderFields");
            $statement->bindValue('fav_photo_id', $idfav, PDO::PARAM_INT);
            $statement->bindValue('fav_user_id', $userId, PDO::PARAM_INT);
            $statement->execute();
        }
    }
}
