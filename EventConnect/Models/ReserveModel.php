<?php

require_once '../Core/DbConnect.php';
require_once '../Entities/Reserve.php';

/**
 * Class et
 * Gère les opérations CRUD pour les créations
 */
class ReserveModel extends DbConnect
{
    public function addReservation($reserve) {
        $id_user = $reserve->getId_user();
        $id_event = $reserve->getId_event();
        $places = $reserve->getPlaces();

        // Insérer directement les données dans la base de données sans requête préparée
        $query = "INSERT INTO Reserve (id_user, id_event, places) VALUES ('$id_user', '$id_event', '$places')";

        // Exécution de la requête
        return $this->connection->exec($query);
    }

    public function getUserReservations($id_user) {
     
        $this->request = "SELECT r.id_reserve, e.name, e.date, r.places
                          FROM Reserve r
                          JOIN Event e ON r.id_event = e.id_event
                          WHERE r.id_user = ".$id_user; 
    
        // Effectuer la requête
        $result = $this->connection->query($this->request);
    
        // Retourner les résultats sous forme de tableau associatif
        $recherche = $result->fetchAll(); // Récupère les événements correspondant à la recherche
        return $recherche; // Retourne les résultats de recherche
    }
    public function deleteReserveById($id_reserve) {
        // Supprime un utilisateur par son ID
        $this->request = "DELETE FROM Reserve WHERE id_reserve = $id_reserve";
        return $this->connection->exec($this->request);
}
    public function find(Event $id_events) {
    $id = $id_events->getId_event(); // Récupère l'ID de l'événement à mettre à jour
    $this->request = "SELECT * FROM Event WHERE id_event = $id"; // Requête SQL pour trouver l'événement
    $result = $this->connection->query($this->request); // Exécution de la requête
    $events = $result->fetch(); // Récupère l'événement spécifique
    return $events; // Retourne l'événement trouvé
}
public function addRegistration($id_user, $id_event, $places) {
    // Requête SQL pour ajouter l'inscription
    $this->request = "INSERT INTO Reserve (id_reserve, id_user, id_event, places) 
                      VALUES (null, $id_user,$id_event, $places)";
    
    // Exécution de la requête
    return $this->connection->exec($this->request);
}

}

