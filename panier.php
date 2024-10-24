<?php
session_start(); // Démarre ou reprend la session

// Connexion à la base de données
include("./connexionBDD.php");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='node_modules/bootstrap/dist/css/bootstrap.css'>
    <script src='node_modules/bootstrap/dist/js/bootstrap.bundle.js'></script>
    <title>Mon Panier</title>
</head>
<body class="container" style="background-color: #202020; color: #fff;">
<nav class="navbar navbar-expand-lg bg-body-tertiary rounded-bottom" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">AcheterVehicule</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link"  href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="vehicules.php">Véhicules</a>
            </li>
        </ul>
    

    <?php

    // Navbar : connexion, déconnexion, back-office
    echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">';
    echo'<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Panier</a>
    </li>';
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




    echo '<h1 class="mt-4">Votre Panier</h1>';
    // Vérifie si le panier existe et n'est pas vide
    if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
        echo '<table class="table table-striped table-dark mt-3">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Modèle</th>';
        echo '<th scope="col">Prix Unitaire (€)</th>';
        echo '<th scope="col">Quantité</th>';
        echo '<th scope="col">Suppression</th>';
        echo '<th scope="col">Total (€)</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        $totalPanier = 0; // Pour calculer le total général du panier

        // Parcours du panier dans la session
        foreach ($_SESSION['panier'] as $article_id => $quantite) {
            
            
            $query = "SELECT * FROM AcheterVehicule_vehicule WHERE modele = '".mysqli_real_escape_string($link, $article_id)."';";
            $result = mysqli_query($link, $query);

            if ($donnees = mysqli_fetch_assoc($result)) {
                // Calcul du total pour cet article
                $totalArticle = $donnees['prix'] * $quantite;
                $totalPanier += $totalArticle;

                // Affichage des informations de l'article
                echo '<tr>';
                echo '<td style="vertical-align: middle;">'.$donnees['modele'].'</td>';
                echo '<td style="vertical-align: middle;">'.$donnees['prix'].'</td>';
                echo '<td style="vertical-align: middle;">'.$quantite.'</td>';
                echo '<td style="vertical-align: middle;"><form action=modifierPanier.php method="post">
                    <input type="hidden" name="article_id" value="'.$donnees['modele'].'">
                    <input type="hidden" name="action" value="suppression">
                    <div class="form-group text-center">
                        <input type="submit" value="Supprimer du panier" class="btn btn-danger">
                    </div>
                </form></td>';
                echo '<td style="vertical-align: middle;">'.number_format($totalArticle, 2, '.', ' ').'</td>';
                echo '</tr>';
            }
        }

        // Affiche le total
        echo '<tr>';
        echo '<td colspan="4"><strong>Total général :</strong></td>';
        echo '<td><strong>'.number_format($totalPanier, 2, '.', ' ').' €</strong></td>';
        echo '</tr>';

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Votre panier est vide.</p>';
    }
    ?>

    <div class="mt-4">
        <a href="vehicules.php" class="btn btn-primary">Continuer vos achats</a>
        <a href="checkout.php" class="btn btn-success">Passer la commande</a>
    </div>
</body>
</html>
