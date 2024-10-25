<?php
    session_start();
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='node_modules/bootstrap/dist/css/bootstrap.css'>
    <script src='node_modules/bootstrap/dist/js/bootstrap.bundle.js'></script>
    <title>Paiement - AcheterVehicule</title>
</head>
<body class="container" style="background-color: #202020; color: #fff;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded-bottom" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">AcheterVehicule</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Accueil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="vehicules.php">Véhicules</a>
            </li>
        </ul>

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

        // Navbar : connexion, déconnexion, back-office
        echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">';
        echo'<li class="nav-item">
            <a class="nav-link" href="panier.php">Panier</a>
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
        
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                echo '<h2 class="mt-3 mb-3">Formulaire de Paiement</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nomComplet">Nom complet :</label>
                        <input type="text" class="form-control" id="nomComplet" name="nomComplet" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Adresse email :</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="addresse">Adresse :</label>
                        <input type="text" class="form-control" id="addresse" name="addresse" required>
                    </div>
                    <div class="form-group">
                        <label for="Ville">Ville :</label>
                        <input type="text" class="form-control" id="Ville" name="Ville" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="region">Région :</label>
                            <input type="text" class="form-control" id="region" name="region" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="codePostal">Code postal :</label>
                            <input type="text" class="form-control" id="codePostal" name="codePostal" required>
                        </div>
                    </div>
                    <h5 class="mt-3">Informations de paiement</h5>
                    <div class="form-group">
                        <label for="cardNumber">Numéro de carte :</label>
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" maxlength="16" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="dateExpiration">Date d\'expiration :</label>
                            <input type="text" class="form-control" id="dateExpiration" name="dateExpiration" placeholder="MM/AA" maxlength="5" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cvv">Code CVV :</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" maxlength="3" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3">Payer maintenant</button>
                </form>';
            case "POST":
                echo 'temp';
        }
        echo '</body>
    </html>';