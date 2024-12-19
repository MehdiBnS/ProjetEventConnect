<?php
require_once 'Controller.php';
require_once '../Entities/Commentaire.php';
require_once '../Models/CommentaireModel.php';
require_once '../Entities/Event.php';
require_once '../Models/EventModel.php';
require_once '../Entities/User.php';
require_once '../Models/UserModel.php';

class CommentaireController extends Controller {
    public function addComment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifier si l'utilisateur est connecté
            if (isset($_SESSION['id_user'])) {
                $id_user = $_SESSION['id_user'];  // Récupérer l'ID de l'utilisateur connecté
            } else {
                $message = "Veuillez vous connecter avant de poster un commentaire.";
                $this->render('utilisateur/login', ['message' => $message]);
                return;  // Arrêter l'exécution si l'utilisateur n'est pas connecté
            }
    
            // Récupérer les autres données du formulaire
            $texte = $_POST['texte'];
            $id_event = $_POST['id_event'];
    
            // Instancier le modèle CommentaireModel
            $commentaireModel = new CommentaireModel();
    
            // Créer un objet Commentaire
            $comment = new Commentaire();
            $comment->setTexte($texte);
            $comment->setId_user($id_user);  // Utiliser l'ID de l'utilisateur connecté
            $comment->setId_event($id_event);
            $comment->setDate(date('Y-m-d H:i:s'));  // Ajouter la date actuelle
            $comment->setStatut('visible');  // Statut par défaut
    
            // Ajouter le commentaire
            $result = $commentaireModel->addComment($comment);
    
            // Vérifier si l'ajout a réussi et afficher un message approprié
            if ($result) {
                $message = "Commentaire ajouté avec succès.";
            } else {
                $message = "Erreur lors de l'ajout du commentaire.";
            }
    
            // Rediriger vers la page de l'événement avec un message
            $this->render('concert/findEvent', ['message' => $message, 'id_event' => $id_event]);
        }
    }
    


    // Modifier le statut d'un commentaire
    public function updateCommmentaire() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données envoyées par le formulaire
            $id_user = $_POST['id_user'];
            $id_commentaire = $_POST['id_commentaire'];
            $new_status = $_POST['new_status'];
    
            // Vérifier si l'utilisateur a le statut "organisateur"
            if ($_SESSION['statut'] === 'organisateur') {
                $commentaireModel = new CommentaireModel();
                $result = $commentaireModel->updateCommentStatus($id_commentaire, $new_status, $id_user);
    
                // Vérifier si la mise à jour a réussi
                if ($result) {
                    $message = "Statut du commentaire mis à jour avec succès.";
                } else {
                    $message = "Erreur lors de la mise à jour du statut.";
                }
            } else {
                $message = "Accès refusé. Vous n'êtes pas organisateur.";
            }
    
            // Rediriger ou afficher un message
            $this->render('concert/findEvent', ['message' => $message]);
            exit();
        }
    }
    public function deleteCommentaire() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_commentaire = $_POST['id_commentaire'];
    
            $commentaireModel = new CommentaireModel();
            $result = $commentaireModel->deleteCommentaireById($id_commentaire);
    
            if ($result) {
                $message = "Commentaire supprimée avec succès.";
                header('Location: index.php?controller=User&action=userPage');
                exit();
            } else {
                $message = "Erreur lors de la suppression du commentaire.";
                header('Location: index.php?controller=User&action=userPage');
                exit();
            }
            $this->render('utilisateur/userPage', ['message' => $message]);
    
    }
    
}
}
