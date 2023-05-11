<?php
ob_start(); //permet de vider certain cache
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
    <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <!--    ***************************           Bootstrap:  (JS)      *************************** -->
    <!--    *                                        via CDN                                      * -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <!--    *                                      via Dossier                                    *  -->
    <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>
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
    // include('../models/utils.php');
    ?>
    <?php include("../includes/header.php"); ?>

    <?= var_dump($_SESSION); //DEBUG ?>

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

    <!-- Modal Informations Légales -->
    <div class="modal fade" id="legalModal" tabindex="-1" role="dialog" aria-labelledby="legalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <div class="row">
                        <h5 class="modal-title txt-echoppe col-10" id="legalModalLabel">Mentions Légales</h5>
                        <button class="btn btn-danger close txt-dark fw-bold col-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="txt-danger">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h2 class="col-12 text-center">Informations Légales</h2>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-echoppe fw-bold">Nom de l'établissement:</span>
                                <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="L'ECHOPPE DE BIERES" aria-label="L'ECHOPPE DE BIERES" aria-describedby="L'ECHOPPE DE BIERES" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-echoppe fw-bold">Forme juridique:</span>
                                <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="Société à responsabilité limitée" aria-label="Société à responsabilité limitée" aria-describedby="Société à responsabilité limitée" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-echoppe fw-bold">Prénom:</span>
                                <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="JONATHAN" aria-label="JONATHAN" aria-describedby="JONATHAN" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-echoppe fw-bold">Nom:</span>
                                <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="GATTELET" aria-label="GATTELET" aria-describedby="GATTELET" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-echoppe fw-bold">Adresse:</span>
                                <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="44 RUE DE FRANCHEPRE, 54240 JOEUF, FRANCE" aria-label="44 RUE DE FRANCHEPRE, 54240 JOEUF, FRANCE" aria-describedby="44 RUE DE FRANCHEPRE, 54240 JOEUF, FRANCE" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-echoppe fw-bold">N° tél:</span>
                                <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="+33608960565" aria-label="+33608960565" aria-describedby="+33608960565" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-echoppe fw-bold">Email:</span>
                                <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="ledb.joeuf@gmail.com" aria-label="ledb.joeuf@gmail.com" aria-describedby="ledb.joeuf@gmail.com" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-echoppe fw-bold">Inscription au registre</span>
                                <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="Registre des sociétés" aria-label="Registre des sociétés" aria-describedby="Registre des sociétés" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-echoppe fw-bold">Numéro d'enregistrement:</span>
                                <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="90828977000012" aria-label="90828977000012" aria-describedby="90828977000012" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-echoppe fw-bold">Numéro fiscal local:</span>
                                <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="FR30908289770" aria-label="FR30908289770" aria-describedby="FR30908289770" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-echoppe fw-bold">Capital Social:</span>
                                <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="4000" aria-label="4000" aria-describedby="4000" readonly>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <h2 class="col-12 text-center">Autres Informations</h2>
                        <div class="col-12">
                            <p>Nous promouvons la consommation responsable d'alcool. La vente d'alcool à des mineurs est <span class="fw-bold">interdite</span>.</p>
                            <p>Nous détenons une licence pour la vente d'alcool sous le numéro <span class="fw-bold">[insérez le numéro de licence ici]</span>.</p>
                            <p>
                                Pour plus d'informations sur notre utilisation des données personnelles et des cookies.
                                <br>
                                Veuillez consulter la <a href="politique-de-confidentialite.html">Protection de données</a>
                                <br>
                                et les <a href="politique-de-confidentialite.html">Paramètres des cookies</a>.
                            </p>
                            <p>En utilisant notre site Web, vous acceptez nos <a href="conditions-dutilisation.html">conditions d'utilisation</a>.</p>
                            <p>Tout le contenu de ce site Web est protégé par le droit d'auteur et ne peut être reproduit sans notre permission écrite.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-echoppe fw-bold" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Protection des Données -->
    <div class="modal fade" id="dataProtectionModal" tabindex="-1" role="dialog" aria-labelledby="dataProtectionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <div class="row">
                        <h5 class="modal-title txt-echoppe col-10" id="dataProtectionModalLabel">Protection des Données</h5>
                        <button class="btn btn-danger close txt-dark fw-bold col-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="txt-danger">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h2 class="col-12 text-center">Déclaration de protection des données</h2>
                        <h3 class="col-12 text-start">Informations générales</h3>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>
                                Ce site Web est opéré par Société à responsabilité limitée, 44 RUE DE FRANCHEPRE,54240 JOEUF,France, ledb.joeuf@gmail.com (ci-après « nous » ou « notre »). 
                            </p>
                            <p>
                                Pour toutes questions concernant la protection des données, veuillez nous contacter aux coordonnées ci-dessus.
                            </p>
                        </div>
                        <hr>
                        <h3 class="col-12 text-start">Traitement des données à caractère personnel et transfert à des tiers</h3>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>
                                Lors de l'utilisation de notre site, certaines données personnelles sont collectées automatiquement sur votre appareil (ordinateur, téléphone portable, tablette, etc.). 
                                <br>
                                L'adresse IP actuellement utilisée par votre appareil, la date, l'heure, le navigateur, le système d'exploitation de votre appareil et les pages récupérées sont collectés. 
                                <br>
                                Ceci dans le but de veiller à la sécurité des données, pour optimiser notre portée et améliorer notre site Web. 
                                <br>Le traitement de ces données personnelles est effectué en vertu de l'art. 6, paragr. 1, phrase 1, lettre f) du RGPD (Règlement général sur la protection des données). 
                                <br>
                                La protection de notre site Internet et l'optimisation de nos services représentent un intérêt légitime de notre part.
                            </p>
                            <p>
                                Si vous nous contactez (p. ex. par le biais d’une demande aux coordonnées que nous vous avons fournies), nous ne traiterons que les données personnelles que vous nous aurez fournies et qui sont nécessaires pour traiter votre demande et y répondre.
                            </p>
                            <p>
                                Afin de mener à bien les activités de traitement des données décrites dans la présente Déclaration de protection des données, p. ex. pour l'hébergement et l'entretien de notre site Web, nous faisons appel à des prestataires de service.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-echoppe fw-bold" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <?php include("../includes/footer.php"); ?>


    <!-- <script src="../public/js/produit.js"></script> -->
    <script src="../public/js/livre-d-or.js"></script>
    <script src="../public/js/form_livre_d_or.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>