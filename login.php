<?php
    // On démarre la session de l'utilisateur
    session_start();

    // Connexion à la base de données
    include("./connexionBDD.php");

    // Vérification de la connexion
    if (mysqli_connect_errno()) {
        echo "<p><strong>Erreur de connexion à MySQL: ".mysqli_connect_error()."\nVeuillez réessayer plus tard.</strong></p>";
        exit();
    }
    
        // On teste si nos variables sont définies dans le POST
        if (isset($_POST['login']) && isset($_POST['pwd'])) {
            $login = $_POST['login'];
            $pwd = hash("sha256", $_POST['pwd']);

            $query = 'SELECT * FROM AcheterVehicule_utilisateurs WHERE log = \''.$login.'\' AND  mdp = \''.$pwd.'\';';
            $result = mysqli_query($link,$query);



            if($donnees=mysqli_fetch_assoc($result)) {
                $_SESSION['login'] = $donnees["log"];
                $_SESSION['role'] = $donnees["role"]; // Seulement 2 valeurs possibles, 'client' et 'admin'
                header ('location: index.php');
            }
        
            else {
            echo '<body onLoad="alert(\'Identifiant ou mot de passe incorrect...\')">';
            // Puis on le redirige vers la page de connexion
            echo '<meta http-equiv="refresh" content="0;URL=login.php">';
            }
        }
    else {
        echo '<!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                <title>Document</title>
            </head>
            <body>
                <form action="login.php" method="post">
                    Votre login : <input type="text" name="login">
                <br />
                    Votre mot de passé : <input type="password" name="pwd"><br />
                <input type="submit" value="Connexion">
                </form>
            </body>
            </html>';
    }
?>