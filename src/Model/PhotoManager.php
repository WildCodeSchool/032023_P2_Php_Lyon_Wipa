<?php

namespace App\Model;

use DateTimeZone;
use DateTime;
use PDO;

class PhotoManager extends AbstractManager
{
    public const TABLE = 'photo';
    /**
     * Insert new photo in database
     */
    public function insert(array $item, int $id): void
    {
        // get current time
        $atz = 'Europe/Paris';
        $timestamp = time();
        $adt = new DateTime("now", new DateTimeZone($atz)); //first argument "must" be a string
        $adt->setTimestamp($timestamp); //adjust the object to correct timestamp
        $formatedDate = $adt->format('Y-m-d H:i:s');
        // PDO statements
        $dbFields = '(`title`, `link`, `prompt`, `description`, `date`, `user_id`)';
        $placeholderFields = '(:title, :link, :prompt, :description, :date, :user_id)';
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " $dbFields VALUES $placeholderFields");
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);
        $statement->bindValue('link', $item['picture'], PDO::PARAM_STR);
        $statement->bindValue('prompt', $item['prompt'], PDO::PARAM_STR);
        $statement->bindValue('description', $item['description'], PDO::PARAM_STR);
        $statement->bindValue('date', $formatedDate, PDO::PARAM_STR);
        $statement->bindValue('user_id', $id, PDO::PARAM_INT);
        $statement->execute();
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
