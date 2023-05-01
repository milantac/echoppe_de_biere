<?php
session_start();

// Vérification de l'existence de l'ID et si l'utilisateur est administrateur
if (isset($_GET['id']) && isset($_SESSION['type_utilisateur']) && $_SESSION['type_utilisateur'] == 1) {
    // Inclusion de la connexion à la base de données
    require_once('./connexion-BDD.php');

    // Récupération de l'ID de la bière
    $id_biere = intval($_GET['id']);

    // Récupération du nom de l'image à supprimer
    $sql_img = "SELECT img FROM produits WHERE id = :id";
    $stmt_img = $bdd->prepare($sql_img);
    $stmt_img->execute([':id' => $id_biere]);
    $row = $stmt_img->fetch(PDO::FETCH_ASSOC);
    $img_to_delete = $row['img'];

    // Préparation de la requête SQL pour supprimer la bière
    $sql = "DELETE FROM produits WHERE id = :id";

    // Exécution de la requête avec les paramètres directement dans la fonction execute()
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':id' => $id_biere]);

    // Suppression de l'image sur le serveur
    $image_path = '../images/produits/' . $img_to_delete;
    if (file_exists($image_path)) {
        unlink($image_path);
    }

    // Redirection vers la page des bières
    header('Location: ../../public/index.php?page=produits&retour=sup_prod_ok');
    exit();
} else {
    // Redirection vers la page d'accueil si l'utilisateur n'est pas administrateur ou si l'ID n'est pas défini
    header('Location: ../index.php');
    exit();
}