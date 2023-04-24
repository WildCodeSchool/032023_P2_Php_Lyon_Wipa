<?php

namespace App\Model;

use PDO;

class RegisterManager extends AbstractManager
{
    public const TABLE = 'user';

    public function insert(string $username, string $password): void
    {

        // PDO statements
        $dbFields = '(`username`, `password`, `role`)';
        $placeholderFields = '(:username, :password, :role)';
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " $dbFields VALUES $placeholderFields");
        $statement->bindValue('username', $username, PDO::PARAM_STR);
        $statement->bindValue('password', password_hash($password, PASSWORD_DEFAULT));
        $statement->bindValue('role', 'user', PDO::PARAM_STR);
        $statement->execute();
    }
}
