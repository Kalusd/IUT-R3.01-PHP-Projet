<?php
    // On renvoie une image
    header("Content-type: image/jpeg");

    $imageSource = "img/".$_GET["chemin"];

    // Paramètres de l'image
    $tailleSource = GetImageSize($imageSource);
    $largeurSource = $tailleSource[0];
    $hauteurSource = $tailleSource[1];

?>