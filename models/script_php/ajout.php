<?php
// Inclure le fichier de connexion à la base de données
include('./connexion-BDD.php');
session_start();
ob_start();
require_once(__DIR__ . '\../\function_Accueil_Json.php');

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['type_utilisateur']) || $_SESSION['type_utilisateur'] == 1) {

    // Vérifier si l'action est définie dans l'URL et n'est pas vide
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        switch ($_GET['action']) {
            case 'msg-acc': 
            {
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
            }
            case 'livre-d-or': 
            {
                // Vérification de la validité des champs
                if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['commentaire'])) {
                    header("Location: ../../public/index.php?page=livre-d-or&err=oblig");
                    exit();
                } else {
                    // Vérification si le nemail existe déjà dans la table livre_or_commentaire
                    $stmt = $bdd->prepare("SELECT COUNT(*) FROM livre_d_or WHERE email = :mail");
                    $stmt->execute(array(':mail' => $_POST['mail']));
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
                    $commentaire = $_POST['commentaire'];

                    // Exécution de la requête préparée
                    $stmt->execute(
                        array(
                            ':nom' => htmlspecialchars($nom),
                            ':prenom' => htmlspecialchars($prenom),
                            ':email' => htmlspecialchars($email),
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
            }

            case 'valid_com': 
            {
                if(isset($_GET['token']) && isset($_SESSION['csrf_token']) && $_GET['token'] == $_SESSION['csrf_token'])
                {
                    // Récupération des données du formulaire
                    $livre_d_or_entries = $_POST['livre_d_or'];

                    // Compteur pour les mises à jour réussies
                    $nb_commentaires_valides = 0;
                    foreach ($livre_d_or_entries as $entry) {
                        $id = (int)$entry['id'];
                        if (!isset($_POST['commentaire'][$id])) {
                            continue;
                        }
                        $commentaire = htmlspecialchars(trim($_POST['commentaire'][$id]), ENT_QUOTES, 'UTF-8');
                        // Vérification de la case cochée pour 'validation'
                        $validation = isset($_POST['validation'][$id]) && $_POST['validation'][$id] == $id ? 1 : 0;
                        $validation = (int)$validation;

                        // Préparation de la requête
                        $stmt = $bdd->prepare(
                            "   UPDATE livre_or_commentaires
                                SET commentaire = :commentaire,
                                    validation = :validation
                                WHERE id = :id
                            "
                        );

                        // Exécution de la requête préparée
                        $stmt->execute(
                            array(
                                ':id' => $id,
                                ':commentaire' => $commentaire,
                                ':validation' => $validation
                            )
                        );

                        // Vérification de la mise à jour
                        if ($stmt->rowCount() > 0) {
                            $nb_commentaires_valides++;
                        }
                    }

                    // Redirection vers la page d'accueil avec un message de succès
                    header("Location: ../../public/index.php?page=livre-d-or&msg=succes&token=".$_GET["token"]);
                    exit;
                }else{
                    header('Location: ./index.php?page=403&token='.$_GET["token"]);
                    exit;
                }
            }
            case 'new-biere': {    // Si le formulaire a été soumis
                echo "debug depart";
                    if (
                        isset($_POST['nom_biere']) && isset($_POST['degres_d_alcool'])
                        && isset($_POST['quantite']) && isset($_POST['description'])
                        && isset($_POST['id_type_de_biere']) && isset($_POST['id_origine'])
                        && isset($_FILES['photo']) && isset($_POST['stock']) && isset($_POST['prix'])
                    ) {
                        echo "debug condition 1 ok";
                        // Récupération des données du formulaire
                        $nom_biere = htmlspecialchars(trim($_POST['nom_biere']));
                        $degres_d_alcool = htmlspecialchars($_POST['degres_d_alcool']);
                        $quantite = htmlspecialchars($_POST['quantite']);
                        $description = htmlspecialchars(trim($_POST['description']));
                        $stock = htmlspecialchars($_POST['stock']);
                        $id_type_de_biere = htmlspecialchars($_POST['id_type_de_biere']);
                        $id_origine = htmlspecialchars($_POST['id_origine']);
                        $prix = htmlspecialchars($_POST['prix']);


                        // Gestion de l'upload de l'image
                        //upload du fichier s'il y en a un 
                        if (isset($_FILES['photo']) && !empty($_FILES["photo"]["name"])) {
                            // Dossier dans lequel va être déposé le fichier
                            $dossier = '../../public/images/produits/';
                            // On fixe la taille max acceptée
                            $taille_max = 1000000;
                            // On fixe la liste des extensions acceptées
                            $extensions = array('.png', '.jpg', '.jpeg', '.gif', '.webp');
                            // Liste des types MIME autorisés
                            $allowed_mime_types = array('image/png', 'image/jpeg', 'image/gif', 'image/webp');

                            // Récupération du nom du fichier
                            $photo = basename($_FILES['photo']['name']);

                            // Récupération de la taille du fichier
                            $taille = filesize($_FILES['photo']['tmp_name']);

                            // Récupération de l'extension du fichier
                            $extension = strtolower(strrchr($_FILES['photo']['name'], '.'));

                            // Récupération du type MIME du fichier
                            $finfo = finfo_open(FILEINFO_MIME_TYPE);
                            $mime_type = finfo_file($finfo, $_FILES['photo']['tmp_name']);
                            finfo_close($finfo);

                            // Vérification si extension acceptée
                            if (!in_array($extension, $extensions)) {
                                header("location:../index.php?page=form_ajout_biere&retour=ext");
                                exit;
                            }

                            // Vérification si le type MIME est autorisé
                            if (!in_array($mime_type, $allowed_mime_types)) {
                                header("location:../index.php?page=form_ajout_biere&retour=mime");
                                exit;
                            }

                            // Vérification taille du fichier < max
                            if ($taille > $taille_max) {
                                header("location:../index.php?page=form_ajout_biere&retour=taille");
                                exit;
                            }

                            // Renommez le fichier téléchargé en utilisant un nom aléatoire unique
                            $beer_name = substr($nom_biere, 0, 100 - 14); // On réserve 13 caractères pour l'uniqid() et 1 pour l'extension
                            $beer_name_clean = preg_replace('/[^A-Za-z0-9\-]/', '', $beer_name); // On retire les caractères spéciaux
                            $new_filename = $beer_name_clean . '-' . uniqid() . $extension;
                            $destination = $dossier . $new_filename;

                            // Vérification qu'aucun caractère étrange n'est dans le fichier
                            if (!isset($erreur)) {
                                // Upload du fichier
                                move_uploaded_file($_FILES['photo']['tmp_name'], $destination);
                                $photo = $new_filename;
                            } else {
                                // Pas de nouveau fichier, on récupère l'ancien
                                $photo = "defaut.png";
                            }

                            // Requête préparée po ur insérer la bière dans la base de données
                            $stmt = $bdd->prepare(
                                "   INSERT INTO produits (nom, degres, stock, description, id_categories, id_origines, contenance, img, prix) 
                                                    VALUES  (
                                                                ?, 
                                                                ?, 
                                                                ?, 
                                                                ?, 
                                                                ?, 
                                                                ?, 
                                                                ?, 
                                                                ?, 
                                                                ?
                                                            )
                                                "
                            );

                            // Exécution de la requête avec les données du formulaire
                            $stmt->execute(
                                array(
                                    $nom_biere,
                                    $degres_d_alcool,
                                    $quantite,
                                    $description,
                                    $id_type_de_biere,
                                    $id_origine,
                                    $stock,
                                    $photo,
                                    $prix
                                )
                            );

                            // Redirection vers une autre page ou affichage d'un message de succès
                            header('Location: ../../public/index.php?page=produits&msg=ajout_success');
                            exit;
                        }
                    }else{
                        header("Location: ../../public/index.php?page=form_ajout_biere&retour=erreur_Saisie");
                        exit;
                    }
                }

            case 'update-biere': {    // Vérifier si tous les champs sont remplis

                    if (isset($_POST['id_biere']) && isset($_POST['nom_biere']) && isset($_POST['degres_d_alcool']) && isset($_POST['quantite']) && isset($_POST['stock']) && isset($_POST['description']) && isset($_POST['id_type_de_biere']) && isset($_POST['id_origine']) && isset($_FILES['photo'])) {
                        // Récupérer les données du formulaire
                        $id_biere = htmlspecialchars($_POST['id_biere']);
                        $nom_biere = htmlspecialchars(trim($_POST['nom_biere']));
                        $degres_d_alcool = htmlspecialchars($_POST['degres_d_alcool']);
                        $quantite = htmlspecialchars($_POST['quantite']);
                        $stock = htmlspecialchars($_POST['stock']);
                        $description = htmlspecialchars($_POST['description']);
                        $id_type_de_biere = htmlspecialchars($_POST['id_type_de_biere']);
                        $id_origine = htmlspecialchars($_POST['id_origine']);
                        $prix = htmlspecialchars($_POST['prix']);

                        // Gestion de l'image
                        $image = $_FILES['photo'];
                        $image_name = null;

                        // Vérifier si une image a été téléchargée
                        if ($image['size'] > 0) {
                            // Autoriser uniquement certaines extensions d'image
                            $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
                            $image_extension = pathinfo($image['name'], PATHINFO_EXTENSION);

                            // Télécharger la nouvelle image et définir le nom de l'image
                            if (in_array($image_extension, $allowed_extensions)) {
                                $beer_name = substr($nom_biere, 0, 100 - 14); // On réserve 13 caractères pour l'uniqid() et 1 pour l'extension
                                $beer_name_clean = preg_replace('/[^A-Za-z0-9\-]/', '', $beer_name); // On retire les caractères spéciaux
                                $image_name = $beer_name_clean . '-' . uniqid() . '.' . $image_extension;
                                $upload_path = '../../public/images/produits/' . $image_name;
                                move_uploaded_file($image['tmp_name'], $upload_path);

                                // Supprimer l'ancienne image si elle existe
                                $select_query = "SELECT `img` FROM `produits` WHERE `id` = :id_biere";
                                $stmt = $bdd->prepare($select_query);
                                $stmt->execute([':id_biere' => $id_biere]);
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                $old_image_name = $result['img'];
                                if ($old_image_name !== null) {
                                    $old_image_path = '../../public/images/produits/' . $old_image_name;
                                    if (file_exists($old_image_path)) {
                                        unlink($old_image_path);
                                    }
                                }
                            } else {
                                // Gérer l'erreur d'extension non autorisée
                                $_SESSION['error_message'] = "Extension de fichier non autorisée. Les extensions autorisées sont : " . implode(', ', $allowed_extensions);
                                header('Location: ../../public/index.php?page=produits&msg=err_format');
                                exit;
                            }
                        }
                        echo "debug 1";
                        // Préparer et exécuter la requête de mise à jour
                        $update_query = "   UPDATE  `produits` 
                                            SET     `nom` = :nom_biere,
                                                    `degres` = :degres_d_alcool, 
                                                    `stock` = :stock, 
                                                    `description` = :description, 
                                                    `id_categories` = :id_type_de_biere,
                                                    `id_origines` = :id_origine, 
                                                    `contenance` = :quantite, 
                                                    `prix` = :prix" . ($image_name !== null ? ", `img` = :image_name" : "") . "
                                                WHERE   `id` = :id_biere
                                ";

                        $stmt = $bdd->prepare($update_query);

                        // Définir les paramètres de la requête
                        $params =   [
                            ':id_biere' => $id_biere,
                            ':nom_biere' => $nom_biere,
                            ':degres_d_alcool' => $degres_d_alcool,
                            ':quantite' => $quantite,
                            ':stock' => $stock,
                            ':description' => $description,
                            ':id_type_de_biere' => $id_type_de_biere,
                            ':id_origine' => $id_origine,
                            ':prix' => $prix,
                        ];

                        // Si une nouvelle image a été téléchargée, ajouter le nom de l'image aux paramètres
                        if ($image_name !== null) {
                            $params[':image_name'] = $image_name;
                        }

                        // Exécuter la requête avec les paramètres
                        if ($stmt->execute($params)){
                            echo 'requete insert ok';
                        }else{
                            echo 'requete insert ko';
                        }
                        
                        // Rediriger vers la page de gestion des produits ou la page d'accueil
                        header('Location: ../../public/index.php?page=produits&msg=success');
                    }
                    break;
                }

            case 'categories': {
                    $new_category = ucfirst(mb_strtolower(htmlspecialchars($_POST['new_category']), 'UTF-8'));
                    $stmt = $bdd->prepare("INSERT INTO categories (nom) VALUES (:nom)");
                    $stmt->bindParam(':nom', $new_category);
                    $stmt->execute();
                    header('Location: ../../public/index.php?page=form_modif&action=type_Biere');
                    exit;
                }
            case 'origines': {
                    $new_origin = ucfirst(mb_strtolower(htmlspecialchars($_POST['new_origin']), 'UTF-8'));
                    $stmt = $bdd->prepare("INSERT INTO origines (nom) VALUES (:nom)");
                    $stmt->bindParam(':nom', $new_origin);
                    $stmt->execute();
                    header('Location: ../../public/index.php?page=form_modif&action=origines');
                    exit;
                }

            default: {
                    // Rediriger vers la page 404 si l'action n'est pas reconnue
                    header("Location:../../public/index.php?page=404");
                    exit;
                }
        }
    } else {
        // Rediriger vers la page 404 si l'action n'est pas définie
        header("Location: ../../public/index.php?page=404");
        exit;
    }
} else {
    header('Location: ../../public/index.php?page=403');
    exit;
}
