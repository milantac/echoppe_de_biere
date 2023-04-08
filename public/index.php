<?php
    // inclure le fichier de connexion à la base de données
    include('../models/script_php/connexion-BDD.php');
?>
<?php include("../includes/header.php"); ?>

<main class="container-fluid g-0">
    <div class="row justify-content-center">
    <?php
    // Tableau contenant les pages autorisées
    $pages_autorise = array('accueil', 
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
        if (in_array($page, $pages_autorise_admin) && isset($_SESSION['type_utilisateur']) && ($_SESSION['type_utilisateur']==1)) {
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