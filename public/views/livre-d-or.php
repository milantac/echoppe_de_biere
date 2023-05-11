<?php
// Récupération des données depuis la table livre_or_commentaires si elles ont été validées
$stmt = $bdd->prepare(
    "SELECT `id`, `nom`, `prenom`, `email`, `date`, `commentaire`, `validation`
     FROM `livre_or_commentaires`
     WHERE `validation` = 1 
     ORDER BY `date` DESC
    "
);
$stmt->execute();
$livre_d_or_recup = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($livre_d_or_recup); /*  DEBUG  */
?>
<?php
if (isset($_SESSION['type_utilisateur']) && $_SESSION['type_utilisateur'] == 1) {
    if (isset($_GET['token']) && isset($_SESSION['csrf_token']) && $_GET['token'] == $_SESSION['csrf_token']) {
?>
        <!--    FORMULAIRE ADMINISTRATEUR DE VALIDATION DES COMMENTIARES    -->
        <article class="container my-5 bg-light">
            <form action="../models/script_php/ajout.php?action=valid_com&token=<?= $_SESSION['csrf_token']; ?>" method="post" class="row p-3 m-3 justify-content-center cadre_noir">
                <div class="table-responsive col-12 mt-3 mb-2">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Commentaire</th>
                                <th>Validation</th>
                                <th hidden>Id</th>
                            </tr>
                        </thead>
                        <tbody class="bg-echoppe">
                            <?php
                            // Récupération des données depuis la table livre_d_or
                            $stmt_admin = $bdd->prepare(
                                "   SELECT `id`, `nom`, `prenom`, `email`, `date`, `commentaire`, `validation`
                                    FROM `livre_or_commentaires`
                                    ORDER BY `date` DESC
                                "
                            );
                            $stmt_admin->execute();
                            $livre_d_or_admin = $stmt_admin->fetchAll(PDO::FETCH_ASSOC);

                            // Affichage des résultats
                            foreach ($livre_d_or_admin as $resultat) {
                            ?>
                                <tr>

                                    <td><?php echo htmlspecialchars(trim($resultat['nom'])) ?></td>
                                    <td><?php echo htmlspecialchars(trim($resultat['prenom'])) ?></td>
                                    <td><?php echo htmlspecialchars(trim($resultat['email'])) ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($resultat['date'])) ?></td>
                                    <td class="form-floating">
                                        <textarea id="commentaire_<?php echo $resultat['id'] ?>" class="form-control" name="commentaire[<?php echo $resultat['id'] ?>]" placeholder="Laissez un commentaire ici" rows="10" cols="100"><?php echo htmlspecialchars(trim($resultat['commentaire'])) ?></textarea>
                                        <label for="commentaire_<?php echo $resultat['id'] ?>">Commentaire</label>
                                    </td>
                                    <td>
                                        <label class="switch" for="validation_<?php echo $resultat['id'] ?>">
                                            <input type="checkbox" id="validation_<?php echo $resultat['id'] ?>" name="validation[<?php echo $resultat['id'] ?>]" value="<?php echo $resultat['id'] ?>" <?php echo $resultat['validation'] == 1 ? 'checked' : '' ?> />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td hidden><input id="livre_d_or[<?php echo $resultat['id'] ?>][id]" name="livre_d_or[<?php echo $resultat['id'] ?>][id]" value="<?php echo $resultat['id'] ?>" hidden /></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary col-2 mb-4">Envoyer</button>
            </form>
        </article>
    <?php
    } else {
        header('Location: ./index.php?page=403');
        exit;
    }
} else {
    ?>
    <section class="container">
        <article class="row justify-content-center mx-3" id="entry_container">
            <script>
                const livre_d_or_recup = <?php echo json_encode($livre_d_or_recup); ?>;
            </script>

            <!-- Affichage de l'élément unique si le tableau ne contient qu'un seul élément -->
            <?php
            if (count($livre_d_or_recup) === 1) { ?>
                <ul class="col-8 align" id="livre-d-or">
                    <li>
                        <figure class='book' id="livre_d_or_pages">
                            <ul class='hardcover_front'>
                                <li>
                                    <div class="coverDesign dark">
                                        <img src="../public/images/logo/Logo_Vectoriel_Or.svg" alt="Logo Echoppe de bière" class="img-fluid mt-3" />
                                        <h1 class="fw-bold my-2">LIVRE D'OR</h1>
                                        <p>l'échoppe de bière</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="container mt-3">
                                        <div class="row my-2">
                                            <br>
                                        </div>
                                        <div class="row m-4">
                                            <br>
                                            <p class="txt-commentaire text-start fw-bold fs-2 my-2">
                                                <?php echo $livre_d_or_recup[0]['commentaire']; ?>
                                            </p>
                                        </div>
                                        <div class="row my-4 me-2">
                                            <p class="mt-4 text-end fs-4 me-5">Commentaire de:</p>
                                            <hr>
                                            <p class="mb-4 txt-commentaire text-end fw-bold fs-1 me-5">
                                                <?php echo $livre_d_or_recup[0]['nom'] . '  ' . $livre_d_or_recup[0]['prenom']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class='hardcover_back'>
                                <li></li>
                                <li></li>
                            </ul>
                            <ul class='book_spine'>
                                <li></li>
                                <li></li>
                            </ul>
                        </figure>
                    </li>
                </ul>
            <?php } else { ?>
                <!-- Affichage normal si le tableau contient plus d'un élément -->
                <ul class="col-8 align" id="livre-d-or">
                    <li>
                        <figure class='book' id="livre_d_or_pages">

                        </figure>
                    </li>
                </ul>
            <?php } ?>
        </article>

        <!-- Formulaire de livre d'or -->
        <article class="container my-2">
            <form action="../models/script_php/ajout.php?action=livre-d-or" method="post" class="row cadre_noir bg-biere p-3 m-3"> <!-- onsubmit="return validateForm()"  -->
                <fieldset class="pb-5">
                    <!-- Légende du formulaire -->
                    <div class="row mx-3 mt-2">
                        <span class="   
                        col-xs-0 col-sm-0 col-md-2 col-lg-2 col-xl-3 col-xxl-3 
                        d-none d-lg-block my-auto my-auto span-titre
                    ">
                        </span>
                        <legend class="
                        col-xs-12 col-sm-12 col-md- col-lg-6 col-xl-6 col-xxl-6
                        h1 text-center
                    ">
                            Livre d'or
                        </legend>
                        <span class="   
                        col-xs-0 col-sm-0 col-md-2 col-lg-2 col-xl-3 col-xxl-3 
                        d-none d-lg-block my-auto my-auto span-titre
                    ">
                        </span>
                    </div>
                    <!-- Zone d'affichage des messages d'erreur -->
                    <div class="row mx-3 mt-2">
                        <div class="col-12">
                            <span id="errorMessages" class="txt-Noir"></span>
                        </div>
                    </div>
                    <!-- Champs de saisie des informations personnelles -->
                    <div class="row m-3">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 my-2">
                            <label for="nom" class="form-label fw-bold">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 my-2">
                            <label for="prenom" class="form-label fw-bold">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 my-2">
                            <label for="email" class="form-label fw-bold">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail" required>
                        </div>
                    </div>
                    <!-- Zone de texte pour le commentaire -->
                    <div class="row mx-auto">
                        <div class="input-group my-2 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-12 col-xxl-12">
                            <span class="input-group-text fw-bold bg-echoppe border border-5 border-dark border-end-0">
                                Commentaire
                            </span>
                            <textarea class="form-control border border-5 border-dark border-start-0" id="commentaire" name="commentaire" rows="10" maxlength="300" required></textarea>
                        </div>
                    </div>
                    <!-- Bouton d'envoi -->
                    <div class="row mx-auto justify-content-center">
                        <button type="submit" class="btn btn-primary btn-block col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 my-2">Envoyer</button>
                    </div>
                </fieldset>
            </form>
        </article>
    </section>
    <?php
}