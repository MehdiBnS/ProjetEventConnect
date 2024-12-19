<?php

require_once 'Controller.php';
require_once '../Entities/Event.php';
require_once '../Entities/Category.php';
require_once '../Entities/Commentaire.php';
require_once '../Models/CommentaireModel.php';
require_once '../Models/EventModel.php';
require_once '../Models/CategoryModel.php';
require_once '../Models/ReserveModel.php';
require_once '../Entities/Reserve.php';





class EventController extends Controller
{


    //displayEvent -----------------
    //------------------------------
    public function displayEventAction()//Afficher les événements/Lié à la vue displayEvent.php/Affichage des événements par catégories(ici NULL)
    {
        // Instanciation des modèles nécessaires
        $eventModel = new EventModel();
        $categoryModel = new CategoryModel();
    
        // Récupération du message (s'il existe) via la requête GET
        $message = isset($_GET['message']) ? $_GET['message'] : '';
    
        // Récupération de toutes les catégories
        $category = $categoryModel->listClick();//Lié au Model CategoryModel
    
        // Récupération de tous les événements
        $events = $eventModel->findAll();//Lié au Model EventModel
    
        // Rendu de la vue avec les données nécessaires
        $this->render('concert/displayEvent', [
            'events' => $events,
            'category' => $category,
            'message' => $message,
            'selectedCategory' => null,  // Pas de catégorie sélectionnée ici
        ]);
    }
    public function filterEventByCategoryAction()//Lié à la vue displayEvent.php/Affichage des événements par catégories
{
    // Instanciation des modèles nécessaires
    $eventModel = new EventModel();
    $categoryModel = new CategoryModel();

    // Récupération du message (s'il existe) via la requête GET
    $message = isset($_GET['message']) ? $_GET['message'] : '';

    // Récupération de toutes les catégories
    $category = $categoryModel->listClick();//Lié au Model CatégoryModel
   
    // Récupérer la catégorie sélectionnée
    $selectedCategory = isset($_POST['id_category']) ? $_POST['id_category'] : null;

    // Si une catégorie est sélectionnée, récupérer les événements de cette catégorie
    if ($selectedCategory) {
        $events = $eventModel->findByCategory($selectedCategory);//Lié au Model EventModel
    } else {
        // Si aucune catégorie n'est sélectionnée, retourner tous les événements
        $events = $eventModel->findAll();//Lié au Model EventModel
    }

    // Rendu de la vue avec les données nécessaires
    $this->render('concert/displayEvent', [
        'events' => $events,
        'category' => $category,
        'message' => $message,
        'selectedCategory' => $selectedCategory, // La catégorie sélectionnée sera affichée
    ]);
}


public function searchAction(){//Affichage d'un barre de recherche/Lié à la vue displayEvent
    $eventModel = new EventModel();
    $search = $eventModel->searchBarre();//Lié à Event Model
    $this->render('concert/displayEvent', ['search' => $search ]);

}
     //displayEvent & findEvent -----------------
    //-------------------------------------------
    public function displayEventOne() {//Affichage d'un événements seul au clique sur un bouton dans la page displayEvent/Lié à la vue findEvent.php
        // Vérifier si l'ID de l'événement est passé en paramètre via la requête GET
        $id_event = isset($_GET['id_event']) ? $_GET['id_event'] : null;
    
        if ($id_event) {
            // Créer une instance du modèle Event
            $eventModel = new EventModel();
            
            // Récupérer l'événement spécifique
            $event = $eventModel->findEvent($id_event);//Lié à EventModel
    
            // Vérifier si l'événement existe
            if (!$event) {
                $message = "Événement introuvable.";
            } else {
                $message = isset($_GET['message']) ? $_GET['message'] : '';
            }
            
       
        
        $commentaireModel = new CommentaireModel();
        $comments = $commentaireModel->getVisibleComments($id_event);


    
            // Afficher la vue
            $this->render('concert/findEvent', ['event' => $event, 'comments' => $comments, 'message' => $message]);
        } else {
            // Si aucun ID d'événement n'est passé
            $message = "Aucun événement sélectionné.";
            $this->render('concert/findEvent', ['message' => $message]);
        }
    }


