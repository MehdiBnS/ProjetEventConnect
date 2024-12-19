<div class="container mt-5">
    <?php if (!empty($message)): ?>
        <div class="alert <?php echo $success ? 'alert-success' : 'alert-danger'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <h2 class="text-center mb-4">Créer un compte</h2>
    <form action="index.php?controller=User&action=addUser" method="post" class="p-4 border rounded shadow-sm">
        <div class="mb-3">
            <label for="name" class="form-label">Nom :</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="mb-3">
            <label for="surname" class="form-label">Prénom :</label>
            <input type="text" class="form-control" name="surname" id="surname" required>
        </div>

        <div class="mb-3">
            <label for="mail" class="form-label">E-mail :</label>
            <input type="email" class="form-control" name="mail" id="mail" required>
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe :</label>
            <input type="text" class="form-control" name="mdp" id="mdp" required>
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Vous êtes :</label>
            <input type="text" class="form-control" name="statut" id="statut" value="festivalier" readonly>
        </div>

        <button type="submit" class="btn btn-primary w-100">Créer un compte</button>
    </form>