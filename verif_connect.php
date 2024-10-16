<?php
    session_start();

    if (!isset($_SESSION['login'])) {
        echo '<body onLoad="alert(\'Vous n etes pas connecté.\')">';
        echo '<meta http-equiv="refresh" content="0;URL=login.php">';
    }
?>