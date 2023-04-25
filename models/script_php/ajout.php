<?php
// Inclure le fichier de connexion à la base de données
include('./connexion-BDD.php');
require_once(__DIR__ . '\../\function_Accueil_Json.php');


echo($_SESSION['type_utilisateur']);
// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['type_utilisateur']) || $_SESSION['type_utilisateur'] == 1) {
    
// Vérifier si l'action est définie dans l'URL et n'est pas vide
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        switch ($_GET['action']) {
            case 'msg-acc':
                // Charger les données du fichier JSON
                $data = read_json_file(__DIR__ . '/../../data/accueil.json');

                // Mettre à jour les informations de la page d'accueil
                $data['accueil']['msg_accueil'] = $_POST['msg_accueil'];
                $data['accueil']['paragraphe_un'] = $_POST['para_accueil_un'];
                $data['accueil']['paragraphe_deux'] = $_POST['para_accueil_deux'];
                $data['accueil']['paragraphe_trois'] = $_POST['para_accueil_trois'];
                $data['accueil']['paragraphe_quatre'] = $_POST['para_accueil_quatre'];

                // Mettre à jour les horaires d'ouverture
                foreach ($data['horaires'] as $key => $horaire) {
                    $data['horaires'][$key]['horaire_matin'] = $_POST['horaire_matin_' . $key];
                    $data['horaires'][$key]['horaire_apres_midi'] = $_POST['horaire_apres_midi_' . $key];
                }

                // Sauvegarder les modifications dans le fichier JSON
                write_json_file(__DIR__ . '/../../data/accueil.json', $data);

                // Rediriger vers la page de modification
                header('Location: ../../public/index.php?page=form_modif&action=accueil');
                exit;

            case 'livre-d-or':
                // Vérification de la validité des champs
                if (
                    empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['tel']) ||
                    empty($_POST['accueil']) || empty($_POST['proprete']) || empty($_POST['qualite-produits']) || empty($_POST['commentaire'])
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
                break;

            case 'valid_com':
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
                break;

            case 'new-biere':
                // Si le formulaire a été soumis
                if (isset($_POST['nom_biere']) && isset($_POST['degres_d_alcool']) && isset($_POST['quantite']) && isset($_POST['description']) && isset($_POST['id_type_de_biere']) && isset($_POST['id_origine']) && isset($_FILES['photo'])) {

                    // Récupération des données du formulaire
                    $nom_biere = htmlspecialchars(trim($_POST['nom_biere']));
                    $degres_d_alcool = htmlspecialchars(trim($_POST['degres_d_alcool']));
                    $quantite = htmlspecialchars(trim($_POST['quantite']));
                    $description = htmlspecialchars(trim($_POST['description']));
                    $en_stock = isset($_POST['en_stock']) ? 1 : 0;
                    $id_type_de_biere = htmlspecialchars(trim($_POST['id_type_de_biere']));
                    $id_origine = htmlspecialchars(trim($_POST['id_origine']));

                    // Gestion de l'upload de l'image
                    //upload du fichier s'il y en a un 
                    if (isset($_FILES['photo']) && !empty($_FILES["photo"]["name"])) {
                        //Dossier dans lequel va être déposé le fichier
                        $dossier = '../../public/images/produits/';
                        //On fixe la taille max acceptée
                        $taille_max = 1000000;
                        //On fixe la liste des extensions acceptées
                        $extensions = array('.png', '.jpg', '.jpeg', '.gif', '.webp');

                        //Récupération du nom du fichier 
                        $photo = basename($_FILES['photo']['name']);

                        //Récupération de la taille du fichier
                        $taille = filesize($_FILES['photo']['tmp_name']);

                        //Récupération de l'extension du fichier
                        $extension = strchr($_FILES['photo']['name'], '.');

                        //Vérification si extension acceptée
                        if (!in_array($extension, $extensions)) {
                            // header("location:../index.php?page=form_ex&action=ajout&retour=ext");
                            exit;
                        }

                        //Vérification taille du fichier < max
                        if ($taille > $taille_max) {
                            header("location:../index.php?page=form_ajout_biere&retour=taille");
                            exit;
                        }

                        //Vérification qu'aucun caratère etrange n'est dans le fichier 
                        if (!isset($erreur)) {
                            $photo = preg_replace('/([^.a-z0-9]+)/i', '_', $photo);

                            //Upload du fichier
                            move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $photo);
                        }
                    } else {
                        //Pas de nouveau fichier, on récupère l'ancien
                        $photo = "defaut.png";
                    }

                    // Requête préparée pour insérer la bière dans la base de données
                    $stmt = $bdd->prepare("INSERT INTO biere (nom_biere, photo, degres_d_alcool, quantite, description, en_stock, id_type_de_biere, id_origine) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

                    // Exécution de la requête avec les données du formulaire
                    $stmt->execute(array($nom_biere, $photo, $degres_d_alcool, $quantite, $description, $en_stock, $id_type_de_biere, $id_origine));

                    // Redirection vers une autre page ou affichage d'un message de succès
                    header('Location: ../../public/index.php?page=produits&msg=success');
                    exit;
                }
                break;

            default:
                // Rediriger vers la page 404 si l'action n'est pas reconnue
                header("Location:../../public/index.php?page=404");
                exit;
        }
    } else {
        // Rediriger vers la page 404 si l'action n'est pas définie
        header("Location: ../../public/index.php?page=404");
        exit;
    }
}else{
    header('Location: ../../public/index.php?page=403');
    exit;
}