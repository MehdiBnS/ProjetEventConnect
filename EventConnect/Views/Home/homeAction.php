<div class="container mt-5">
        <div class="row align-items-center">
            <!-- Image Section -->
            <div class="row">
    <div class="col-md-4">
        <img src="img/niro.jpeg" alt="Niro" class="img-fluid rounded shadow-sm w-100">
    </div>
    <div class="col-md-4">
        <img src="img/publicscene.jpg" alt="public" class="img-fluid rounded shadow-sm w-100">
    </div>
    <div class="col-md-4">
        <img src="img/sceneconcert.jpg" alt="Niro" class="img-fluid rounded shadow-sm w-100">
    </div>
</div>

            <!-- Text Section -->
            <div class="col-md-8">
                <h1 class="mb-4">Bienvenue sur <span class="text-primary">EVENT Connect</span></h1>
                <p class="lead">
                    Votre destination incontournable pour réserver vos spectacles, concerts, ateliers et bien plus encore ! Avec EVENT Connect, explorez un monde d’événements captivants et accédez en quelques clics à une expérience unique, adaptée à vos envies et passions.
                </p>
                <h2 class="mt-4">Pourquoi choisir EVENT Connect ?</h2>
                <ul class="list-unstyled">
                    <li><strong>Une offre variée :</strong> Que vous soyez amateur de musique, passionné d’art, curieux d’apprendre ou simplement en quête de divertissement, nous avons l’événement parfait pour vous.</li>
                    <li><strong>Réservation simplifiée :</strong> Grâce à notre plateforme intuitive, réservez facilement vos places en toute sécurité.</li>
                    <li><strong>Mises à jour en temps réel :</strong> Ne manquez jamais les derniers événements grâce à notre système d’actualisation constant.</li>
                    <li><strong>Une communauté dynamique :</strong> Découvrez, partagez et vivez des moments inoubliables avec des passionnés comme vous.</li>
                </ul>
                <h2 class="mt-4">Comment ça marche ?</h2>
                <ol>
                    <li><strong>Explorez :</strong> Parcourez notre catalogue d’événements.</li>
                    <li><strong>Réservez :</strong> Choisissez vos dates, vos places et réservez en toute simplicité.</li>
                    <li><strong>Vivez :</strong> Profitez pleinement de votre expérience.</li>
                </ol>
                <p class="mt-4">
                    Avec <span class="text-danger">EVENT Connect</span>, donnez vie à vos envies de sorties et profitez d’un accès direct aux meilleurs événements près de chez vous et au-delà.
                </p>
                <?php 
                $name = $_SESSION['name'] ?? null;
                $surname = $_SESSION['surname'] ?? null;

                if ($name && $surname) {
                    // Si l'utilisateur est connecté, afficher son nom et prénom, ainsi qu'une option de déconnexion
                    echo "
                    <a class='btn btn-light me-4' href='index.php?controller=User&action=UserPage'>
                        <img src='img/person.svg' alt='user' class='icon'> $name $surname
                    </a>
                    <a class='btn btn-primary' href='index.php?controller=Event&action=displayEventAction'>
                        Voir les événements
                    </a>";
                } else {
                    // Si l'utilisateur n'est pas connecté, afficher un bouton pour se connecter ou créer un compte
                    echo "
                   <a href='index.php?controller=User&action=pageLogin' class='btn btn-primary btn-lg'>Rejoignez-nous dès aujourd’hui</a>";
                }
                ?>
                
            </div>
        </div>
    </div>