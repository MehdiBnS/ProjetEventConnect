<?php

/**
 * Class Router
 * Gère les routes de l'application
 */
class Router
{

    private $controller;
    private $action;

    /**
     * Définit les routes de l'application
     */
    public function routes()
    {

        // Définir le contrôleur à partir du paramètre GET 'controller', ou utiliser 'HomeController' par défaut
        $this->controller = isset($_GET['controller']) ? $_GET['controller'] . 'Controller' : 'HomeController';

        // Définir l'action à partir du paramètre GET 'action', ou utiliser 'homeAction' par défaut
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'homeAction';

        // Inclure le fichier du contrôleur correspondant
        require_once '../Controllers/' . $this->controller . '.php';

        // Créer une instance du contrôleur
        $controller = new $this->controller();

        // Vérifier si la méthode existe dans le contrôleur, sinon utiliser 'error404'
        $method = method_exists($controller, $this->action) ? $this->action : 'error404';

        // Appeler la méthode du contrôleur
        $controller->$method();
    }
}