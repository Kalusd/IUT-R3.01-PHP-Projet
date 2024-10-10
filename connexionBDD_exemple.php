<?php 
    $DATABASE = "";
    $USER = "";
    $PASSWORD = "";
    $HOST = "";

    $link = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE) or "Impossible de se connecter à la base de données";
?>