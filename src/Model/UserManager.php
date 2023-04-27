<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectUserByName(string $username): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM user WHERE username = :username");
        $statement->bindValue(':username', $username, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public function selectUserPictures(int $userId): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM photo WHERE user_id = :userId");
        $statement->bindValue(':userId', $userId, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectAllFavs(int $userId): array
    {
        $query = "SELECT *
                  FROM fav_photo 
                  INNER JOIN photo 
                  ON fav_photo.photo_id = photo.id 
                  WHERE fav_photo.user_id = $userId";

        return $this->pdo->query($query)->fetchAll();
    }
}
