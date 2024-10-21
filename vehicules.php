<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='node_modules/bootstrap/dist/css/bootstrap.css'>
    <script src='node_modules/bootstrap/dist/js/bootstrap.bundle.js'></script>
    <title>Page d'accueil</title> <!-- MODIFIER TITRE -->
</head>
<body class="container" style="background-color: #202020;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded-bottom" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">AcheterVehicule</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Véhicules</a>
            </li>
        </ul>

    <?php
        // Connexion à la base de données
        include("./connexionBDD.php");
        $query = "SELECT * FROM AcheterVehicule_vehicule";
        $result = mysqli_query($link,$query);

        // Vérification de la connexion à la base de données
        if (mysqli_connect_errno()) {
            echo "Impossible de se connecter à la base de données: " . mysqli_connect_error();
            exit();
        }

        // Navbar : connexion, déconnexion, back-office
        echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">';
        if (isset($_SESSION['login'])) {
            if ($_SESSION['role'] == 'admin') {
                echo '<li class="nav-item">
                <a class="nav-link" href="backOffice.php">Back-office</a>
                </li>';
            }
            echo '<li class="nav-item">
            <a class="nav-link" href="logout.php">Déconnexion</a>
            </li>';
        }
        else {
            echo '<li class="nav-item">
            <a class="nav-link" href="login.php">Connexion</a>
            </li>';
        }
        echo '</ul>
        </div>
        </div>
        </nav>';


        echo '<h1 style="color: #fff;">Liste des véhicules disponibles :</h1>';
        // Affichage cartes véhicules
        echo "<div class='container text-center mt-3'>";
        echo '<div class="row row-cols-3">';
        while ($donnees=mysqli_fetch_assoc($result)) {
            echo '<div class="col">';
            echo '<div class="card" style="width: 18rem;" data-bs-theme="dark">';
            echo '<img src="vignette.php?nom='.$donnees["chemin_Vignette"].'&largeur=256&hauteur=144" class="card-img-top" alt="'.$donnees["modele"].'">';
            echo '<div class="card-body">';
            echo '<strong><p class="card-text">'.$donnees["modele"].'</p></strong>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
                // echo '<h2>'.$donnees["modele"].'</h2>';
                // echo '<h5>Prix : '.$donnees["prix"].'$</h2>';
                // echo '<a>'.$donnees["description"].'</a>';
        }
        echo "</div>";
        echo "</div>";
    ?>
</div>
</body>
</html>