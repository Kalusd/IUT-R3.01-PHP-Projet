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
                <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
                <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
                <title>Connexion - AcheterVehicule</title>
            </head>
            <body class="container" style="background-color: #202020;">
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
                    </div>
                </div>
                </nav>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <form action="login.php" method="post" class="mt-5">
                                <div class="form-group">
                                    <label for="login" style="color: #fff;">Votre login :</label>
                                    <input type="text" id="login" name="login" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd" style="color: #fff;">Votre mot de passe :</label>
                                    <input type="password" id="pwd" name="pwd" class="form-control" required>
                                </div>
                                <div class="form-group text-center mt-3">
                                    <input type="submit" value="Connexion" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </body>
            </html>';
    }
?>