<div class="container mt-5">
    <?php if (!empty($message)): ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
</div>

<div class="container mt-5">
    <!-- Formulaire de recherche -->
    <form method="POST" action="index.php?controller=Event&action=searchAction">
        <div class="mb-3">
            <label for="search" class="form-label">Rechercher un événement</label>
            <input type="text" id="search" name="search" class="form-control" placeholder="Rechercher...">
        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    <!-- Affichage des résultats de recherche -->
    <div class="row mt-4">
        <?php if (!empty($search)): ?>
            <?php foreach ($search as $event): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $event->name; ?></h5>
                            <p class="card-text"><?php echo $event->description; ?></p>
                            <p class="card-text"><small class="text-muted">Date: <?php echo $event->date; ?></small></p>
                            <?php if (isset($_SESSION['id_user'])): ?>
                                <?php if ($event->category_name === 'Compétition'): ?>
                                    <!-- Bouton pour s'inscrire à une compétition -->
                                    <form action="index.php?controller=Reserve&action=showRegistrationForm" method="post">
                                        <input type="hidden" name="id_event" value="<?php echo $event->id_event; ?>">
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> S'inscrire
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <!-- Bouton pour réserver pour les autres catégories -->
                                    <form action="index.php?controller=Event&action=displayEventOne&id_event=<?php echo $event->id_event ?>" method="post">
                                        <input type="hidden" name="id_event" value="<?php echo $event->id_event; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="bi bi-calendar-check"></i> Réserver
                                        </button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <!-- Message pour les utilisateurs non connectés -->
                                <p class="text-danger">Connectez-vous pour vous inscrire ou réserver.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun événement trouvé.</p>
        <?php endif; ?>
    </div>
</div>

<div class="container mt-5">
    <!-- Formulaire pour sélectionner une catégorie -->
    <form method="POST" action="index.php?controller=Event&action=filterEventByCategoryAction">
        <div class="mb-3">
            <label for="id_category" class="form-label">Catégorie</label>
            <select name="id_category" id="id_category" class="form-select" onchange="this.form.submit()">
                <option value="">Toutes les catégories</option>
                <?php foreach ($category as $categorie): ?>
                    <option value="<?php echo $categorie->id_category; ?>"
                        <?php echo isset($selectedCategory) && $selectedCategory == $categorie->id_category ? 'selected' : ''; ?>>
                        <?php echo $categorie->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <!-- Affichage des événements -->
    <div class="row">
        <?php if (empty($events)): ?>
            <p>Aucun événement trouvé pour cette catégorie.</p>
        <?php else: ?>
            <?php foreach ($events as $event): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Nom : <?php echo $event->name; ?></h5>
                            <p class="card-text">
                                <strong>Description :</strong> <?php echo $event->description; ?>
                            </p>
                            <p class="card-text">
                                <strong>Date :</strong> <?php echo $event->date; ?>
                            </p>
                            <p class="card-text">
                                <strong>Catégorie :</strong> <?php echo $event->category_name; ?>
                            </p>

                            <!-- Affichage conditionnel du formulaire -->
                            <?php if (isset($_SESSION['id_user'])): ?>
                                <?php if ($event->category_name === 'Compétition'): ?>
                                    <!-- Bouton pour s'inscrire à une compétition -->
                                    <form action="index.php?controller=Reserve&action=showRegistrationForm" method="post">
                                        <input type="hidden" name="id_event" value="<?php echo $event->id_event; ?>">
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> S'inscrire
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <!-- Bouton pour réserver pour les autres catégories -->
                                    <form action="index.php?controller=Event&action=displayEventOne&id_event=<?php echo $event->id_event ?>" method="post">
                                        <input type="hidden" name="id_event" value="<?php echo $event->id_event; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="bi bi-calendar-check"></i> Réserver
                                        </button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <!-- Message pour les utilisateurs non connectés -->
                                <p class="text-danger">Connectez-vous pour vous inscrire ou réserver.</p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
