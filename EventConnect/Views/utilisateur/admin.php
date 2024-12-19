<a class="btn btn-primary me-4" href="index.php?controller=Event&action=pageAdd">Ajouter un évenement</a>
<a class="btn btn-secondary me-4" href="index.php?controller=Event&action=listUserByEvent">Listes des inscrits</a>

<div class="container mt-5">
    <?php if (!empty($message)): ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($events as $event): ?>
            <div class="col">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Nom : <?php echo $event->name; ?></h5>
                        <p class="card-text">
                            <strong>Description :</strong> <?php echo $event->description; ?>
                        </p>
                        <p class="card-text">
                            <strong>Date :</strong> <?php echo $event->date; ?>
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="index.php?controller=Event&action=updateEvent&id=<?php echo $event->id_event ?>" class="btn btn-warning btn-sm">
                                <img src="img/update.svg" alt="Mettre à jour" style="width: 20px;">
                                Mettre à jour
                            </a>
                            <a href="index.php?controller=Event&action=deleteEvent&id=<?php echo $event->id_event ?>" class="btn btn-danger btn-sm">
                                <img src="img/trash.svg" alt="Supprimer" style="width: 20px;">
                                Supprimer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
