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
    <title>Back-office</title> <!-- MODIFIER TITRE -->
</head>
<body>
    <a href="./index.php">Accueil</a>
    <a href="./logout.php">Déconnexion</a>
    <?php
        include("./connexionBDD.php");
        $query = "SELECT * FROM AcheterVehicule_vehicule";
        $result = mysqli_query($link,$query);
        while ($donnees=mysqli_fetch_assoc($result)) {
                echo '<img src="vignette.php?nom='.$donnees["chemin_Vignette"].'&largeur=256&hauteur=144" alt='.$donnees["modele"].'>';
                echo '<h2>'.$donnees["modele"].'</h2>';
                echo '<h5>Prix : '.$donnees["prix"].'$</h2>';
                echo '<a>'.$donnees["description"].'</a>';
        }
    ?>
</body>
</html>