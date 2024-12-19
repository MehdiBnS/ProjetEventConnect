<?php

require_once 'Controller.php';
require_once '../Entities/User.php';
require_once '../Models/UserModel.php';
require_once '../Entities/Reserve.php';
require_once '../Models/ReserveModel.php';
require_once '../Entities/Commentaire.php';
require_once '../Models/CommentaireModel.php';

class UserController extends Controller {

    // login -----------------
    //-----------------------------
    public function pageLogin() {// Affichage de la page de connexion / Lié à la vue login.php
        $this->render('utilisateur/login');
    } 
    public function connectUser() {// Connexion d'un utilisateur / Lié à la vue login.php
        $userModel = new UserModel();
        $userArray = $userModel->find($_POST['mail']);//Lié à UserModel/Envoie le POST
        
        // Vérification des identifiants
        if ($userArray) {
            $user = new User();
            $user->setId_user($userArray->id_user);
            $user->setName($userArray->name);
            $user->setSurname($userArray->surname);
            $user->setMail($userArray->mail);
            $user->setMdp($userArray->mdp);
            $user->setStatut($userArray->statut);
            
            // Création de la session utilisateur
            $_SESSION['name'] = $user->getName();
            $_SESSION['surname'] = $user->getSurname();
            $_SESSION['id_user'] = $user->getId_user();
            $_SESSION['statut'] = $user->getStatut();
            $_SESSION['mail'] = $user->getMail();
            
            setcookie("mail", $user->getMail());
            setcookie("mdp", $user->getMdp());
            
            // Redirection vers la page d'accueil
            header("Location: index.php?controller=Home&action=homeAction");
        }
    }

    // subscribe -------------
    //-----------------------------
    public function pageSubscribe() {// Affichage de la page d'inscription / Lié à la vue subscribe.php
        $this->render('utilisateur/subscribe');
    } 

    public function addUser() {// Ajout d'un utilisateur / Lié à la page subscribe.php
        // Récupération des champs du formulaire
        $name = $_POST['name'] ?? '';
        $surname = $_POST['surname'] ?? '';
        $mail = $_POST['mail'] ?? '';
        $mdp = $_POST['mdp'] ?? '';
        $statut = $_POST['statut'] ?? 'festivalier';
    
        // Vérification des champs obligatoires
        if (empty($name) || empty($surname) || empty($mail) || empty($mdp)) {
            $message = "Tous les champs sont requis.";
            $this->render('utilisateur/subscribe', ['message' => $message]);
            return;
        }
    
        $userModel = new UserModel();
    
        // Vérification si l'utilisateur existe déjà
        if ($userModel->existsByEmail($mail))//Lié à UserModel/Envoie $mail pour réutilisation
         {
            $message = "Un compte avec cet e-mail existe déjà.";
            $this->render('utilisateur/subscribe', ['message' => $message]);
            return;
        }
    
        // Création d'un nouvel utilisateur
        $user = new User();
        $user->setName($name);
        $user->setSurname($surname);
        $user->setMail($mail);
        $user->setMdp($mdp);
        $user->setStatut($statut);
    
        $userId = $userModel->add($user); //Lié à UserModel/ Ajout de l'utilisateur dans la base de données
    
        // Vérification de l'insertion réussie
        if ($userId) {
            $message = "Bienvenue, " . $name . " " . $surname . " ! Votre compte a été créé avec succès.";
            $this->render('utilisateur/subscribe', ['message' => $message]);
        } else {
            $message = "Une erreur s'est produite lors de la création du compte.";
            $this->render('utilisateur/subscribe', ['message' => $message]);
        }
    }
    
   
     // null -----------------
    //-----------------------------
    public function logoutUser() {// Déconnexion de l'utilisateur / Redirige vers la page d'accueil
        session_destroy();//détruit la session
        header('Location : index.php?controller=Home&action=homeAction');
    }

    // admin -----------
    //-----------------------------
    public function AdminEventAction() {// Affichage des événements pour l'administrateur / Lié à la vue admin.php
        $userModel = new UserModel();
        $events = $userModel->findAll();//Lié à UserModel
        $message = isset($_GET['message']) ? $_GET['message'] : '';
        $this->render('utilisateur/admin', ['events' => $events, 'message' => $message]);
    }

    // userPage -------------------
    //-----------------------------
    public function UserPage() {// Affichage de la page utilisateur / Lié à la vue userPage.php
        $userModel = new UserModel();
        $user = new User();
        $user->setName($_SESSION['name']);
        $user->setSurname($_SESSION['surname']);
        $user->setStatut($_SESSION['statut']);
        $user = $userModel->findUser($user);//Lié à UserModel/$user envoyer pour récupération en Get
        $id_user = $_SESSION['id_user']; // Vérifiez que l'ID utilisateur est dans la session
        $reserveModel = new ReserveModel();
        $reservations = $reserveModel->getUserReservations($id_user);
        $commentaireModel = new CommentaireModel();
        $commentaire = $commentaireModel->getCommentaire($id_user);
      

        // Affichage de la page utilisateur si les informations sont valides
        if ($user) {
            $this->render('utilisateur/userPage', ['user' => $user, 'reservations' => $reservations, 'commentaire' => $commentaire]);
        } else {
            $this->render('utilisateur/login');
            exit();
        }
        }
    

    // userUpdate -----------------
    //-----------------------------
    public function UpdateUser() {// Affichage du formulaire de modification des informations utilisateur / Lié à la vue UserUpdate.php
        $id_user = $_SESSION['id_user'];
        $userModel = new UserModel();
        $user = $userModel->findUserById($id_user);//Lié à UserModel/Envoie de la SESSION
        $this->render('utilisateur/userUpdate', ['user' => $user]);
    }

    public function saveUserUpdate() {// Enregistrement des modifications utilisateur / Redirige vers UserPage
        if (!isset($_SESSION['id_user'])) {
            $this->render('utilisateur/login');
            exit();
        }

        // Récupération des champs du formulaire
        $id_user = $_SESSION['id_user'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];

        $userModel = new UserModel();
        $userModel->updateUser($id_user, $name, $surname, $mail, $mdp);//Lie à UserModel/Envoie tous les champs du formulaire

        // Mise à jour des informations en session
        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['mail'] = $mail;

        header('Location: index.php?controller=User&action=UserPage');//redirection
        exit();
    }

    // deleteUser -------------
    //-----------------------------
    public function DeletePageUser() {// Affichage de la confirmation de suppression de compte / Lié à deleteUser.php
        if (!isset($_SESSION['id_user'])) {
            header('Location: index.php?controller=User&action=login');
            exit();
        }

        $id_user = $_SESSION['id_user'];
        $userModel = new UserModel();
        $user = $userModel->ForDeleteUserById($id_user);//Lié à UserModel/Envoie la SESSION

        $this->render('utilisateur/deleteUser', ['user' => $user]);
    }

    public function DeleteUser() {// Suppression définitive du compte utilisateur / Redirige vers la page d'accueil
        if (!isset($_SESSION['id_user'])) {
            header('Location: index.php?controller=Home&action=homeAction');
            exit();
        }

        $id_user = $_SESSION['id_user'];
        $userModel = new UserModel();
        $success = $userModel->deleteUserById($id_user);//Lié à UserModel/Envoie la SESSION

        $message = $success ? "Votre compte a été supprimé avec succès." : "Erreur lors de la suppression du compte.";

        if ($success) {
            session_unset();
            session_destroy();
        }

        header('Location: index.php?controller=Home&action=homeAction&message=' . urlencode($message));
        exit();
    }
}
