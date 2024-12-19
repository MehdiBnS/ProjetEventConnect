<h1>Liste des Compétitions</h1>

<div class="container mt-5">
    <div class="row">
        <?php foreach ($competition as $compets): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $compets->name; ?></h5>
                        <p class="card-text">
                            <strong>Description :</strong> <?php echo $compets->description; ?>
                        </p>
                        <p class="card-text">
                            <strong>Date :</strong> <?php echo $compets->date; ?>
                        </p>
                    </div>
                    
                        <!-- Bouton pour s'inscrire à une compétition -->
                        <form action="index.php?controller=Reserve&action=showRegistrationForm" method="post">
                            <input type="hidden" name="id_event" value="<?php echo $compets->id_event; ?>">
                            <button type="submit" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> S'inscrire
                            </button>
                        </form>
                   
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
