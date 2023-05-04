<?php

namespace App\Model;

use PDO;

class FollowManager extends AbstractManager
{
    public const TABLE = 'follower_followed';

    public function insertFollowed(int $idFollower, int $idFollowed): string
    {
        // idFollower = current user
        // idFollowed = somebody user wants to follow

        // request to test if a user is already followed
        $statement = $this->pdo->prepare(
            '
            SELECT * 
            FROM ' . self::TABLE . ' 
            WHERE follower_id=:follower_id
            AND user_id=:followed_id'
        );
        $statement->bindValue('follower_id', $idFollower, PDO::PARAM_INT);
        $statement->bindValue('followed_id', $idFollowed, PDO::PARAM_INT);
        $statement->execute();
        $isFollowed = $statement->fetch();

        // if user is followed => delete following
        $statement = $this->pdo->prepare(
            '
            DELETE FROM ' . self::TABLE . ' 
            WHERE follower_id=:follower_id
            AND user_id=:followed_id'
        );

        // if user is not already a followed => follow him
        if (!$isFollowed) {
            $statement = $this->pdo->prepare(
                '
                INSERT INTO ' . self::TABLE . ' 
                (`follower_id`,`user_id`) 
                VALUES 
                (:follower_id, :followed_id)'
            );
        }

        $statement->bindValue('follower_id', $idFollower, PDO::PARAM_INT);
        $statement->bindValue('followed_id', $idFollowed, PDO::PARAM_INT);
        $statement->execute();

        // get name of followed user
        $statement = $this->pdo->prepare(
            '
            SELECT username
            FROM user
            WHERE id=:followed_id
            '
        );
        $statement->bindValue('followed_id', $idFollowed, PDO::PARAM_INT);
        $statement->execute();
        $followedUsername = $statement->fetch();

        if (!$isFollowed) {
            return ('You are now following ' . $followedUsername['username']);
        }
        return ('User ' . $followedUsername['username'] . ' already followed.');
    }

    public function selectFollowedByUser(string $userId): array
    {
        $query = '
        SELECT follower_followed.user_id, user.username as username
        FROM ' . self::TABLE . ' 
        JOIN user ON follower_followed.user_id = user.id
        WHERE follower_id=' . $userId;

        return $this->pdo->query($query)->fetchAll();
    }
}
