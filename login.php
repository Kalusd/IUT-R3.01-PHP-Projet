<?php
    // On démarre la session de l'utilisateur
    session_start();

    // Connexion à la base de données
    include("./connexionBDD.php");

    // TODO: Supprimer les valeurs
    $login_valide = "test";
    $pwd_valide = "test";
    
    // On teste si nos variables sont définies dans le POST
    if (isset($_POST['login']) && isset($_POST['pwd'])) {
        $query = "SELECT * FROM AcheterVehicule_personnel";
        $result = mysqli_query($link,$query);
        
        // On vérifie les informations saisies
        if ($login_valide == $_POST['login'] && $pwd_valide == $_POST['pwd']) { // TODO: Remplacer par infos connexion dans bdd
            // On enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd)
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['pwd'] = $_POST['pwd'];
            // On redirige notre visiteur vers une page de notre section membre
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