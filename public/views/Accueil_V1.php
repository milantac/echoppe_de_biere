<section class="row mx-auto justify-content-evenly">
    <!--    CARROUSEL    -->
    <article id="carouselAcceuil" class="
                        row carousel slide carrousel-accueil py-3 mb-2 mx-auto
                        col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12
                    " data-bs-ride="carousel" title="carroussel de presentation">
        <!-- Bouton précédent du carrousel -->
        <button class="carousel-control-prev col-1" type="button" data-bs-target="#carouselAcceuil" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>p
        <!-- Affichage du carrousel -->
        <div class="carousel-inner col-8 mx-auto">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="./images/carrousel_accueil/carrousel-devanture.jpg" class="d-block w-100" alt="devanture">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="./images/carrousel_accueil/carrousel-shop" class="d-block w-100" alt="shop">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="./images/carrousel_accueil/carrousel-biere" class="d-block w-100" alt="biere">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="./images/carrousel_accueil/carrousel-bar" class="d-block w-100" alt="bar">
            </div>
        </div>
        <!-- Bouton suivant du carrousel -->
        <button class="carousel-control-next col-1" type="button" data-bs-target="#carouselAcceuil" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </article>
<?php
    if(isset($_SESSION['type_utilisateur']) && $_SESSION['type_utilisateur']==1){
?>
        <div class="col-3">
            <a href='index.php?page=form_modif&action=accueil' class="btn btn-info btn-block fw-bold">
                Modifié la page d'accueil
            </a>
        </div>
<?php
    }
