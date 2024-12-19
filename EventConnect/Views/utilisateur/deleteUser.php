<div class="container mt-5">
  
    <h1 class="text-center">Confirmation de Suppression de Compte</h1>

    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Êtes-vous sûr de vouloir supprimer votre compte ?</h4>
        <p>La suppression de votre compte entraînera la perte de toutes vos informations personnelles et données associées. Cette action est <strong>irréversible</strong>, et une fois le compte supprimé, vous ne pourrez plus accéder à votre profil ou à vos informations.</p>
        <hr>
        <ul>
            <li><strong>Toutes vos informations personnelles seront supprimées</strong>, y compris votre nom, prénom, adresse email, et autres données stockées.</li>
            <li><strong>Vos événements ou autres contributions (si applicable) seront également supprimés.</li>
            <li>Vous ne pourrez plus <strong>vous reconnecter</strong> avec ce compte après la suppression.</li>
        </ul>
        <p class="mb-0">Si vous êtes sûr de vouloir continuer, cliquez sur le bouton de suppression ci-dessous. Sinon, vous pouvez annuler l'action.</p>
    </div>

   
    <div class="mb-4">
        <h5><strong>Nom :</strong> John Doe</h5>
        <h5><strong>Email :</strong> johndoe@example.com</h5>
        <h5><strong>Statut :</strong> Utilisateur</h5>
    </div>

  
    <div class="d-flex justify-content-between">
       
        <form action="index.php?controller=User&action=DeleteUser&id_user=<?php echo $user->id_user ?>" method="POST">
            <button type="submit" class="btn btn-danger">Supprimer mon compte</button>
        </form>

       
        <a href="index.php?controller=User&action=userPage" class="btn btn-secondary">Annuler</a>
    </div>
</div>
