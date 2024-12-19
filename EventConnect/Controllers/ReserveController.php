<?php
require_once 'Controller.php';
require_once '../Entities/Event.php';
require_once '../Models/EventModel.php';
require_once '../Entities/User.php';
require_once '../Models/UserModel.php';
require_once '../Entities/Reserve.php';
require_once '../Models/ReserveModel.php';

class ReserveController extends Controller {

  // Afficher le formulaire de réservation pour un événement
  public function showReservationForm($id_event) {
    $this->render('reservation/form', ['id_event' => $id_event]);
}

// Gérer l'ajout d'une réservation
public function addReservation() {
    // Vérifiez si l'utilisateur est connecté
    if (!isset($_SESSION['id_user'])) {
        $message = "Veuillez vous connecter avant de réserver.";
        $this->render('utilisateur/login', ['message' => $message]);
        return;
    }

    // Récupérer les données du formulaire
    $id_event = $_POST['id_event'] ?? '';
    $places = $_POST['places'] ?? '';

    // Vérifiez si les champs sont remplis
    if (empty($id_event) || empty($places)) {
        $message = "Tous les champs sont requis.";
        $this->render('concert/findEvent', ['message' => $message]);
        return;
    }

    // Créez une nouvelle réservation
    $reserve = new Reserve();
    $reserve->setId_user($_SESSION['id_user']);
    $reserve->setId_event($id_event);
    $reserve->setPlaces($places);
    
    $reserveModel = new ReserveModel;
    // Ajoutez la réservation dans la base de données
    $success = $reserveModel->addReservation($reserve);

    if ($success) {
        $message = "Réservation ajoutée avec succès !";
    } else {
        $message = "Une erreur s'est produite lors de la réservation.";
    }

    // Afficher le message
    $this->render('concert/findEvent', ['message' => $message]);
}


public function deleteReserve() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_reserve = $_POST['id_reservation'];

        $reserveModel = new ReserveModel();
        $result = $reserveModel->deleteReserveById($id_reserve);

        if ($result) {
            $message = "Réservation supprimée avec succès.";
            header('Location: index.php?controller=User&action=userPage');
            exit();
        } else {
            $message = "Erreur lors de la suppression de la réservation.";
            header('Location: index.php?controller=User&action=userPage');
            exit();
        }
        $this->render('utilisateur/userPage', ['message' => $message]);

}

}
public function showRegistrationForm() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_SESSION['id_user'])) {

            $id = isset($_POST['id_event']) ? $_POST['id_event'] : '';
          
            $id_event = new Event();
            $id_event->setId_event($id);


            $reserveModel = new ReserveModel();
            
            $event = $reserveModel->find($id_event);

            if ($event) {
                $this->render('concert/reserveEvent', ['event' => $event]);
            } else {
                $message = "L'événement spécifié n'existe pas.";
                $this->render('Home/homeAction', ['message' => $message]);
            }
        } else {
            
            $message = "Vous devez être connecté pour vous inscrire à un événement.";
            $this->render('utilisateur/login', ['message' => $message]);
        }

}
}
public function submitRegistration() {
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['id_user'])) {
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion ou afficher un message d'erreur
        $message = "Vous devez être connecté pour vous inscrire à cet événement.";
        $this->render('utilisateur/login', ['message' => $message]);
        return; // Arrêter l'exécution si l'utilisateur n'est pas connecté
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données envoyées dans le formulaire
        $id_user = $_SESSION['id_user'];  // Utiliser la session pour l'ID de l'utilisateur
        $id_event = $_POST['id_event'];
        $places = $_POST['places'];

        // Instancier le modèle de réservation
        $reserveModel = new ReserveModel();

        // Ajouter l'inscription dans la base de données
        $result = $reserveModel->addRegistration($id_user, $id_event, $places);

        // Vérifier si l'inscription a réussi
        if ($result) {
            $message = "Inscription réussie !";
        } else {
            $message = "Erreur lors de l'inscription.";
        }

        // Redirection ou affichage du message
        $this->render('Home/homeAction', ['message' => $message]);
    }
}


}



