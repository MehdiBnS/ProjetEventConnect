<h1 class="text-center mb-4">Profil de l'utilisateur</h1>

<div class="container">
    <?php if (isset($user)): ?>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Informations de l'utilisateur</h4>
            </div>
            <div class="card-body">
                <p><strong>Nom : </strong><?php echo $user->getName(); ?></p>
                <p><strong>Prénom : </strong><?php echo $user->getSurname(); ?></p>
                <p><strong>Statut : </strong><?php echo $user->getStatut(); ?></p>

                <a class="btn btn-danger mt-3" href="index.php?controller=User&action=logoutUser">Se déconnecter</a>
                <a class="btn btn-primary mt-3" href="index.php?controller=User&action=UpdateUser">Modifier</a>
                <a class="btn btn-warning mt-3" href="index.php?controller=User&action=DeletePageUser">Supprimer</a>
            </div>
        </div>

        <!-- Affichage des réservations -->
        <div class="card mt-4">
            <div class="card-header bg-success text-white">
                <h4>Mes réservations</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($reservations)): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Événement</th>
                                <th>Date</th>
                                <th>Nombre de places</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr>
                                    <td><?php echo $reservation->name; ?></td>
                                    <td><?php echo $reservation->date; ?></td>
                                    <td><?php echo $reservation->places; ?></td>
                                    <td>
                                    <form action="index.php?controller=Reserve&action=deleteReserve" method="post">
                                    <input type="hidden" name="id_reservation" value="<?php echo $reservation->id_reserve; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                    </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Vous n'avez pas encore effectué de réservations.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h4>Mes commentaires</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($commentaire)): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Événement</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Contenu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($commentaire as $commentaires): ?>
                                <tr>
                                    <td><?php echo $commentaires->name; ?></td>
                                    <td><?php echo $commentaires->date; ?></td>
                                    <td><?php echo $commentaires->statut; ?></td>
                                    <td><?php echo $commentaires->texte; ?></td>
                                    <td>
                                    <form action="index.php?controller=Commentaire&action=deleteCommentaire" method="post">
                                    <input type="hidden" name="id_commentaire" value="<?php echo $commentaires->id_commentaire; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                    </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Vous n'avez pas de commentaires.</p>
                <?php endif; ?>
            </div>
        </div>

    <?php else: ?>
        <div class="alert alert-warning mt-3" role="alert">
            Utilisateur non connecté.
        </div>
    <?php endif; ?>
</div>
