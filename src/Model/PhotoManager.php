<?php

namespace App\Model;

use PDO;

class PhotoManager extends AbstractManager
{
    public const TABLE = 'photo';

    /**
     * Insert new item in database
     */
    public function insert(array $item): int
    {
        $dbFields = '(`photo_title`,`photo_link`, `photo_prompt`, `photo_description`)';
        $placeholderFields = '(:photo_title, :photo_link, :photo_prompt, :photo_description)';
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " $dbFields VALUES $placeholderFields");
        $statement->bindValue('photo_title', $item['photo_title'], PDO::PARAM_STR);
        $statement->bindValue('photo_link', $item['photo_link'], PDO::PARAM_STR);
        $statement->bindValue('photo_prompt', $item['photo_prompt'], PDO::PARAM_STR);
        $statement->bindValue('photo_description', $item['photo_description'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }


    /**
     * Update item in database
     */
    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
