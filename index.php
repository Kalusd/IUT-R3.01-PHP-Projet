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
<body class="container">
    
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

        if (isset($_SESSION['login'])) {
            if ($_SESSION['role'] == 'admin') {
                echo '<a href="./backOffice.php">Back-Offic</a>';
            }
            echo '<a href="./logout.php">Déconnexion</a>';
        }
        else {
            echo '<a href="./login.php">Connexion</a>';
        }

        
        // Test BDD
        echo "<div class='container text-center'>";
        echo '<div class="row row-cols-3">';
        while ($donnees=mysqli_fetch_assoc($result)) {
            echo '<div class="col">';
                echo '<img src="vignette.php?nom='.$donnees["chemin_Vignette"].'&largeur=256&hauteur=144" alt='.$donnees["modele"].'>';
                echo '<h2>'.$donnees["modele"].'</h2>';
                echo '<h5>Prix : '.$donnees["prix"].'$</h2>';
                echo '<a>'.$donnees["description"].'</a>';
                $_SESSION['role'] = 0;
                
            echo '</div>';
        }
        echo "</div>";
        echo "</div>";

    ?>
    

   
</div>
</body>
</html>