<?php
class UserManager extends AbstractManager
{
    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUser($user)
    {
        $stmt = $this->db->prepare("INSERT INTO users (email, first_name, last_name) VALUES (:email, :first_name, :last_name)");
        $stmt->execute([
            'email' => $user->getEmail(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
        ]);
    }
}
