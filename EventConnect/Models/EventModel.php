<?php

require_once '../Core/DbConnect.php';
require_once '../Entities/Event.php';

/**
 * Class EventModel
 * Gère les opérations CRUD pour les événements
 */
class EventModel extends DbConnect
{
    // findAll ----------------- (Vue : displayEvent)
    //-------------------------
    public function findAll() {
        // Requête SQL pour récupérer tous les événements avec leur catégorie associée
        $this->request = "SELECT Event.*, Category.name AS category_name
                          FROM Event
                          JOIN Category ON Event.id_category = Category.id_category";
        $result = $this->connection->query($this->request); // Exécution de la requête
        $events = $result->fetchAll(); // Récupération de tous les événements
        return $events; // Retourne tous les événements
    }

    // findEvent ----------------- (Vue : findEvent)
    //---------------------------
    public function findEvent($id_event) {
        // Requête SQL pour récupérer un événement spécifique par son ID
        $this->request = "SELECT Event.*, Category.name AS category_name
                          FROM Event
                          JOIN Category ON Event.id_category = Category.id_category
                          WHERE id_event = $id_event";
        
        $result = $this->connection->query($this->request); // Exécution de la requête
        $event = $result->fetch();  // Récupère une seule ligne correspondant à l'événement
        return $event; // Retourne l'événement trouvé
    }

    // findByCategory ----------------- (Vue : displayEvent)
    //-----------------------------------
    public function findByCategory($categoryId = null) {
        if ($categoryId) {
            // Si une catégorie est spécifiée, on filtre par catégorie
            $this->request = "SELECT Event.*, Category.name AS category_name 
                              FROM Event 
                              JOIN Category ON Event.id_category = Category.id_category 
                              WHERE Event.id_category = $categoryId";
        } else {
            // Sinon, on récupère tous les événements sans filtrer
            $this->request = "SELECT Event.*, Category.name AS category_name 
                              FROM Event 
                              JOIN Category ON Event.id_category = Category.id_category";
        }

        $sql = $this->connection->query($this->request); // Exécution de la requête
        return $sql; // Retourne les événements filtrés ou non par catégorie
    }

    // listeCompet ----------------- (Vue : displayCompet)
    //----------------------------
    public function listeCompet($idCompet= 4) {
        // Requête SQL pour récupérer tous les événements d'une catégorie spécifique (compétition)
        $this->request = "SELECT * FROM Event WHERE id_category = $idCompet";
        $result = $this->connection->query($this->request); // Exécution de la requête
        $compet = $result->fetchAll(); // Récupère tous les événements de compétitions

        if ($compet === NULL || empty($compet)) {
            echo "Aucune compétitions disponible."; // Si aucun événement trouvé
        } else {
            return $compet; // Retourne la liste des compétitions
        }
    }

    // add ----------------- (Vue : addEvent)
    //----------------------
    public function add(Event $events) {
        // Sécurisation des données d'entrée avant insertion dans la base de données
        $name = addslashes($events->getName());
        $date = addslashes($events->getDate());
        $description = addslashes($events->getDescription());
        $category = addslashes($events->getId_category());
        
        // Requête SQL pour ajouter un nouvel événement
        $this->request = "INSERT INTO Event VALUES (null, '$name', '$date', '$description', '$category')";
        $success = $this->connection->exec($this->request); // Exécution de la requête
        return $success; // Retourne si l'insertion a réussi ou non
    }

    // find ----------------- (Vue : updateEvent)
    //-----------------------
    public function find(Event $events) {
        $id = $events->getId_event(); // Récupère l'ID de l'événement à mettre à jour
        $this->request = "SELECT * FROM Event WHERE id_event = $id"; // Requête SQL pour trouver l'événement
        $result = $this->connection->query($this->request); // Exécution de la requête
        $events = $result->fetch(); // Récupère l'événement spécifique
        return $events; // Retourne l'événement trouvé
    }

    // update ----------------- (Vue : updateEvent)
    //-------------------------
    public function update(Event $events) {
        // Récupération des données de l'événement à mettre à jour
        $id = $events->getId_event();
        $name = $events->getName();
        $date = $events->getDate();
        $description = $events->getDescription();
        $category = $events->getId_category();
        
        // Assignation de valeurs par défaut si certains champs sont vides
        if (empty($date)) {
            $date = date('Y-m-d H:i:s'); // Format SQL pour les dates
        }

        if (empty($name)) {
            $name = 'Titre par défaut';
        }

        if (empty($description)) {
            $description = 'Description par défaut';
        }

        // Requête SQL pour mettre à jour l'événement
        $this->request = "
            UPDATE Event 
            SET name = :name, 
                date = :date, 
                description = :description, 
                id_category = :category 
            WHERE id_event = :id
        ";

        try {
            // Prépare et exécute la requête SQL de mise à jour
            $stmt = $this->connection->prepare($this->request);
            $stmt->execute([
                ':name' => $name,
                ':date' => $date,
                ':description' => $description,
                ':category' => $category,
                ':id' => $id
            ]);
            return $stmt->rowCount(); // Retourne le nombre de lignes mises à jour

        } catch (PDOException $e) {
            echo 'Erreur SQL : ' . $e->getMessage(); // Si une erreur se produit, l'afficher
        }
    }

    // delete ----------------- (Vue : deleteEvent)
    //------------------------
    public function delete(Event $event) {
        $id = $event->getId_event(); // Récupère l'ID de l'événement à supprimer
        $this->request = "DELETE FROM Event WHERE id_event = $id"; // Requête SQL pour supprimer l'événement
        return $this->connection->exec($this->request); // Exécution de la requête
    }

    // searchBarre ----------------- (Vue : displayEvent)
    //-----------------------------
    public function searchBarre() {
        $search = $_POST['search'] ?? null; // Récupère le terme de recherche
        
        // Si un terme de recherche est fourni
        if ($search) {
            // Requête SQL pour rechercher les événements, catégories et descriptions
            $this->request = "SELECT Event.*, Category.name AS category_name 
                              FROM Event 
                              JOIN Category ON Event.id_category = Category.id_category
                              WHERE Event.name LIKE '%" . $search . "%' 
                                 OR Event.description LIKE '%" . $search . "%' 
                                 OR Category.name LIKE '%" . $search . "%'";
            $resultat = $this->connection->query($this->request);
            $recherche = $resultat->fetchAll(); // Récupère les événements correspondant à la recherche
            return $recherche; // Retourne les résultats de recherche
        } else {
            // Si aucun terme de recherche, retourne tous les événements
            $this->request = "SELECT Event.*, Category.name AS category_name 
                              FROM Event 
                              JOIN Category ON Event.id_category = Category.id_category";
            $resultat = $this->connection->query($this->request);
            $recherche = $resultat->fetchAll(); // Récupère tous les événements
            return $recherche; // Retourne tous les événements
        }
    }

    public function listUserEvent() {
        // Requête SQL pour récupérer les événements et les utilisateurs inscrits
        $this->request = "SELECT event.id_event, event.name AS event_name, event.description, event.date,
                          user.id_user, user.name AS user_name, user.surname AS user_surname,
                         SUM(reserve.places) AS reserved_places
                         FROM event
                        LEFT JOIN reserve ON event.id_event = reserve.id_event
                        LEFT JOIN user ON reserve.id_user = user.id_user
                        GROUP BY event.id_event, user.id_user
                        ORDER BY event.date DESC";
        
        // Exécution de la requête
        $stmt = $this->connection->query($this->request);
        
        // Récupérer les résultats directement avec fetchAll
        $events = $stmt->fetchAll();
        return $events;
    }
}    
        