     //displayCompet -----------------
    //------------------------------
    public function displayCompetAction() {//Affichage des événments catégories compétitions/Lié à la vue displayCompet.php
        $eventModel = new EventModel();
        $competition = $eventModel->listeCompet();//Lié à EventModel
        $this->render('concert/displayCompet', ['competition' => $competition ]);

    }    

     //addEvent -----------------
    //------------------------------

    public function pageAdd() {//Affichage des catégorie en liste (select)/Lié à la vue addEvent
        $categoryModel = new CategoryModel();
        $category = $categoryModel->listeCategory();//Lié à CategoryModel
        $this->render('concert/addEvent', ['category' => $category]);
    }
    public function addEvent() {//Ajout d'un événements/Lié à la page addEvent
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $category = isset($_POST['id_category']) ? $_POST['id_category'] : '';

        $events = new Event();
        $events->setName($name);
        $events->setDate($date);
        $events->setDescription($description);
        $events->setId_category($category);

        $eventModel = new EventModel();

        $sucess = $eventModel->add($events);//Lié à EventModel/Envoie $event pour utilisation du Get
        $message = $sucess ? "Nouvel évenement disponible" : "Echec.";
        $this->render('concert/addEvent', ['message' => $message]);
    }



     //updateEvent -----------------
    //------------------------------
    public function updateEvent()//Modification d'un événement/Lié à la vue updateEvent.php/Permet d'afficher le formulaire pafr récupération de l'id de l'événement
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        $events = new Event();
        $events->setId_event($id);

        $eventModel = new EventModel();
        $events = $eventModel->find($events);//Lié à EventModel/Envoie $events pour utilisation du Get
        $categoryModel = new CategoryModel();
        $category = $categoryModel->listeUpdateCategory();//Lié à CategoryModel/Permet la liste des catégories

        $this->render('concert/updateEvent', ['category' => $category, 'event' => $events]);
    }
    public function updateEventAction()//Modification d'un événement/Lié à la vue updateEvent.php au clique sur envoyer
    {
        //permet l'envoie du formulaire par récupération de l'id
        $id = isset($_GET['id_event']) ? $_GET['id_event'] : '';
        //Permet de savoir si ces inputs ont bien du contenu insérer
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $category = isset($_POST['id_category']) ? $_POST['id_category'] : '';

       
        

        $events = new Event();
        $events ->setId_event($id);
        $events ->setName($name);
        $events ->setDate($date);
        $events ->setDescription($description);
        $events ->setId_category($category);
        

        $eventModel = new EventModel();
        $success = $eventModel->update($events);//Lié à Event Model/Envoie $events pour utilisation du Get
        $message = $success ? "Mise à jour de l'événement réussi." : "Évenement non mis à jour, veuillez réessayer.";
        header('Location: index.php?controller=User&action=AdminEventAction&message=' . urlencode($message));//redirection après envoie du formulaire
    }


    //deleteEvent ------------------
    //------------------------------
    public function deleteEvent()//Supprimer un événement/Lié à la vue deleteEvent.php
    {
        //permet la récupération de l'id
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        $event = new Event();
        $event->setId_event($id);

        $eventModel = new EventModel();
        $success = $eventModel->delete($event);//Lié à Event Model/Envoie $events pour utilisation du Get
       
        $message = $success ? "Évenement supprimer." : "Problème de serveur.";
        
        header('Location: index.php?controller=User&action=AdminEventAction&message=' . urlencode($message));//redirection après envoie du formulaire
    }

    public function listUserByEvent() {
        $eventModel = new EventModel();
        $events = $eventModel->listUserEvent();
        $message = isset($_GET['message']) ? $_GET['message'] : '';
        $this->render('concert/registerList', ['events' => $events, 'message' => $message]);
    }
    


    }
    
