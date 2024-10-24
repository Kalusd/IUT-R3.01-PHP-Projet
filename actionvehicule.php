<?php
        // Vérification du rôle administrateur de l'utilisateur
        include("verif_connect_admin.php");

        // Connexion à la base de données
        include("./connexionBDD.php");

        //---------------------------------------------------//
        //                  LOGIQUE METIER                   //
        //---------------------------------------------------//

        // Si on a une action définie dans le POST = on doit exécuter l'action car confirmation déjà demandée à l'utilisateur
        if (isset($_POST['supprimer'])) {
            try {
                // Récupération des informations dans le POST
                $modele = $_POST['modele'];
                // Requête SQL (on sélectionne la colonne chemin_Vignette pour le véhicule actuel)
                $query = "SELECT chemin_Vignette FROM AcheterVehicule_vehicule WHERE modele = '".$modele."';";
                $result = mysqli_query($link,$query);
                $donnees=mysqli_fetch_assoc($result);
                $ancienneImage = $donnees['chemin_Vignette'];
                if (file_exists($ancienneImage)) { // Si l'image existe déjà
                    unlink($ancienneImage); // On la supprime
                }
                // Requête SQL (on supprime l'entrée dans la table pour le véhicule actuel)
                $query = "DELETE FROM AcheterVehicule_vehicule WHERE modele = '".$modele."';";
                $result = mysqli_query($link,$query);
                // Confirmation de l'exécution de la requête et redirection vers le back-office
                echo '<body onLoad="alert(\'Véhicule supprimé avec succès.\')">';
                echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
                exit();
            } catch (Exception $e) { // Si une erreur est survenue quelque part dans le bloc try
                // On encode le message pour qu'il puisse correctement être affiché en html et javascript
                $message = json_encode("Une erreur est survenue : ".htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
                // Puis on affiche le message précédent
                echo "<body onLoad='alert($message)'>";
                echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
                exit();
            }
            
        }
        elseif (isset($_POST['modifier'])) {
            try {
                // Récupération des informations dans le POST
                $modele = $_POST['modele'];
                $prix = $_POST['prix'];
                $description = $_POST['description'];
                $objetImage = $_FILES['image'];
                // Requête SQL (on sélectionne la colonne chemin_Vignette pour le véhicule actuel)
                $query = "SELECT chemin_Vignette FROM AcheterVehicule_vehicule WHERE modele = '".$modele."';";
                $result = mysqli_query($link,$query);
                $donnees = mysqli_fetch_assoc($result);
                $nomImage = $donnees['chemin_Vignette'];
                // Si une image est transférée
                if ($objetImage['size'] != '0') {
                    $nomImage = './img/'.$objetImage['name'];
                    if ($objetImage['type'] !== 'image/jpeg') { // Si le fichier n'est pas une image jpeg
                        // On lève une exception qui sera gérée par le bloc catch
                        throw new Exception("Seules les images jpeg sont autorisées");
                    }
                    // On récupère le nom de l'ancienne image
                    $ancienneImage = $donnees['chemin_Vignette'];
                    if (file_exists($ancienneImage)) { // Si l'image existe déjà
                        unlink($ancienneImage); // On la supprime
                    }
                    // On enregistre l'image transférée dans le formulaire dans le dossier img
                    move_uploaded_file($objetImage["tmp_name"], "./img/$nomImage");
                }
                // Requête SQL (on modifie les valeurs des colonnes pour le véhicule actuel)
                $query = "UPDATE AcheterVehicule_vehicule SET prix = '".$prix."', chemin_Vignette = '".$nomImage."', description = '".$description."' WHERE modele = '".$modele."';";
                $result = mysqli_query($link,$query);
                // Confirmation de l'exécution de la requête et redirection vers le back-office
                echo '<body onLoad="alert(\'Véhicule ajouté avec succès.\')">';
                echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
                exit();
            } catch (Exception $e) { // Si une erreur est survenue quelque part dans le bloc try
                // On encode le message pour qu'il puisse correctement être affiché en html et javascript
                $message = json_encode("Une erreur est survenue : ".htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
                // Puis on affiche le message précédent
                echo "<body onLoad='alert($message)'>";
                echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
                exit();
            }
        }
        elseif (isset($_POST['ajouter'])) {
            try {
                // Récupération des informations dans le POST
                $modele = $_POST['modele'];
                $prix = $_POST['prix'];
                $description = $_POST['description'];
                $objetImage = $_FILES['image'];
                $nomImage = $objetImage['name'];
                if ($objetImage['type'] !== 'image/jpeg') { // Si le fichier n'est pas une image jpeg
                    // On lève une exception qui sera gérée par le bloc catch
                    throw new Exception("Seules les images jpeg sont autorisées");
                }
                // On enregistre l'image transférée dans le formulaire dans le dossier img
                move_uploaded_file($objetImage["tmp_name"], "./img/$nomImage");
                // Requête SQL (on ajoute une entrée dans la table pour le véhicule actuel)
                $query = 'INSERT INTO AcheterVehicule_vehicule VALUES ("'.$modele.'", "'.$prix.'", "./img/'.$nomImage.'", "'.$description.'");';
                $result = mysqli_query($link,$query);
                // Confirmation de l'exécution de la requête et redirection vers le back-office
                echo '<body onLoad="alert(\'Véhicule ajouté avec succès.\')">';
                echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
                exit();
            } catch (Exception $e) { // Si une erreur est survenue quelque part dans le bloc try
                // On encode le message pour qu'il puisse correctement être affiché en html et javascript
                $message = json_encode("Une erreur est survenue : ".htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
                // Puis on affiche le message précédent
                echo "<body onLoad='alert($message)'>";
                echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
                exit();
            }
        }

        //---------------------------------------------------//
        //                    INTERFACE                      //
        //---------------------------------------------------//

        // Vérification de l'action à effectuer
        if (!isset($_GET['action'])) { // Si aucune action n'est définie (ex: accès depuis l'url à la main)
            // On affiche un message d'erreur puis on redirige l'utilisateur vers l'accueil
            echo '<body onLoad="alert(\'Paramètres invalides.\')">';
            echo '<meta http-equiv="refresh" content="0;URL=index.php">';
            exit();
        }

        // Affichage de la partie commune de la page web
        echo '<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
            <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
            <title>Gestion d\'un véhicule - AcheterVehicule</title>
        </head>
        <body class="container" style="background-color: #202020;">
            <nav class="navbar navbar-expand-lg bg-body-tertiary rounded-bottom" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">AcheterVehicule</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="vehicules.php">Véhicules</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="backOffice.php">Back-office</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Déconnexion</a>
                    </li>
                </ul>
                </div>
            </div>
            </nav>
            <div class="container mt-3">';

        switch ($_GET['action']) {
            case 'supprimer': // Si on souhaite supprimer un véhicule
                // On affiche le formulaire de confirmation de suppression
                echo '<h2 style="color: #fff;">Confirmation de suppression</h2>
                <div class="alert alert-warning">
                    Êtes-vous sûr de vouloir supprimer le véhicule <strong>'.$_GET['modele'].'</strong> ?
                </div>
                <form action="" method="post">
                    <input type="hidden" name="modele" value="'.$_GET['modele'].'">
                    <button type="submit" name="supprimer" class="btn btn-danger">Oui, supprimer</button>
                    <a href="backOffice.php" class="btn btn-secondary">Non, annuler</a>
                </form>';
                break;
            case 'modifier': // Si on souhaite modifier un véhicule
                // Requête SQL (on récupère les valeurs pour le véhicule actuel)
                $query = "SELECT * FROM AcheterVehicule_vehicule WHERE modele = '".$_GET['modele']."';";
                $result = mysqli_query($link,$query);
                $donnees=mysqli_fetch_assoc($result);
                // On affiche le formulaire de modification du véhicule
                echo '<h2 style="color: #fff;">Modifier le véhicule "'.$_GET['modele'].'"</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="modele" value="'.$_GET['modele'].'" required>
                    <div class="form-group">
                        <label for="prix" style="color: #fff;">Prix :</label>
                        <input type="number" class="form-control" id="prix" name="prix" value="'.$donnees['prix'].'" required>
                    </div>
                    <div class="form-group">
                        <label for="image" style="color: #fff;">Image du véhicule (facultatif) :</label>
                        <label for="image"style="color: #fff;" class="mt-2 mb-1"><img src="vignette.php?nom='.$donnees["chemin_Vignette"].'&largeur=426&hauteur=240" alt="Image actuelle"></label>
                        <input type="file" accept="image/jpeg" class="form-control" id="image" name="image">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" style="color: #fff;">Description :</label>
                        <textarea class="form-control" id="description" name="description" rows="6">'.$donnees['description'].'</textarea>
                    </div>
                    <button type="submit" name="modifier" class="btn btn-success">Modifier</button>
                    <a href="backOffice.php" class="btn btn-secondary">Annuler</a>
                </form>';
                break;
            case 'ajouter': // Si on souhaite ajouter un véhicule
                // On affiche le formulaire d'ajout de véhicule
                echo '<h2 style="color: #fff;">Ajouter un véhicule</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="modele" style="color: #fff;">Modèle :</label>
                        <input type="text" class="form-control" id="modele" name="modele" required>
                    </div>
                    <div class="form-group">
                        <label for="prix" style="color: #fff;">Prix :</label>
                        <input type="number" class="form-control" id="prix" name="prix" required>
                    </div>
                    <div class="form-group">
                        <label for="image" style="color: #fff;">Image du véhicule :</label>
                        <input type="file" accept="image/jpeg" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" style="color: #fff;">Description :</label>
                        <textarea class="form-control" id="description" name="description" rows="6"></textarea>
                    </div>
                    <button type="submit" name="ajouter" class="btn btn-success">Ajouter</button>
                    <a href="backOffice.php" class="btn btn-secondary">Annuler</a>
                </form>';
                break;
            default: // Dans tous les autres cas
                // On affiche un message d'erreur puis on redirige l'utilisateur vers l'accueil
                echo '<body onLoad="alert(\'Paramètres invalides.\')">';
                echo '<meta http-equiv="refresh" content="0;URL=index.php">';
                exit();
                break;
        }
        echo '</div>
        </body>
        </html>';
    ?>