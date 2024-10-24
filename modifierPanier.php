<?php
session_start(); 

// Vérifie si le formulaire a été correctement envoyé
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action']== 'ajout') {
        
    $article_id = $_POST['article_id']; 
    $quantite = intval($_POST['quantite']); 

    // Vérifie si la session 'panier' existe, sinon la crée
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array(); // Initialise un panier vide
    }

    // Si l'article existe déjà dans le panier, incrémente la quantité
    if (isset($_SESSION['panier'][$article_id])) {
        $_SESSION['panier'][$article_id] += $quantite;
    } else {
        // Sinon, ajoute l'article avec la quantité sélectionnée
        $_SESSION['panier'][$article_id] = $quantite;
    }
    }

    elseif ($_POST['action']=='suppression') {
            $article_id = $_POST['article_id']; 
            $quantite = $_SESSION['panier'][$article_id] - 1; 

        if($quantite <= 0){
            unset($_SESSION['panier'][$article_id]);
        }
        else{
        $_SESSION['panier'][$article_id] = $quantite;
        }
    }

    // Redirige vers la page précédente après l'ajout au panier
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}
?>