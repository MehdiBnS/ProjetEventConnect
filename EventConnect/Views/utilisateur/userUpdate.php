<h1>Modifier votre profil</h1>
<form action="index.php?controller=User&action=saveUserUpdate&id_user=<?php echo $user->id_user ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Nom :</label>
        <input type="text" id="name" name="name" class="form-control" value="<?php echo $user->name; ?>">
    </div>
    <div class="mb-3">
        <label for="surname" class="form-label">Prénom :</label>
        <input type="text" id="surname" name="surname" class="form-control" value="<?php echo $user->surname; ?>">
    </div>
    <div class="mb-3">
        <label for="mail" class="form-label">E-mail :</label>
        <input type="email" id="mail" name="mail" class="form-control" value="<?php echo $user->mail; ?>">
    </div>
    <div class="mb-3">
        <label for="mdp" class="form-label">Mot de passe :</label>
        <input type="text" id="mdp" name="mdp" class="form-control" value="<?php echo $user->mdp; ?>">
    </div>
    <div class="mb-3">
        <label for="statut" class="form-label">Statut :</label>
        <input type="text" id="statut" name="statut" class="form-control" value="<?php echo $user->statut; ?>" disabled>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
