<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>EventConnect</title>
</head>
    
<body>
<header class="bg-primary py-3">
    <nav>
        <ul class="nav justify-content-center mb-2">
            <li class="nav-item">
                <a class="btn btn-light me-4" href="index.php?controller=Home&action=homeAction">
                    <img src="img/house.svg" alt="Home" class="icon"> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="btn btn-light me-4" href="index.php?controller=Event&action=displayEventAction">
                    <img src="img/song.svg" alt="Event" class="icon"> Listes des événements
                </a>
            </li>
            <li class="nav-item">
                <a class="btn btn-light me-4" href="index.php?controller=Event&action=displayCompetAction">
                    <img src="img/trophy.svg" alt="Compet" class="icon"> Inscriptions compétition
                </a>
            </li>
            <?php
            if (isset($_SESSION['statut'])) {
                $statut = $_SESSION['statut'];
            
                if ($statut == "organisateur") {
                    echo "<li class='nav-item'>";
                    echo "<a class='btn btn-warning me-4' href='index.php?controller=User&action=AdminEventAction'>Admin</a>";
                    echo "</li>";
                }
            } else {
                // Si la session ou la variable 'statut' n'existe pas, aucune sortie n'est générée
                echo '';
            }
            
            ?>
            <li class="nav-item">
                <?php 
                $name = $_SESSION['name'] ?? null;
                $surname = $_SESSION['surname'] ?? null;

                if ($name && $surname) {
                    // Si l'utilisateur est connecté, afficher son nom et prénom, ainsi qu'une option de déconnexion
                    echo "
                    <a class='btn btn-light me-4' href='index.php?controller=User&action=UserPage'>
                        <img src='img/person.svg' alt='user' class='icon'> $name $surname
                    </a>
                    <a class='btn btn-danger' href='index.php?controller=User&action=logoutUser'>
                        Déconnexion
                    </a>";
                } else {
                    // Si l'utilisateur n'est pas connecté, afficher un bouton pour se connecter ou créer un compte
                    echo "
                    <a class='btn btn-light me-4' href='index.php?controller=User&action=pageLogin'>
                        <img src='img/person.svg' alt='user' class='icon'> Se connecter/Créer un compte
                    </a>";
                }
                ?>
            </li>
            
             
            
        </ul>
    </nav>
</header>

  <div id="wrapper" class="container mt-4">
    <main>
      