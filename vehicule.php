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
    <title><?php echo $_GET['modele']; ?> - AcheterVehicule</title>
</head>
<body class="container" style="background-color: #202020;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded-bottom" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">AcheterVehicule</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="vehicules.php">Véhicules</a>
            </li>
        </ul>

    <?php
        // Connexion à la base de données
        include("./connexionBDD.php");
        $query = "SELECT * FROM AcheterVehicule_vehicule WHERE modele = '".$_GET['modele']."';";
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

        // Groupe image + texte du véhicule
        $donnees=mysqli_fetch_assoc($result);
        echo '<div class="row mt-3">';
            // Affichage du nom du modèle, prix et description
            echo '<div class="col">';
            echo '<h2 style="color: #fff;">'.$donnees["modele"].'</h2>';
            echo '<h5 style="color: #fff;">'.number_format($donnees["prix"], 2, '.', ' ').' €</h5>';
            echo '<p style="color: #fff;">'.$donnees["description"].'</p>';
            echo '<form action="ajouterPanier.php" method="post" class="mt-3">
                    <input type="hidden" name="article_id" value="'.$donnees['modele'].'">
                    <div class="form-group">
                        <label for="quantite" style="color: #fff;">Quantité :</label>
                        <input type="number" id="quantite" name="quantite" class="form-control" min="1" value="1" required>
                    </div>
                    <div class="form-group text-center mt-3">
                        <input type="submit" value="Ajouter au panier" class="btn btn-success">
                    </div>
                </form>';
            echo '</div>';
            // Affichage image véhicule
            echo '<div class="col">';
            echo '<img src="vignette.php?nom='.$donnees["chemin_Vignette"].'&largeur=640&hauteur=360" class="" alt="'.$donnees["modele"].'">';
            echo '</div>';
        echo '</div>';
        
    ?>
</div>
</body>
</html>