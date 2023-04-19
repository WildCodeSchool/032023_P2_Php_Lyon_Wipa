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
    public function insert(array $item): void
    {
        // get current time
        $atz = 'Europe/Paris';
        $timestamp = time();
        $adt = new DateTime("now", new DateTimeZone($atz)); //first argument "must" be a string
        $adt->setTimestamp($timestamp); //adjust the object to correct timestamp
        $formatedDate = $adt->format('Y-m-d H:i:s');
        // PDO statements
        $dbFields = '(`photo_title`, `photo_link`, `photo_prompt`, `photo_description`, `photo_date`)';
        $placeholderFields = '(:photo_title, :photo_link, :photo_prompt, :photo_description, :photo_date)';
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " $dbFields VALUES $placeholderFields");
        $statement->bindValue('photo_title', $item['title'], PDO::PARAM_STR);
        $statement->bindValue('photo_link', $item['picture'], PDO::PARAM_STR);
        $statement->bindValue('photo_prompt', $item['prompt'], PDO::PARAM_STR);
        $statement->bindValue('photo_description', $item['description'], PDO::PARAM_STR);
        $statement->bindValue('photo_date', $formatedDate, PDO::PARAM_STR);
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
