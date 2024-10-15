<?php
    // On démarre la session de l'utilisateur
    session_start();

    // Connexion à la base de données
    include("./connexionBDD.php");

    // Vérification de la connexion
    if (mysqli_connect_errno()) {
        echo "<p><strong>Failed to connect to MySQL: ".mysqli_connect_error()."</strong></p>";
        exit();
    }

    // TODO: Supprimer les valeurs
    $login_valide = "test";
    $pwd_valide = "test";
    
        // On teste si nos variables sont définies dans le POST
        if (isset($_POST['login']) && isset($_POST['pwd'])) {
            $login = $_POST['login'];
            $pwd = $_POST['pwd'];

            $query = 'SELECT * FROM AcheterVehicule_personnel WHERE log = \''.$login.'\' AND  mdp = \''.$pwd.'\';';
            $result = mysqli_query($link,$query);


            if($donnees=mysqli_fetch_assoc($result)) {
                $_SESSION['login'] = $donnees["log"];
                header ('location: backOffice.php');
                
            }

        else {
            echo '<body onLoad="alert(\'Identifiant ou mot de passe incorrect...\')">';
            // Puis on le redirige vers la page d'accueil
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