<?php

require_once '../Core/DbConnect.php';
require_once '../Entities/Category.php';

class CategoryModel extends DbConnect
{
    // listeCategory ----------------- (Vue : displayEvent)
    //--------------------------------------
    public function listeCategory() {
        // Requête SQL pour récupérer toutes les catégories avec leurs IDs et noms
        $this->request = "SELECT id_category, name FROM Category";
        $sql = $this->connection->query($this->request); // Exécution de la requête SQL
        $listes = $sql->fetchAll(); // Récupération des résultats sous forme de tableau
        return $listes; // Retourne la liste des catégories
    }
    
    public function listClick() {
        // Requête SQL pour récupérer toutes les catégories de la base de données
        $this->request = "SELECT * FROM Category";
        $sql = $this->connection->query($this->request); // Exécution de la requête SQL
        $click = $sql->fetchAll(); // Récupération des résultats sous forme de tableau
        return $click; // Retourne toutes les catégories
    }

    // listeUpdateCategory ----------------- (Vue : updateCategory)
    //--------------------------------------
    public function listeUpdateCategory() {
        // Requête SQL pour récupérer toutes les catégories pour les afficher dans un formulaire de mise à jour
        $this->request = "SELECT id_category, name FROM Category";
        $sql = $this->connection->query($this->request); // Exécution de la requête SQL
        $listes = $sql->fetchAll(); // Récupération des résultats sous forme de tableau
        return $listes; // Retourne la liste des catégories pour la mise à jour
    }

   
}
