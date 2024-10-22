<?php
        // Vérification du rôle administrateur de l'utilisateur
        include("verif_connect_admin.php");

        var_dump($_GET); // DEBUG

        // Connexion à la base de données
        include("./connexionBDD.php");

        // Si on a une action définie dans le POST = on doit exécuter l'action car confirmation déjà demandée à l'utilisateur
        if (isset($_POST['action'])) {
            if ($_POST['action'] == "supprimer") {
                $query = "DELETE FROM AcheterVehicule_vehicule WHERE modele = '".$_POST['modele']."';";
                $result = mysqli_query($link,$query);
                echo '<body onLoad="alert(\'Véhicule supprimé avec succès.\')">';
                echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
                exit();
            }
            elseif ($_POST['action'] == "modifier") {
                // LOGIQUE METIER
                echo '<body onLoad="alert(\'Véhicule modifié avec succès.\')">';
                echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
                exit();
            }
            elseif ($_POST['action'] == "ajouter") {
                // LOGIQUE METIER
                echo '<body onLoad="alert(\'Véhicule ajouté avec succès.\')">';
                echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
                exit();
            }
        }

        // Vérification de l'action à effectuer
        if (!isset($_GET['action'])) {
            echo '<body onLoad="alert(\'Paramètres invalides.\')">';
            echo '<meta http-equiv="refresh" content="0;URL=index.php">';
            exit();
        }
        else {
            // Affichage de la partie commune de la page web
            echo '<!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
                <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
                <title>Gestion d\'un véhicule</title>
            </head>
            <body class="container" style="background-color: #202020;">
                <nav class="navbar navbar-expand-lg bg-body-tertiary rounded-bottom" data-bs-theme="dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">AcheterVehicule</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Accueil</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="vehicules.php">Véhicules</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="backOffice.php">Back-office</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Déconnexion</a>
                        </li>
                    </ul>
                    </div>
                </div>
                </nav>
                <div class="container mt-5">';

            if ($_GET['action'] == "supprimer") {
                echo '<div class="alert alert-warning">
                    Êtes-vous sûr de vouloir supprimer le véhicule <strong>'.$_GET['modele'].'</strong> ?
                </div>
                <form action="" method="post">
                    <input type="hidden" name="modele" value="'.$_GET['modele'].'">
                    <button type="submit" name="supprimer" class="btn btn-danger">Oui, supprimer</button>
                    <a href="backOffice.php" class="btn btn-secondary">Non, annuler</a>
                </form>'; // Vérifier name="supprimer" du bouton
            }
    
            // Requête de sélection des véhicules disponibles dans la base de données
            $query = "SELECT * FROM AcheterVehicule_vehicule";
            $result = mysqli_query($link,$query);
    
            echo '</div>
            </body>
            </html>';
        }
    ?>