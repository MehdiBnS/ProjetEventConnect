<?php

abstract class Controller {

    
    public function render($view, $data = []) {
        extract($data); // Extrait les données du tableau pour les rendre accessibles dans la vue
        require_once '../Views/header.php'; // Inclut le header de la page
        require_once '../Views/'. $view . '.php'; // Inclut la vue dynamique spécifiée par le contrôleur
        require_once '../Views/footer.php'; // Inclut le footer de la page
    }
}
