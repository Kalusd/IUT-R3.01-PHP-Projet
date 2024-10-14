<?php
    // On renvoie une image
    header("Content-type: image/jpeg");

    $cheminImageSource = "img/".$_GET["chemin"];
    $largeurCible = $_GET["largeur"];
    $hauteurCible = $_GET["hauteur"];

    // Paramètres de l'image
    $tailleSource = GetImageSize($imageSource);
    $largeurSource = $tailleSource[0];
    $hauteurSource = $tailleSource[1];

    //Création de la nouvelle image
    $imageCible = imageCreateTrueColor($largeurCible, $hauteurCible);
    $imageSource = imageCreateFromJpeg($cheminImageSource);
    imageCopyResampled($imageCible, $imageSource, 0, 0, 0, 0, $largeurCible, $hauteurCible, $largeurSource, $hauteurSource);

    //Exportation de l'image
    imageJpeg($imageCible, $_GET["chemin"])

?>