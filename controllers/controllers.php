<?php
require_once '../models/connexion-BDD.php';
require_once '../models/Accueil.php';
require_once '../models/LivreDOr.php';

function traiterActionAccueil()
{
    global $bdd;
    if (isset($_POST['id_msg'], $_POST['msg_accueil'], $_POST['para_accueil_un'], $_POST['para_accueil_deux'], $_POST['para_accueil_trois'], $_POST['para_accueil_quatre'])) {
        $id_msg = $_POST['id_msg'];
        $msg_accueil = $_POST['msg_accueil'];
        $paragraphe_un = $_POST['para_accueil_un'];
        $paragraphe_deux = $_POST['para_accueil_deux'];
        $paragraphe_trois = $_POST['para_accueil_trois'];
        $paragraphe_quatre = $_POST['para_accueil_quatre'];

        updateAccueilMessage($bdd, $msg_accueil, $id_msg);
        updateAProposDeNous($bdd, $paragraphe_un, $paragraphe_deux, $paragraphe_trois, $paragraphe_quatre, $id_msg);

        for ($i = 1; $i <= 7; $i++) {
            if (isset($_POST["horaire_matin_$i"], $_POST["horaire_apres_midi_$i"])) {
                $horaire_matin = $_POST["horaire_matin_$i"];
                $horaire_apres_midi = $_POST["horaire_apres_midi_$i"];

                updateHoraireOuverture($bdd, $horaire_matin, $horaire_apres_midi, $i);
            }
        }

        header("Location:../public/index.php?page=accueil");
        exit;
    } else {
        header("Location:../public/index.php?page=404");
        exit;
    }
}

function traiterActionLivreDOr()
{
    global $bdd;
    if (
        empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['tel']) ||
        empty($_POST['accueil']) || empty($_POST['proprete']) || empty($_POST['qualite-produits']) || empty($_POST['commentaire'])
    ) {
        header("Location: ../public/index.php?page=livre-d-or&err=oblig");
        exit();
    } else {
        $tel = $_POST['tel'];
        if (telephoneExisteDeja($bdd, $tel)) {
            header("Location: ../public/index.php?page=livre-d-or&err=existe");
            exit();
        }

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $accueil = $_POST['accueil'];
        $proprete = $_POST['proprete'];
        $qualite = $_POST['qualite-produits'];
        $commentaire = $_POST['commentaire'];

        if (ajouterLivreDOr($bdd, $nom, $prenom, $email, $tel, $accueil, $proprete, $qualite, $commentaire)) {
            header("Location: ../public/index.php?page=livre-d-or&msg=succes");
            exit();
        } else {
            echo "Une erreur s'est produite lors de l'enregistrement dans le livre d'or.";
        }
    }
}

if (isset($_GET['action']) && !empty($_GET['action'])) {
    switch ($_GET['action']) {
        case 'msg-acc':
            traiterActionAccueil();
            break;
        case 'livre-d-or':
            traiterActionLivreDOr();
            break;
        default:
            header("Location:../public/index.php?page=404");
            exit;
    }
} else {
    header("Location:../public/index.php?page=404");
    exit;
}
