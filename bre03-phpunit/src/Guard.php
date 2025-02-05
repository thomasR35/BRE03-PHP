<?php

namespace App;

class Guard
{
    public function giveAccess(Post $post, User $user): User
    {
        if ($post->isPrivate() && in_array("ANONYMOUS", $user->getRoles())) {
            throw new \Exception("L’utilisateur ne peut pas être anonyme.");
        }

        if ($post->isPrivate() && in_array("USER", $user->getRoles())) {
            $user->addRole("ADMIN");
        }

        if (!$post->isPrivate() && in_array("ANONYMOUS", $user->getRoles())) {
            $user->addRole("USER");
        }

        return $user;
    }

    public function removeAccess(Post $post, User $user): User
    {
        if ($post->isPrivate()) {
            if (in_array("ADMIN", $user->getRoles())) {
                $user->removeRole("ADMIN");
                if (!in_array("USER", $user->getRoles())) {
                    $user->addRole("USER"); // ✅ S'assurer qu'il reste USER après suppression d'ADMIN
                }
            } elseif (in_array("USER", $user->getRoles())) {
                $user->removeRole("USER");
            }
        } else {
            if (in_array("ADMIN", $user->getRoles())) {
                $user->removeRole("ADMIN");
                if (!in_array("USER", $user->getRoles())) {
                    $user->addRole("USER"); // ✅ Garde USER après suppression de ADMIN
                }
            } elseif (in_array("USER", $user->getRoles())) {
                $user->removeRole("USER");
            }
        }
        // ✅ Réindexation des rôles après modification
        $userRoles = array_values($user->getRoles());
        $user->setRoles($userRoles);
        return $user;
    }
}
