<?php

require_once '../Core/DbConnect.php';
require_once '../Entities/Commentaire.php';

class CommentaireModel extends DbConnect
{
     // Ajouter un commentaire
     public function addComment($comment) {
        // Récupérer les valeurs en utilisant les getters de l'objet $comment
        $texte = $comment->getTexte();
        $date = $comment->getDate();
        $statut = $comment->getStatut();
        $id_user = $comment->getId_user();
        $id_event = $comment->getId_event();
    
        // Construire la requête SQL directement sans préparation
        $this->request = "INSERT INTO Commentaire (texte, date, statut, id_user, id_event)
                  VALUES ('$texte', '$date', '$statut', '$id_user', '$id_event')";
    
        // Connexion à la base de données (exemple simple)
        
        
        // Exécution de la requête
        $result = $this->connection->query($this->request);
    
        // Retourner le résultat de l'exécution de la requête
        return $result;  // Retourne vrai si l'exécution réussie, faux sinon
    }
    

    // Récupérer les commentaires visibles d'un événement
    public function getVisibleComments($id_event) {
        $this->request = "SELECT commentaire.id_commentaire, commentaire.id_user, commentaire.texte, commentaire.date, user.name, user.surname, commentaire.statut
                  FROM commentaire
                  JOIN user ON commentaire.id_user = user.id_user
                  WHERE commentaire.id_event = $id_event 
                  ORDER BY commentaire.date DESC";
        $result = $this->connection->query($this->request);
        return $result->fetchAll();
    }
    

    // Modifier le statut d'un commentaire
    public function updateCommentStatus($id_commentaire, $new_status, $id_user) {
        //var_dump($id_commentaire, $new_status);
         //die;
        $this->request = "UPDATE Commentaire SET statut = '$new_status' WHERE id_commentaire = $id_commentaire";
        return $this->connection->query($this->request);
    }
    public function getCommentaire($id_user) {
     
        $this->request = "SELECT commentaire.id_commentaire, event.name, commentaire.texte, commentaire.statut, commentaire.date, commentaire.id_user
                          FROM commentaire
                          JOIN event ON commentaire.id_event = event.id_event
                          WHERE commentaire.id_user = $id_user";
        // Effectuer la requête
        $result = $this->connection->query($this->request);
    
        // Retourner les résultats sous forme de tableau associatif
        $recherche = $result->fetchAll(); // Récupère les événements correspondant à la recherche
        return $recherche; // Retourne les résultats de recherche
    }
    public function deleteCommentaireById($id_commentaire) {
        // Supprime un utilisateur par son ID
        $this->request = "DELETE FROM Commentaire WHERE id_commentaire = $id_commentaire";
        return $this->connection->exec($this->request);
}
}
