<?php
// Récupération des données depuis la table livre_d_or
$stmt = $bdd->prepare(
    "SELECT id_livre_d_or, nom, prenom, note_accueil_services, note_proprete, note_qualite_produit, commentaire
     FROM livre_d_or
     WHERE validation_livre_d_or = 1"
);
$stmt->execute();
$livre_d_or_recup = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calcul des moyennes des notes pour chaque catégorie
$total_accueil_services = 0;
$total_proprete = 0;
$total_qualite_produit = 0;
$nombre_commentaires_accueil_services = 0;
$nombre_commentaires_proprete = 0;
$nombre_commentaires_qualite_produit = 0;

foreach ($livre_d_or_recup as $commentaire) {
    $total_accueil_services += $commentaire['note_accueil_services'];
    $total_proprete += $commentaire['note_proprete'];
    $total_qualite_produit += $commentaire['note_qualite_produit'];
    $nombre_commentaires_accueil_services++;
    $nombre_commentaires_proprete++;
    $nombre_commentaires_qualite_produit++;
}

$moyenne_accueil_services = $total_accueil_services / $nombre_commentaires_accueil_services;
$moyenne_proprete = $total_proprete / $nombre_commentaires_proprete;
$moyenne_qualite_produit = $total_qualite_produit / $nombre_commentaires_qualite_produit;

// Stockage des moyennes des notes dans un tableau associatif
$moyennes_notes = array(
    "accueil_services" => $moyenne_accueil_services,
    "proprete" => $moyenne_proprete,
    "qualite_produit" => $moyenne_qualite_produit
);

// var_dump($livre_d_or_recup); /*  DEBUG  */
?>
<article class="container">
    <article class="row mx-3 justify-content-center">
        <script>
            const livre_d_or_recup = <?php echo json_encode($livre_d_or_recup); ?>;
        </script>
        <div class='book col-6'>
            <!-- Front -->
            <div class="hardcover_front">
                <div class="coverDesign dark">
                    <p>
                        <img src="../public/images/logo/Logo_Vectoriel.svg" alt="Logo Echoppe de bière" class="img-fluid mt-3" />
                    </p>
                    <h1>LIVRE D'OR</h1>
                    <p>ledb</p>
                </div>
            </div>

            <!-- Pages -->
            <div class='page' id="livre_d_or_pages">
                <!-- Les pages seront ajoutées dynamiquement ici -->
            </div>

            <!-- Back -->
            <div class='hardcover_back'>
                <div class="moyennes-notes">
                    <p>Moyennes des notes :</p>
                    <p>Moyenne de la note d'accueil et services : <?php echo $moyennes_notes['accueil_services']; ?></p>
                    <p>Moyenne de la note de propreté : <?php echo $moyennes_notes['proprete']; ?></p>
                    <p>Moyenne de la note de qualité du produit : <?php echo $moyennes_notes['qualite_produit']; ?></p>
                </div>
            </div>
            <div class='book_spine'></div>

            <!-- Buttons -->
            <div class="buttons">
                <button class="col-2 fw-bold btn btn-echoppe btn-block" id="prevButton">Précédant</button>
                <button class="col-2 fw-bold btn btn-echoppe btn-block" id="nextButton">Suivant</button>
            </div>
        </div>
    </article>
</article>