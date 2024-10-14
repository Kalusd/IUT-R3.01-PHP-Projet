<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Page d'accueil</title>
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
    <img src="vignette.php?nom=faggio.jpg&largeur=400&hauteur=300" alt="Faggio">
</body>
</html>