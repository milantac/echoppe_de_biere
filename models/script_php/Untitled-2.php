<?php
// inclure le fichier de connexion à la base de données
include('./connexion-BDD.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == "horaire-ouverture") {
        // Vérification de la validité des champs
        if (empty($_POST['horaire-matin']) || empty($_POST['horaire-apres-midi'])) {
            header("Location:../../public/index.php?page=form_modif&action=modif-heure&idt=" . $_POST['id'] . "&err=oblig");
            // echo "Les champs horaire Matin et horaire Après-midi sont obligatoires.";
            exit();
        } else {

            if (    //regex de controle de la saissie des horaire d'ouverture
                !preg_match('/^(Fermé|\b([01]\d|2[0-3]):([0-5]\d)\s*-\s*([01]\d|2[0-3]):([0-5]\d)\b){1,13}$/', $_POST['horaire-matin'])
                ||
                !preg_match('/^(Fermé|\b([01]\d|2[0-3]):([0-5]\d)\s*-\s*([01]\d|2[0-3]):([0-5]\d)\b){1,13}$/', $_POST['horaire-apres-midi'])
            ) {
                header("Location: ../../public/index.php?page=form_modif&action=modif-heure&idt=" . $_POST['id'] . "&err=noValid");
                // echo "Les champs horaire Matin et horaire Après-midi ne sont pas valides.";
                exit();
            } else {
                // Préparation de la requête
                $stmt = $bdd->prepare(
                    "   UPDATE horaire_ouverture 
                        SET jour = :jour, 
                            horaire_matin = :horaire_matin, 
                            horaire_apres_midi = :horaire_apres_midi
                        WHERE id_horaire_ouverture = :id_horaire_ouverture"
                );

                // Récupération des données du formulaire
                $id = $_POST['id'];
                $jour = $_POST['jour'];
                $horaire_matin = $_POST['horaire-matin'];
                $horaire_apres_midi = $_POST['horaire-apres-midi'];

                // Exécution de la requête préparée
                $stmt->execute(
                    array(
                        ':id_horaire_ouverture' => $id,
                        ':jour' => htmlspecialchars($jour),
                        ':horaire_matin' => htmlspecialchars($horaire_matin),
                        ':horaire_apres_midi' => htmlspecialchars($horaire_apres_midi)
                    )
                );
                // Vérification de la mise à jour
                if ($stmt->rowCount() > 0) {
                    // Redirection vers la page d'accueil
                    header("Location: ../../public/index.php?page=accueil");
                    exit();
                } else {
                    // Affichage d'un message d'erreur
                    echo "Une erreur s'est produite lors de la mise à jour des horaires d'ouverture.";
                }
            }
        }
    } else if ($_GET['action'] == "msg-acc") {
        if (empty($_POST['id_msg']) || empty($_POST['id_msg'])) {
            header("Location:../../public/index.php?page=form_modif&action=modif-msg-acc&idt=" . $_POST['id_msg'] . "&err=oblig");
            // echo "Les champs horaire Matin et horaire Après-midi sont obligatoires.";
            exit();
        } else {
            // Préparation de la requête
            $stmt = $bdd->prepare(
                "   UPDATE a_propos_de_nous 
                    SET paragraphe_un = :para_accueil_un, 
                        paragraphe_deux = :para_accueil_deux,
                        paragraphe_trois = :para_accueil_trois,
                        paragraphe_quatre = :para_accueil_quatre
                    WHERE id_msg_accueil = :idt
                "
            );

            // Récupération des données du formulaire
            $idt = $_POST['id_msg'];
            $para_accueil_un = $_POST['para_accueil_un'];
            $para_accueil_deux = $_POST['para_accueil_deux'];
            $para_accueil_trois = $_POST['para_accueil_trois'];
            $para_accueil_quatre = $_POST['para_accueil_quatre'];

            // Exécution de la requête préparée
            $stmt->execute(
                array(
                    ':idt' => $idt,
                    ':para_accueil_un' => htmlspecialchars($para_accueil_un),
                    ':para_accueil_deux' => htmlspecialchars($para_accueil_deux),
                    ':para_accueil_trois' => htmlspecialchars($para_accueil_trois),
                    ':para_accueil_quatre' => htmlspecialchars($para_accueil_quatre)
                )
            );

            // Vérification de la mise à jour
            if ($stmt->rowCount() > 0) {
                // Redirection vers la page d'accueil
                header("Location: ../../public/index.php?page=accueil");
                exit();
            } else {
                // Affichage d'un message d'erreur
                echo "Une erreur s'est produite lors de la mise à jour du message d'accueil.";
            }
        }
    } else if ($_GET['action'] == 'livre-d-or') {
        // Vérification de la validité des champs
        if (
            empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['tel']) ||
            empty($_POST['accueil']) || empty($_POST['proprete']) || empty($_POST['qualite-produits']) ||
            empty($_POST['commentaire'])
        ) {
            header("Location: ../../public/index.php?page=livre-d-or&err=oblig");
            exit();
        } else {
            // Vérification si le numéro de téléphone existe déjà dans la table livre_d_or
            $stmt = $bdd->prepare("SELECT COUNT(*) FROM livre_d_or WHERE telephone = :tel");
            $stmt->execute(array(':tel' => $_POST['tel']));
            $count = $stmt->fetchColumn();
            if ($count > 0) {
                header("Location: ../../public/index.php?page=livre-d-or&err=existe");
                exit();
            }
            // Préparation de la requête
            $stmt = $bdd->prepare(
                "INSERT INTO livre_d_or(nom, 
                                        prenom, 
                                        email, 
                                        telephone, 
                                        note_accueil_services, 
                                        note_proprete, 
                                        note_qualite_produit, 
                                        commentaire, 
                                        validation_livre_d_or)
                 VALUES (:nom, 
                        :prenom, 
                        :email, 
                        :tel, 
                        :accueil, 
                        :proprete, 
                        :qualite, 
                        :commentaire, 
                        0)"
            );

            // Récupération des données du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $accueil = $_POST['accueil'];
            $proprete = $_POST['proprete'];
            $qualite = $_POST['qualite-produits'];
            $commentaire = $_POST['commentaire'];

            // Exécution de la requête préparée
            $stmt->execute(
                array(
                    ':nom' => htmlspecialchars($nom),
                    ':prenom' => htmlspecialchars($prenom),
                    ':email' => htmlspecialchars($email),
                    ':tel' => htmlspecialchars($tel),
                    ':accueil' => htmlspecialchars($accueil),
                    ':proprete' => htmlspecialchars($proprete),
                    ':qualite' => htmlspecialchars($qualite),
                    ':commentaire' => htmlspecialchars($commentaire)
                )
            );

            // Vérification de l'insertion
            if ($stmt->rowCount() > 0) {
                // Redirection vers la page d'accueil
                header("Location: ../../public/index.php?page=livre-d-or&msg=succes");
                exit();
            } else {
                // Affichage d'un message d'erreur
                echo "Une erreur s'est produite lors de l'enregistrement dans le livre d'or.";
            }
        }
    } else if ($_GET['action'] == 'valid_com') {
        // Récupération des données du formulaire
        $livre_d_or_admin = $_POST['livre_d_or'];

        // Vérifier si des commentaires ont été saisis et si la case à cocher est cochée
        $nb_commentaires_valides = 0;
            foreach ($livre_d_or_admin as $resultat) {
                $id_livre_d_or = $resultat['id_livre_d_or'];
                $commentaire = $_POST['commentaire'][$id_livre_d_or];
                $validation = isset($_POST['validation_livre_d_or'][$id_livre_d_or]) ? 1 : 0;

            if (!empty($commentaire)) {
                // Préparation de la requête
                $stmt = $bdd->prepare(
                    "UPDATE livre_d_or
                SET commentaire = :commentaire,
                    validation_livre_d_or = :validation
                WHERE id_livre_d_or = :id"
                );

                // Exécution de la requête préparée
                $stmt->execute(
                    array(
                        ':id' => htmlspecialchars($id_livre_d_or),
                        ':commentaire' => htmlspecialchars($commentaire),
                        ':validation' => htmlspecialchars($validation)
                    )
                );

                // Vérification de la mise à jour
                if ($stmt->rowCount() > 0) {
                    $nb_commentaires_valides++;
                }
            }
        }

        // Redirection vers la page d'accueil
        if ($nb_commentaires_valides > 0) {
            header("Location: ../../public/index.php?page=livre-d-or&msg=succes");
            exit();
        } else {
            // Affichage d'un message d'erreur
            echo "Veuillez saisir au moins un commentaire et cocher la case pour valider.";
        }
    }
}
