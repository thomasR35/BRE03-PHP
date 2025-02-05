<?php

namespace App;

/**
 * Classe Guard
 * 
 * Cette classe gère les accès aux articles (`Post`) en fonction des rôles des utilisateurs (`User`).
 */
class Guard
{
    /**
     * Attribue un accès à un utilisateur en fonction de la confidentialité d'un post.
     *
     * @param Post $post - L'article concerné.
     * @param User $user - L'utilisateur qui demande l'accès.
     * @return User - L'utilisateur avec les rôles mis à jour.
     * 
     * @throws \Exception - Si l'utilisateur est anonyme et tente d'accéder à un post privé.
     */
    public function giveAccess(Post $post, User $user): User
    {
        // 🔹 Si le post est privé et que l'utilisateur est ANONYMOUS, on refuse l'accès (exception levée).
        if ($post->isPrivate() && in_array("ANONYMOUS", $user->getRoles())) {
            throw new \Exception("L’utilisateur ne peut pas être anonyme.");
        }

        // 🔹 Si le post est privé et que l'utilisateur est USER, on le promeut en ADMIN.
        if ($post->isPrivate() && in_array("USER", $user->getRoles())) {
            $user->addRole("ADMIN");
        }

        // 🔹 Si le post est public et que l'utilisateur est ANONYMOUS, il devient USER.
        if (!$post->isPrivate() && in_array("ANONYMOUS", $user->getRoles())) {
            $user->addRole("USER");
        }

        return $user;
    }

    /**
     * Révoque l'accès d'un utilisateur en fonction de la confidentialité d'un post.
     *
     * @param Post $post - L'article concerné.
     * @param User $user - L'utilisateur dont l'accès est modifié.
     * @return User - L'utilisateur avec les rôles mis à jour.
     */
    public function removeAccess(Post $post, User $user): User
    {
        // 🔹 Cas où le post est privé
        if ($post->isPrivate()) {
            // Si l'utilisateur est ADMIN, il redevient USER.
            if (in_array("ADMIN", $user->getRoles())) {
                $user->removeRole("ADMIN");
                if (!in_array("USER", $user->getRoles())) {
                    $user->addRole("USER"); // ✅ Assure qu'il reste USER après suppression d'ADMIN.
                }
            }
            // Si l'utilisateur est USER, il devient ANONYMOUS.
            elseif (in_array("USER", $user->getRoles())) {
                $user->removeRole("USER");
            }
        }

        // 🔹 Cas où le post est public
        else {
            // Si l'utilisateur est ADMIN, il devient USER.
            if (in_array("ADMIN", $user->getRoles())) {
                $user->removeRole("ADMIN");
                if (!in_array("USER", $user->getRoles())) {
                    $user->addRole("USER"); // ✅ Assure qu'il reste USER après suppression d'ADMIN.
                }
            }
            // Si l'utilisateur est USER, il devient ANONYMOUS.
            elseif (in_array("USER", $user->getRoles())) {
                $user->removeRole("USER");
            }
        }

        // ✅ Réindexation des rôles après modification pour éviter des index non séquentiels.
        $userRoles = array_values($user->getRoles());
        $user->setRoles($userRoles);

        return $user;
    }
}
