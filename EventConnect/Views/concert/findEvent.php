<div class="container mt-5">
    <!-- Message d'info -->
    <?php if (!empty($message)): ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($event)): ?>
        <h2>Détails de l'événement</h2>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title"><?php echo $event->name; ?></h5>
                <p><strong>Description :</strong> <?php echo $event->description; ?></p>
                <p><strong>Date :</strong> <?php echo $event->date; ?></p>
                <p><strong>Catégorie :</strong> <?php echo $event->category_name; ?></p>

                <!-- Formulaire de réservation -->
                <form method="POST" action="index.php?controller=Reserve&action=addReservation">
                    <input type="hidden" name="id_event" value="<?php echo $event->id_event; ?>">
                    <div class="mb-3">
                        <label for="places" class="form-label">Nombre de places</label>
                        <input type="number" name="places" id="places" class="form-control" required min="1" max="10">
                    </div>
                    <button type="submit" class="btn btn-primary">Réserver</button>
                </form>
            </div>
        </div>

        <!-- Formulaire de commentaire -->
        <h3 class="mt-4">Ajouter un commentaire</h3>
        <form method="POST" action="index.php?controller=Commentaire&action=addComment">
            <input type="hidden" name="id_event" value="<?php echo $event->id_event; ?>">
            <input type="hidden" name="id_user" value="<?php echo isset($_SESSION['id_user']) ? $_SESSION['id_user'] : ''; ?>"> <!-- L'ID de l'utilisateur connecté -->
            
            <div class="mb-3">
                <label for="texte" class="form-label">Votre commentaire</label>
                <textarea name="texte" id="texte" class="form-control" rows="4" required></textarea>
            </div>

            <!-- Affichage du bouton d'ajout de commentaire -->
            <button type="submit" class="btn btn-secondary">Ajouter un commentaire</button>
        </form>

        <!-- Affichage des commentaires existants -->
        <h4 class="mt-4">Commentaires :</h4>

<?php if (isset($_SESSION['statut']) && $_SESSION['statut'] == 'festivalier'): ?>
    <!-- Afficher seulement les commentaires visibles pour les festivalier -->
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $commentaire): ?>
            <?php if ($commentaire->statut === 'visible'): ?> <!-- Vérifier si le statut du commentaire est "visible" -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Commentaire de <?php echo $commentaire->name . ' ' . $commentaire->surname; ?></h5>
                        <p class="card-text"><?php echo $commentaire->texte; ?></p>
                    </div>
                    <footer class="blockquote-footer">Publié le <?php echo $commentaire->date; ?></footer>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun commentaire pour cet événement.</p>
    <?php endif; ?>

<?php elseif (isset($_SESSION['statut']) && $_SESSION['statut'] == 'organisateur'): ?>
    <!-- Afficher tous les commentaires pour les organisateurs -->
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $commentaire): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Commentaire de <?php echo $commentaire->name . ' ' . $commentaire->surname; ?></h5>
                    <p class="card-text"><?php echo $commentaire->texte; ?></p>

                    <!-- Formulaire pour changer le statut du commentaire -->
                    <form method="POST" action="index.php?controller=Commentaire&action=updateCommmentaire&id_commentaire=<?php echo $commentaire->id_commentaire?>">
                        <input type="hidden" name="id_commentaire" value="<?php echo $commentaire->id_commentaire; ?>"> <!-- ID du commentaire -->
                        <input type="hidden" name="id_user" value="<?php echo $commentaire->id_user; ?>"> <!-- ID de l'utilisateur du commentaire -->

                        <div class="mb-3">
                            <label for="new_status" class="form-label">Statut du commentaire</label>
                            <select name="new_status" id="new_status" class="form-select" onchange="this.form.submit()">
                                <option value="visible" <?php if($commentaire->statut == 'visible') echo 'selected'; ?>>Visible</option>
                                <option value="modéré" <?php if($commentaire->statut == 'modéré') echo 'selected'; ?>>Modérer</option>
                            </select>
                        </div>
                    </form>

                    <footer class="blockquote-footer">Publié le <?php echo $commentaire->date; ?></footer>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun commentaire pour cet événement.</p>
    <?php endif; ?>

<?php else: ?>
    <!-- Cas où l'utilisateur n'est ni festivalier, ni organisateur -->
    <p>Accès restreint aux commentaires. Vous devez être festivalier ou organisateur pour voir les commentaires.</p>
<?php endif; ?>


    <?php endif; ?>
</div>
