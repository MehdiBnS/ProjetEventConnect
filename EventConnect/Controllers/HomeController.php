<?php
require_once 'Controller.php';

/**
 * Class HomeController
 * Gère les actions de la page d'accueil
 */
class HomeController extends Controller
{
    //homeAction -----------------
    //----------------------------
    public function homeAction()//Affichage de la page homeAction
    {
        $this->render('home/homeAction');
       
    }
  
}
