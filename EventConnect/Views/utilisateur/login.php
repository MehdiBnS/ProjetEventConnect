

<div class="container mt-5">
    <h2 class="text-center mb-4">Se connecter</h2>
    <form action="index.php?controller=User&action=connectUser" method="post" class="p-4 border rounded shadow-sm">
        <div class="mb-3">
            <label for="mail" class="form-label">E-mail</label>
            <input type="email" class="form-control" name="mail" id="mail" required>
        </div>

        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="text" class="form-control" name="mdp" id="mdp" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Connexion</button>
    </form>

    <div class="text-center mt-3 mb-3">
        <button class="btn btn-secondary">
            <a href="index.php?controller=User&action=pageSubscribe" class="text-decoration-none text-white">Créer un compte</a>
        </button>
    </div>
</div>


