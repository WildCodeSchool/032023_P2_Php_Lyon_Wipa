<?php

namespace App\Model;

use PDO;

class FavManager extends AbstractManager
{
    public const TABLE = 'fav_photo';

    public function insertfav(int $idfav): void
    {
        $dbFields = '(`fav_photo_id`,`fav_user_id`)';
        $placeholderFields = '(:fav_photo_id, :fav_user_id)';
        $whereFields = " WHERE fav_photo_id=:fav_photo_id AND fav_user_id=:fav_user_id";

        // request to test if a photo is already a fav
        $stm = $this->pdo->prepare("SELECT * FROM " . static::TABLE . $whereFields);
        $stm->bindValue('fav_photo_id', $idfav, PDO::PARAM_INT);
        $stm->bindValue('fav_user_id', 1, PDO::PARAM_INT);
        $stm->execute();
        $test = $stm->fetch();
        // if photo is not already a favorite => add it as favorite
        if (!$test) {
            $stm = $this->pdo->prepare("INSERT INTO " . self::TABLE . " $dbFields VALUES $placeholderFields");
            $stm->bindValue('fav_photo_id', $idfav, PDO::PARAM_INT);
            $stm->bindValue('fav_user_id', 1, PDO::PARAM_INT);
            $stm->execute();
        }
    }
}
