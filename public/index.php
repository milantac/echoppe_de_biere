<?php
session_start(); // lancement de la session
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <!--    ***************************             meta            *************************** -->
    <!--    *                                charset (en HTML 5)                              * 
            *       UTF-8 en occident, mais on peut trouver le jeu ISO-8859-1                 *
            *       (défini par défaut, pas d'accent) ou ISO-8859-15                          *
            ***********************************************************************************-->
    <meta charset="UTF-8">
    <!--    ***************************          http-equiv         *************************** -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- compatible IE7 -->
    <!--    ***************************             name            *************************** -->
    <!--    ***************************           language          *************************** -->
    <meta name="language" content="fr-FR">
    <!--    ***************************           viewport          *************************** -->
    <!--    *       width=device-width : définit la largeur de la page pour qu'elle           *
                *               corresponde à la largeur de l'écran du périphérique               * 
                *               (qui varie en fonction du périphérique).                          *
                *                                                                                 *
                *       initial-scale=1.0 : définit le niveau de zoom initial lorsque la page     *
                *       est chargée pour la première fois par le navigateur.                      *
                *********************************************************************************** -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ***************************        Publisher (Auteur)      *************************** -->
    <meta name="Publisher" content="Guillaume MILANTONI">
    <!-- ***************************             Copyright          ***************************-->
    <meta name="copyright" content="@DevWebCCI.fr 2022.">
    <!--    ***************************          description           *************************** -->
    <!--    *     doit contenir une ou plusieurs phrases suffisamment explicites et structurées  *
                *     pour décrire la page du site afin d'augmenter votre CTR                        *
                *     (Click Through Rate ou taux de click)                                          *   
                ************************************************************************************** -->
    <meta name="description" content="Découvrez notre échoppe de bière située à Joeuf ! Nous proposons une large sélection de bières artisanales et de qualité, ainsi que des conseils avisés pour vous aider à choisir la bière parfaite pour vos soirées et événements. Visitez notre échoppe et laissez-vous séduire par notre passion pour la bière.">
    <!--    ***************************                link            *************************** -->
    <!--    ***************************           Bootstrap: (CSS)     *************************** -->
    <!--    *                                        via CDN                                     *
                ************************************************************************************** -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!--    *                                      via Dossier                                    * -->
    <!-- <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css"> -->
    <!--    ***************************           Bootstrap:  (JS)      *************************** -->
    <!--    *                                        via CDN                                      * -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <!--    *                                      via Dossier                                    *  -->
    <!-- <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script> -->
    <!--    ***************************           Bootstrap: (icon)     *************************** -->
    <!--    *                                        via CDN                                      * -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!--    ***************************        Mes CSS Perso            *************************** -->
    <!--    *                                    style.css                                        * -->
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/txt_style.css">
    <link rel="stylesheet" href="../public/css/bg_style.css">
    <link rel="stylesheet" href="../public/css/box_style.css">
    <link rel="stylesheet" href="../public/css/animation_style.css">
    <link rel="stylesheet" href="../public/css/livre-d-or.css">
    <!-- <link rel="stylesheet" href="../public/css/new-page.css"> -->

    <!-- ***************************        link FontAwesome        *************************** -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ***************************            TITRE DU SITE       *************************** -->
    <title>Échoppe de Bière (Joeuf)</title>
    <!-- ***************************            LOGO Onglet         *************************** 
             ************************************************************************************** 
             ****                                    taille:                                   **** 
             ****               (16x16, 32x32, 48x48, 64x64 ou 128x128 pixels)                 **** 
             ************************************************************************************** -->
    <link rel="shortcut icon" href="../public/images/logo/logo_échoppe_de_bière.svg" type="image/svg">

</head>

<body>
    <?php
    // inclure le fichier de connexion à la base de données
    include('../models/script_php/connexion-BDD.php');
    ?>
    <?php include("../includes/header.php"); ?>

    <main class="container-fluid">
        <div class="row justify-content-center">
            <?php
            // Tableau contenant les pages autorisées
            $pages_autorise = array(
                'accueil',
                '404',
                '403',
                'form_connexion',
                'form_inscription',
                'form_modif',
                'contactez-nous',
                'livre-d-or',
                'livre-d-or-V2',
                'produits'
            );
            // Tableau contenant les pages autorisées seulement par l'admin
            $pages_autorise_admin = array('form_ajout_biere');

            // Fusion des deux tableaux
            $pages_autorisees_totales = array_merge($pages_autorise, $pages_autorise_admin);

            // Vérification si la page demandée est autorisée
            if (isset($_GET['page']) && in_array($_GET['page'], $pages_autorisees_totales)) {
                $page = $_GET['page'];

                // Vérification si la page est réservée aux administrateurs et si l'utilisateur est administrateur
                if (in_array($page, $pages_autorise_admin) && isset($_SESSION['type_utilisateur']) && ($_SESSION['type_utilisateur'] == 1)) {
                    // Affichage de la page demandée pour les administrateurs
                    include 'views/' . $page . '.php';
                } elseif (!in_array($page, $pages_autorise_admin)) {
                    // Affichage de la page demandée pour les autres utilisateurs
                    include 'views/' . $page . '.php';
                } else {
                    $page = '403';
                    // Page par défaut si l'utilisateur n'est pas autorisé à accéder à la page réservée aux administrateurs
                    include 'views/' . $page . '.php';
                }
            } else {
                $page = '404';
                // Page par défaut si la page demandée n'est pas trouvée
                include 'views/' . $page . '.php';
            }
            ?>
        </div>
    </main>

    <?php include("../includes/footer.php"); ?>


    <!-- <script src="../public/js/produit.js"></script> -->
    <script src="../public/js/livre-d-or.js"></script>
    <script src="../public/js/form_livre_d_or.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>