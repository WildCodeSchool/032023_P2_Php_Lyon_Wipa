<?php

namespace App\Model;

use PDO;

class FollowManager extends AbstractManager
{
    public const TABLE = 'follower_followed';

    public function insertFollowed(int $idFollower, int $idFollowed): void
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
    }
}
