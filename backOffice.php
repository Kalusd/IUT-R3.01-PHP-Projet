<?php
    include("verif_connect_admin.php")    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='node_modules/bootstrap/dist/css/bootstrap.css'>
    <script src='node_modules/bootstrap/dist/js/bootstrap.bundle.js'></script>
    <title>Back-office - AcheterVehicule</title>
</head>
<body class="container" style="background-color: #202020; color: #fff;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded-bottom" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">AcheterVehicule</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="vehicules.php">Véhicules</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" href="backOffice.php">Back-office</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Déconnexion</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <?php
        // Connexion à la base de données
        include("./connexionBDD.php");

        // Requête de sélection des véhicules disponibles dans la base de données
        $query = "SELECT * FROM AcheterVehicule_vehicule";
        $result = mysqli_query($link,$query);

        // Bouton d'ajout de véhicule
        echo '<a class="btn btn-success mt-3" href="actionvehicule.php?action=ajouter">Ajouter un véhicule</a>';

        // Affichage cartes véhicules avec boutons modifier et supprimer
        echo "<div class='container text-center mt-3'>";
        echo '<div class="row row-cols-4">';
        while ($donnees=mysqli_fetch_assoc($result)) {
            echo '<div class="col">';
            echo '<div class="card mt-2" style="width: 18rem;" data-bs-theme="dark" href="vehicule.php?modele='.$donnees["modele"].'">';
            echo '<img src="vignette.php?nom='.$donnees["chemin_Vignette"].'&largeur=256&hauteur=144" class="card-img-top" alt="'.$donnees["modele"].'">';
            echo '<div class="card-body">';
            echo '<strong><p class="card-text">'.$donnees["modele"].'</p></strong>';
            echo '<p class ="card-text mb-3">'.number_format($donnees["prix"], 2, '.', ' ').' €</p>';
            echo '<a class="btn btn-secondary me-3" href="actionvehicule.php?action=modifier&modele='.$donnees["modele"].'">Modifier</a>';
            echo '<a class="btn btn-danger ms-3" href="actionvehicule.php?action=supprimer&modele='.$donnees["modele"].'">Supprimer</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo "</div>";
        echo "</div>";
    ?>
</body>
</html>