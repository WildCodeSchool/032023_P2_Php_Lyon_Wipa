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
    public function insert(array $item, int $photoId): void
    {
        // get current time
        $actualTimeZone = 'Europe/Paris';
        $timestamp = time();
        $actualDateTime = new DateTime("now", new DateTimeZone($actualTimeZone)); //first argument "must" be a string
        $actualDateTime->setTimestamp($timestamp); //adjust the object to correct timestamp
        $formatedDate = $actualDateTime->format('Y-m-d H:i:s');
        // PDO statements
        $dbFields = '(`title`, `link`, `prompt`, `description`, `date`, `user_id`)';
        $placeholderFields = '(:title, :link, :prompt, :description, :date, :user_id)';
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " $dbFields VALUES $placeholderFields");
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);
        $statement->bindValue('link', $item['picture'], PDO::PARAM_STR);
        $statement->bindValue('prompt', $item['prompt'], PDO::PARAM_STR);
        $statement->bindValue('description', $item['description'], PDO::PARAM_STR);
        $statement->bindValue('date', $formatedDate, PDO::PARAM_STR);
        $statement->bindValue('user_id', $photoId, PDO::PARAM_INT);
        $statement->execute();
    }
    /**
     * Update a photo in database
     */
    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET 
        `title`=:title,
        `prompt`=:prompt,
        `description`=:description
         WHERE id=:id");
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);
        $statement->bindValue('prompt', $item['prompt'], PDO::PARAM_STR);
        $statement->bindValue('description', $item['description'], PDO::PARAM_STR);
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        return $statement->execute();
    }
    /**
     * select ALL favorites from ALL users and filter by desc likes
     */
    public function selectFavPhotos(int $userId): array
    {
        $query = 'SELECT f.photo_id, (COUNT(f.id) > 0) AS is_fav
                  FROM ' . self::TABLE . ' p
                  LEFT JOIN fav_photo f ON p.id = f.photo_id AND f.user_id = :id
                  GROUP BY p.id';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['id' => $userId]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * select ALL photos from ALL users and add username => to be used to follow somebody
     */
    public function selectAllWithUsername(string $orderBy = '', string $direction = 'DESC'): array
    {
        $query = 'SELECT 
        photo.id, 
        photo.title, 
        photo.link, 
        photo.prompt, 
        photo.description, 
        photo.date, 
        photo.user_id, 
        user.username as username
        FROM ' . self::TABLE . ' 
        JOIN user ON photo.user_id = user.id';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        return $this->pdo->query($query)->fetchAll();
    }
}
