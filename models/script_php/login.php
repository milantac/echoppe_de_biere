<?php
session_start(); // Initialisation des variables de session

// Inclure le fichier de connexion à la base de données
include('./connexion-BDD.php');
include('../utils.php');

if (isset($_POST['mail'], $_POST['mdp'])) {
    $mail = htmlspecialchars(trim($_POST['mail']));
    $mdp = htmlspecialchars(trim($_POST['mdp']));

    if (!empty($mail) && !empty($mdp)) {
        // Requête pour récupérer l'utilisateur correspondant à l'e-mail entré
        $sql = "SELECT * FROM users WHERE login = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array($mail));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) { // Vérification que l'utilisateur existe
            if (password_verify($mdp, $user['mdp'])) { // Vérification du mot de passe
                $_SESSION['connecter'] = 1;
                $_SESSION['id_utilisateur'] = $user['id']; // Enregistrement de l'ID de l'utilisateur en variable de session
                $_SESSION['nom_utilisateur'] = $user['nom']; // Enregistrement du nom de l'utilisateur en variable de session
                $_SESSION['prenom_utilisateur'] = $user['prenom']; // Enregistrement du prénom de l'utilisateur en variable de session
                $_SESSION['type_utilisateur'] = $user['niveau_droits']; // Enregistrement du type d'utilisateur en variable de session
                generate_csrf_token(); 
                header("Location:../../public/index.php?page=accueil"); // Redirection vers la page d'accueil
                exit;
            } else {
                header("Location:../../public/index.php?page=form_connexion&retour=mdpKO");
                exit;
                // $msg_error = "Le mot de passe est incorrect.";
            }
        } else {
            header("Location:../../public/index.php?page=form_connexion&retour=mail_inconnu");
            exit;
            // $msg_error = "Aucun utilisateur n'a été trouvé avec cet e-mail.";
        }
    } else {
        header("Location:../../public/index.php?page=form_connexion&retour=vide");
        exit;
        // $msg_error = "Tous les champs doivent être remplis.";
    }
}
