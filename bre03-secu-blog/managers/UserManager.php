<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class UserManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    // Retourne un utilisateur par son email
    public function findByEmail(string $email): ?User
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User(
                $result['id'],
                $result['username'],
                $result['email'],
                $result['password'],
                $result['role'],
                new DateTime($result['created_at'])
            );
        }

        return null;
    }

    // Insère un utilisateur dans la base de données
    public function create(User $user): void
    {
        $query = $this->db->prepare("
             INSERT INTO users (username, email, password, role, created_at) 
             VALUES (:username, :email, :password, :role, :createdAt)
         ");
        $query->execute([
            'username' => $user->Getusername(),
            'email' => $user->Getemail(),
            'password' => $user->Getpassword(), // Hash du mot de passe à effectuer avant l'appel
            'role' => $user->Getrole(),
            'createdAt' => $user->GetcreatedAt()->format('Y-m-d H:i:s')
        ]);
    }
}