?>
<?php
    // Préparez la requête préparée pour récupérer les informations de plusieurs tables
    $sql = "SELECT *
            FROM accueil
            JOIN a_propos_de_nous ON accueil.id_msg_accueil = a_propos_de_nous.id_msg_accueil
            WHERE accueil.id_accueil = 1";

    // Préparez la déclaration
    $stmt = $bdd->prepare($sql);

    // Exécutez la déclaration
    $stmt->execute();

    // Récupérez le résultat
    $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

    // Parcourez et stockez les résultats
    if ($resultat) {
        $msg_accueil = $resultat["msg_accueil"];
        $paragraphe_un = $resultat["paragraphe_un"];
        $paragraphe_deux = $resultat["paragraphe_deux"];
        $paragraphe_trois = $resultat["paragraphe_trois"];
        $paragraphe_quatre = $resultat["paragraphe_quatre"];
    } else {
        echo "0 résultats";
    }
    ?>
    <h2 class="text-center bg-light mx-auto col-12 fw-bold h4 my-4 py-3 cadre_bois"><?= $resultat["msg_accueil"]; ?></h2>
    <!--    A Propos De Nous    -->
    <article id="aProposDeNous" class=" row mx-auto justify-content-center my-2 p-3
                        col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-6 col-xxl-6
                        txt-Noir bg-biere cadre_noir 
                ">
        <div class="row justify-content-center mx-auto">
            <span class="   col-xs-0 col-sm-0 col-md-2 col-lg-2 col-xl-3 col-xxl-3
                            d-none d-lg-block my-auto mx-auto
                        ">
            </span>
            <h2 class=" h2 text-center my-auto mx-auto
                    col-xs-10 col-sm-10 col-md-6 col-lg-6 col-xl-5 col-xxl-5
                    ">
                A propos de nous
            </h2>
            <span class="   col-xs-0 col-sm-0 col-md-2 col-lg-2 col-xl-3 col-xxl-3
                    d-none d-lg-block my-auto mx-auto
                ">
            </span>
        </div>
        <article id="txt-AproposDeNous" class="bg-light lh-2 mb-3 col-xs-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 col-xxl-11" style="--bs-bg-opacity: .25;">
            <p class="text-xs-center text-sm-center text-md-start text-lg-start text-xl-start text-xxl-start fw-bold">
                <?= $paragraphe_un ?>
            </p>
            <p class="text-xs-center text-sm-center text-md-start text-lg-start text-xl-start text-xxl-start fw-bold">
                <?= $paragraphe_deux ?>
            </p>
            <p class="text-xs-center text-sm-center text-md-start text-lg-start text-xl-start text-xxl-start fw-bold">
                <?= $paragraphe_trois ?>
            </p>
            <p class="text-xs-center text-sm-center text-md-start text-lg-start text-xl-start text-xxl-start fw-bold">
                <?= $paragraphe_quatre ?>
            </p>
        </article>
    </article>
    <!--    Informations    -->
    <article id="informationsAccueil" class="   row mx-auto my-2 p-3 justify-content-center
                    col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-6 col-xxl-6
                    txt-Noir bg-biere cadre_noir 
                ">
        <div class="row justify-content-center mx-auto mb-3">
            <span class="   col-xs-0 col-sm-0 col-md-2 col-lg-2 col-xl-3 col-xxl-3
                            d-none d-lg-block my-auto mx-auto
                        ">
            </span>
            <h2 class=" h2 text-center my-auto mx-auto
                    col-xs-10 col-sm-10 col-md-6 col-lg-6 col-xl-5 col-xxl-5
                    ">
                Informations
            </h2>
            <span class="   col-xs-0 col-sm-0 col-md-2 col-lg-2 col-xl-3 col-xxl-3
                    d-none d-lg-block my-auto mx-auto
                ">
            </span>
        </div>
        <!--    Horaires D'ouverture    -->
        <section id="horaire" class="   bg-light border border-3 border-dark my-3
                        col-xs-10 col-sm-10 col-md-10 col-lg-8 col-xl-8 col-xxl-8
                    ">
            <!--    Titre de la section horaire    -->
            <div class="row">
                <h3 class="col-12 txt-Center">Horaires d'ouverture</h3>
                <p class="text-center fw-bold">du 01 Mars au 31 Septembre</p>
            </div>
            <!--    Tableau des horaires    -->
            <div class="row table-responsive">
                <table class="table table-striped col-12">
                    <!--    en-tête du tableau    -->
                    <thead class="table-dark">
                        <tr>
                            <th class="txt-Start">Jours</th>
                            <th class="txt-End">Matin</th>
                            <th class="txt-End">Aprés-midi</th>
                        </tr>
                    </thead>
                    <!--    corp^s du tableau    -->
                    <tbody class="table-secondary">
                        <?php
                        // Préparer la requête SQL avec des paramètres
                        $sql = "SELECT id_horaire_ouverture, jour, horaire_matin, horaire_apres_midi FROM horaire_ouverture";
                        $stmt = $bdd->prepare($sql);

                        // Exécuter la requête préparée
                        $stmt->execute();

                        // Récupérer les résultats sous forme d'un tableau associatif
                        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Afficher les résultats dans le tableau
                        foreach ($resultats as $resultat) {
                        ?>
                            <tr>
                                <td class='txt-Start'>
                                    <?= $resultat['jour']   ?>
                                </td>
                                <td class='txt-End'>
                                    <?= $resultat['horaire_matin'] ?>
                                </td>
                                <td class='txt-End'>
                                    <?= $resultat['horaire_apres_midi']    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <!--    Nous Trouver    -->
        <section id="Localisation" class="   bg-light border border-3 border-dark mt-3
                        col-xs-10 col-sm-10 col-md-10 col-lg-8 col-xl-8 col-xxl-8
                    ">
            <!--    Titre de la section Localisation    -->
            <div class="row">
                <h3 class="col-12 txt-Center">Nous trouver </h3>
                <hr>
                <!-- Adresse de l'entreprise -->
                <p class="txt-Center bg-light" style="--bs-bg-opacity: .25;">
                    44 RUE DE FRANCHEPRE,
                    54240 JOEUF (France)
                </p>
            </div>
            <!-- Carte Google Maps de l'emplacement de l'entreprise -->
            <div class="row mx-auto ratio ratio-16x9 mb-2" id="carteAccueil">
                <!-- iframe pour afficher la carte Google Maps -->
                <iframe class="col-12 border border-dark border-2" id="google-map" title="Carte Google Maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2605.550439296281!2d6.015349615853676!3d49.2280523825605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479529c0136e18a7%3A0xaeaf7e356b80fa40!2s44%20Rue%20de%20Franchepr%C3%A9%2C%2054240%20J%C5%93uf!5e0!3m2!1sfr!2sfr!4v1679491472181!5m2!1sfr!2sfr" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </section>
    </article>
</section>