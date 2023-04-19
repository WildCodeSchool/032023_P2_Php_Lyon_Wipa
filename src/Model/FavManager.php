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
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " $dbFields VALUES $placeholderFields");
        $statement->bindValue('fav_photo_id', $idfav, PDO::PARAM_INT);
        $statement->bindValue('fav_user_id', 1, PDO::PARAM_INT);
        $statement->execute();
    }
}
