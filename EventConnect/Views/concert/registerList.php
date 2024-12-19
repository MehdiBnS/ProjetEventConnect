<h1>Liste des événements et réservations</h1>

<div class="container mt-5">
    <!-- Liste des événements avec détails -->
    <ul>
        <?php foreach ($events as $event): ?>
            <li>
                <!-- Titre de l'événement -->
                <h3><?php echo $event->event_name; ?></h3>
                
                <!-- Nombre de places réservées -->
                <p><strong>Places réservées :</strong> <?php 
                if (!empty($event->reserved_places)): 
                echo $event->reserved_places; ?></p>
                <?php else: ?>
                    0</p>
                <?php endif; ?>
            </li>
                <!-- Liste des utilisateurs inscrits -->
                <?php if (!empty($event->user_name) && !empty($event->user_surname)): ?>
                    <ul>
                        <li><?php echo $event->id_user . " - " . $event->user_name . " " . $event->user_surname; ?></li>
                    </ul>
                <?php else: ?>
                    <p>Aucun utilisateur inscrit pour cet événement.</p>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
