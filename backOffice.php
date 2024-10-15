<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel='stylesheet' type='text/css' href='node_modules/bootstrap/dist/css/bootstrap.css'>-->
    <!--<script src='node_modules/bootstrap/dist/js/bootstrap.bundle.js'></script>-->
    <title>Back-office</title> <!-- MODIFIER TITRE -->
</head>
<body>
    <?php

        var_dunp($_SESSION['login']);
        
        if($_SESSION['login'] == "admin"){
            echo "Vous êtes connecté.";
        }
        else{
            echo "Vous n'êtes pas connecté.";
        }
    ?>
</body>
</html>