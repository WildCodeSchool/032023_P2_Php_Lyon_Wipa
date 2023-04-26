<?php

namespace App\Model;

use PDO;

class FavManager extends AbstractManager
{
    public const TABLE = 'fav_photo';

    public function insertfav(int $idfav, int $userId): void
    {
        $dbFields = '(`photo_id`,`user_id`)';
        $placeholderFields = '(:photo_id, :user_id)';
        $whereFields = " WHERE photo_id=:photo_id AND user_id=:user_id";

        // request to test if a photo is already a fav
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . $whereFields);
        $statement->bindValue('photo_id', $idfav, PDO::PARAM_INT);
        $statement->bindValue('user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
        $isFav = $statement->fetch();
        // if photo is not already a favorite => add it as favorite
        if (!$isFav) {
            $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " $dbFields VALUES $placeholderFields");
            $statement->bindValue('photo_id', $idfav, PDO::PARAM_INT);
            $statement->bindValue('user_id', $userId, PDO::PARAM_INT);
            $statement->execute();
        }
        // if photo is a favorite => delete from favorites
        if ($isFav) {
            $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . $whereFields);
            $statement->bindValue('photo_id', $idfav, PDO::PARAM_INT);
            $statement->bindValue('user_id', $userId, PDO::PARAM_INT);
            $statement->execute();
        }
    }
    public function selectUserFavs(int $userId): array
    {
        $query = "SELECT fav_photo.photo_id AS id
        FROM fav_photo
        WHERE user_id = " . $userId;

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectAllUserFavs(): array
    {
        $query = "SELECT photo_id FROM fav_photo GROUP BY photo_id ORDER BY COUNT(*) DESC";

        return $this->pdo->query($query)->fetchAll();
    }
}
