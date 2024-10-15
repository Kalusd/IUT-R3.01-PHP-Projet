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

        // Test BDD
        while ($donnees=mysqli_fetch_assoc($result)) {
            $ch1 = $donnees["nom"];
            $ch2 = $donnees["image"];
            echo $ch1." : ".$ch2."</p>";
        }

        echo '<a href="./login.php">Connexion</a>';
    ?>
    <div class="row row-cols-3">
        <img src="vignette.php?nom=faggio.jpg&largeur=256&hauteur=144" alt="Faggio">
    </div>
</body>
</html>