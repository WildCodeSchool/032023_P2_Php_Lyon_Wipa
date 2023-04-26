<?php

namespace App\Model;

use App\Model\Connection;
use PDO;

/**
 * Abstract class handling default manager.
 */
abstract class AbstractManager
{
    protected PDO $pdo;

    public const TABLE = '';

    public function __construct()
    {
        $connection = new Connection();
        $this->pdo = $connection->getConnection();
    }

    /**
     * Get all row from database.
     */
    public function selectAll(string $orderBy = '', string $direction = 'ASC', string $limit = 'NONE'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        if ($limit !== 'NONE') {
            $query .= ' LIMIT ' . $limit;
        }

        return $this->pdo->query($query)->fetchAll();
    }


    /**
     * Get one row from database by ID.
     */
    public function selectOneById(int $id): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    /**
     * Delete row form an ID
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function selectUserByName(string $username): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM user WHERE username = :username");
        $statement->bindValue(':username', $username, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public function selectAllFav(int $id): array
    {
        $query = "SELECT *
                  FROM fav_photo 
                  INNER JOIN photo 
                  ON fav_photo.photo_id = photo.id 
                  WHERE fav_photo.user_id = $id";

        return $this->pdo->query($query)->fetchAll();
    }
}
