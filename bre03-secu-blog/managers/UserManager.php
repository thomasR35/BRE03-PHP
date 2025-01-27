<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class UserManager extends AbstractManager
{
    public function findByEmail(string $email): ?User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute(['email' => $email]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return (new User())
                ->setId((int)$row['id'])
                ->setUsername($row['username'])
                ->setEmail($row['email'])
                ->setPassword($row['password'])
                ->setRole($row['role'])
                ->setCreatedAt(new DateTime($row['created_at']));
        }
        return null;
    }

    public function create(User $user): void
    {
        $query = $this->db->prepare(
            'INSERT INTO users (username, email, password, role, created_at) 
             VALUES (:username, :email, :password, :role, :created_at)'
        );
        $query->execute([
            'username' => $user->getUsername(),
            'email' => htmlspecialchars($user->getEmail()), // Protection XSS
            'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT), // Sécurité
            'role' => $user->getRole(),
            'created_at' => $user->getCreatedAt()->format('Y-m-d H:i:s'),
        ]);
    }
}
