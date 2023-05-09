<?php

namespace App\Model;

use PDO;

class VoteManager extends AbstractManager
{
    public const TABLE = 'vote';

    //Checks if a user has already voted for a specific photo

    public function hasUserVotedForPhoto(int $userId, string $photoId): bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE user_id=:user_id AND photo_id=:photo_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':photo_id', $photoId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch() !== false;
    }

    //Adds a vote to a photo by a specific user

    public function addVote(string $photoId, int $userId): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (photo_id, user_id) VALUES (:photo_id, :user_id)");
        $stmt->bindParam(':photo_id', $photoId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    //Retrieves the IDs of the photos for which a specific user has voted

    public function getVotedPhotosByUser(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT photo_id FROM " . self::TABLE . " WHERE user_id=:user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $votedPhotosIds = [];
        foreach ($result as $row) {
            $votedPhotosIds[] = $row['photo_id'];
        }

        return $votedPhotosIds;
    }

    //Get the total number of votes for each photo

    public function getTotalVotesByPhoto(): array
    {
        $query = 'SELECT
        vote.photo_id AS photo_id,
        photo.user_id AS user_id,
        user.username AS username,
        COUNT(vote.id) AS total_votes
        FROM ' . self::TABLE . '
        JOIN photo ON photo.id = vote.photo_id
        JOIN user ON user.id = photo.user_id
        GROUP BY photo_id
        ORDER BY total_votes DESC';
        return $this->pdo->query($query)->fetchAll();
    }

    //Selects all photos with the total number of votes, in descending order of number of votes

    public function selectAllPhotosWithVotes()
    {
        $query = 'SELECT p.*,u.username, COUNT(v.photo_id) as total_votes
              FROM photo p
              LEFT JOIN user u ON p.user_id = u.id
              LEFT JOIN vote v ON p.id = v.photo_id
              GROUP BY p.id, u.username
              ORDER BY total_votes DESC';

        return $this->pdo->query($query)->fetchAll();
    }
}
