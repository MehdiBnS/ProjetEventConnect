
<h1><?php echo "Réservation pour " .$_SESSION['name']. " " . $_SESSION['surname'] . " à la compétition de  " .$event->name?></h1>

<form method="POST" action="index.php?controller=Reserve&action=submitRegistration">
    <input type="hidden" name="id_event" value="<?php echo $event->id_event; ?>">
    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>"> <!-- ID de l'utilisateur connecté -->
    

    <div class="mb-3">
        <label for="places" class="form-label">Nombre de places</label>
        <input type="number" name="places" id="places" class="form-control" required min="1" max="10">
    </div>
    
    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>
