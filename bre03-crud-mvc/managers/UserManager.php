<?php

class UserManager extends AbstractManager
{
    public const TABLE = 'users';

    public function insert(User $user): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (email, first_name, last_name) VALUES (:email, :first_name, :last_name)");
        $statement->bindValue('email', $user->getEmail(), PDO::PARAM_STR);
        $statement->bindValue('first_name', $user->getFirstName(), PDO::PARAM_STR);
        $statement->bindValue('last_name', $user->getLastName(), PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function update(User $user): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET email = :email, first_name = :first_name, last_name = :last_name WHERE id = :id");
        $statement->bindValue('id', $user->getId(), PDO::PARAM_INT);
        $statement->bindValue('email', $user->getEmail(), PDO::PARAM_STR);
        $statement->bindValue('first_name', $user->getFirstName(), PDO::PARAM_STR);
        $statement->bindValue('last_name', $user->getLastName(), PDO::PARAM_STR);

        return $statement->execute();
    }

    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function selectOneById(int $id): ?User
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();

        $userData = $statement->fetch(PDO::FETCH_ASSOC);
        if ($userData === false) {
            return null;
        }

        return new User(
            $userData['email'],
            $userData['first_name'],
            $userData['last_name'],
            (int)$userData['id']
        );
    }

    public function selectAll(): array
    {
        $statement = $this->pdo->query("SELECT * FROM " . self::TABLE);
        $usersData = $statement->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($usersData as $userData) {
            $users[] = new User(
                $userData['email'],
                $userData['first_name'],
                $userData['last_name'],
                (int)$userData['id']
            );
        }

        return $users;
    }
}
