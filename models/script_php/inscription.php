<?php
// Inclure le fichier de connexion à la base de données
include('./connexion-BDD.php');

// Vérification de l'envoi des données du formulaire
if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['telephone'], $_POST['numero-adresse'], $_POST['voie-adresse'], $_POST['cp-adresse'], $_POST['ville-adresse'], $_POST['motdepasse'])) {
    // Récupération des données du formulaire et protection contre les injections SQL
    $nom = htmlspecialchars(trim($_POST['nom']));       //trim(): permet de supprimer les caractères invisibles en début et fin de chaîne
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $numero_adresse = htmlspecialchars(trim($_POST['numero-adresse']));
    $voie_adresse = htmlspecialchars(trim($_POST['voie-adresse']));
    $cp_adresse = htmlspecialchars(trim($_POST['cp-adresse']));
    $ville_adresse = htmlspecialchars(trim($_POST['ville-adresse']));
    $motdepasse = htmlspecialchars(trim($_POST['motdepasse']));

    // Vérification que les champs ne sont pas vides
    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($telephone) && !empty($numero_adresse) && !empty($voie_adresse) && !empty($cp_adresse) && !empty($ville_adresse) && !empty($motdepasse)) {
        // Cryptage du mot de passe
        $motdepasse_crypte = password_hash($motdepasse, PASSWORD_DEFAULT);

        // Spécification du type d'utilisateur (1 pour un administrateur et 2 pour un utilisateur normal)
        $type_utilisateur = 2;

        // Préparation de la requête
        $sql = "INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, mail_utilisateur, tel_utilisateur, numero_adresse, voie_adresse, code_postal, ville_adresse, mdp_utilisateur, type_utilisateur)
                VALUES (:nom_utilisateur, :prenom_utilisateur, :mail_utilisateur, :tel_utilisateur, :numero_adresse, :voie_adresse, :code_postal, :ville_adresse, :mdp_utilisateur, :type_utilisateur)";
        // Préparation de la requête
        $stmt = $bdd->prepare($sql);
        if ($stmt->execute(array(   ':nom_utilisateur'=> $nom, 
        ':prenom_utilisateur'=> $prenom, 
        ':mail_utilisateur'=> $email, 
        ':tel_utilisateur'=> $telephone, 
        ':numero_adresse'=> $numero_adresse, 
        ':voie_adresse'=> $voie_adresse, 
        ':code_postal'=> $cp_adresse, 
        ':ville_adresse'=> $ville_adresse, 
        ':mdp_utilisateur'=> $motdepasse_crypte, 
        ':type_utilisateur'=> $type_utilisateur))) {
            // Redirection vers la page de succès (à personnaliser)
            header("Location:../../public/index.php?page=accueil&msg=success");
            exit;
        } else {
            // Redirection vers la page d'erreur (à personnaliser)
            header("Location:../../public/index.php?page=accueil&msg=error");
            exit;
        }
    } else {
        // Redirection vers la page d'erreur pour les champs vides (à personnaliser)
        header("Location:../../public/index.php?page=form_inscription&msg=champ-vide");
        exit;
    }
}