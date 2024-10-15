<?php 
    $DATABASE = "";
    $USER = "";
    $PASSWORD = "";
    $HOST = "lakartxela.iutbayonne.univ-pau.fr";

    $link = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE) or "Impossible de se connecter à la base de données";
?>