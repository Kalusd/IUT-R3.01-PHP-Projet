<?php
    session_start();

    if (isset($_SESSION['login'])) {
        if ($_SESSION['role'] == "admin") {
            echo "Vous êtes connecté en tant qu'administrateur.";
        }
        else {
            echo '<body onLoad="alert(\'Accès non autorisé à cette page.\')">';
            echo '<meta http-equiv="refresh" content="0;URL=index.php">';
        }
    }
    else {
        echo '<body onLoad="alert(\'Vous n etes pas connecté.\')">';
        echo '<meta http-equiv="refresh" content="0;URL=login.php">';
    }
?>