<?php

require_once '../Core/DbConnect.php';
require_once '../Entities/User.php';

class UserModel extends DbConnect
{
    // add ----------------- (Vue : subscribe)
    //----------------------
    public function add(User $user)
    {
        // Récupération des informations de l'utilisateur
        $name = $user->getName();
        $surname = $user->getSurname();
        $mail = $user->getMail();
        $mdp = $user->getMdp();
        $statut = $user->getStatut();
        
        // Insertion dans la table User
        $this->request = "INSERT INTO User (id_user, name, surname, mail, mdp, statut) 
                          VALUES (null, '$name', '$surname', '$mail', '$mdp', '$statut')";
        return $this->connection->exec($this->request); // Exécute la requête
    }
    public function existsByEmail($mail) {
        // Vérifie si un utilisateur existe déjà avec l'email spécifié
        $this->request = "SELECT COUNT(*) as count FROM User WHERE mail = :mail";
        $stmt = $this->connection->prepare($this->request);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result->count > 0; // Retourne true si un utilisateur existe déjà avec cet email
    }

    // find ----------------- (Vue : login)
    //---------------------
    public function find($mail)
    {
        // Recherche un utilisateur par son email
        $this->request = $this->connection->prepare("SELECT * FROM User WHERE mail = :mail");
        $this->request->bindParam(":mail", $mail);
        $this->request->execute();
        $user = $this->request->fetch(); // Récupère l'utilisateur correspondant
        return $user; // Retourne les informations de l'utilisateur
    }

    // findAll ----------------- (Vue : admin)
    //-------------------------
    public function findAll()
    {
        // Récupère tous les événements
        $this->request = "SELECT * FROM Event";
        $result = $this->connection->query($this->request);
        $events = $result->fetchAll(); // Récupère tous les événements
        return $events; // Retourne la liste des événements
    }

    // findUser ----------------- (Vue : null)
    //--------------------------
    public function findUser(User $user) {
        // Vérifie si un utilisateur est connecté via la session
        if (isset($_SESSION['id_user'])) {
            $user->setId_user($_SESSION['id_user']);
            return $user; // Retourne l'utilisateur connecté
        }
        return null; // Retourne null si aucun utilisateur n'est connecté
    }

    // findUserById ----------------- (Vue : null)
    //--------------------------------
    public function findUserById($id_user) {
        // Recherche un utilisateur par son ID
        $query = "SELECT * FROM User WHERE id_user = $id_user";
        $result = $this->connection->query($query);
        return $result->fetch(); // Retourne l'utilisateur trouvé
    }

    // updateUser ----------------- (Vue : userUpdate)
    //-----------------------------
    public function updateUser($id_user, $name, $surname, $mail, $mdp) {
        // Met à jour les informations d'un utilisateur
        $query = "UPDATE User 
                  SET name = '$name', surname = '$surname', mail = '$mail', mdp='$mdp' 
                  WHERE id_user = $id_user";
        $this->connection->exec($query); // Exécute la requête de mise à jour
    }

    // ForDeleteUserById ----------------- (Vue : deleteUser)
    //------------------------------------
    public function ForDeleteUserById($id_user) {
        // Vérifie si un utilisateur existe avant de le supprimer
        $query = "SELECT * FROM User WHERE id_user = $id_user";
        $result = $this->connection->query($query);
        return $result->fetch(); // Retourne l'utilisateur trouvé
    }
    public function deleteUserById($id_user) {
        // Supprime un utilisateur par son ID
        $this->request = "DELETE FROM Commentaire WHERE id_user = $id_user";
        $this->connection->exec($this->request);
        $this->request = "DELETE FROM Reserve WHERE id_user = $id_user";
        $this->connection->exec($this->request);
        $this->request = "DELETE FROM User WHERE id_user = $id_user";
        $this->connection->exec($this->request); // Exécute la suppression
        session_destroy(); // Détruit la session
    }

    // Récupérer un utilisateur par ID (sans sécurité)
    // Récupérer un utilisateur par ID (méthode simplifiée)
    public function getUserById($id_user) {
        // Exécution de la requête SQL
        $query = "SELECT * FROM User WHERE id_user = $id_user";
        
        // Exécution de la requête
        $result = $this->connection->query($query);

        // Si la requête retourne un résultat, on récupère le premier enregistrement
        if ($result) {
            // Nous récupérons directement le premier enregistrement de l'utilisateur
            return $result->fetchAll();
        } else {
            // Si aucun résultat trouvé, retourner null
            return null;
        }
    }
}
