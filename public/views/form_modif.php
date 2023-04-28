<?php
$test = require_once('..\models\function_Accueil_Json.php');
?>
<?php
// Je vérifie que l'utilisateur est bien administrateur pour effectuer des modifications
if (!isset($_SESSION['type_utilisateur']) && $_SESSION['type_utilisateur'] != 1) { // Si l'utilisateur n'est pas connecté en tant qu'administrateur
    echo 'prout';
    header('Location: ../index.php?page=403'); // Rediriger vers une page d'erreur 404
    exit; // Arrêter l'exécution du script
} else {


    // Je vérifie si l'action est définie dans l'URL et n'est pas vide
    if (isset($_GET["action"]) && !empty($_GET["action"])) {   // Si une action est spécifiée dans l'URL
        switch ($_GET["action"]) {
            case 'accueil':
                // Préparez la requête préparée pour récupérer les informations de plusieurs tables
                // Charger les données du fichier JSON
                $data = read_json_file(__DIR__ . '/../../data/accueil.json');

                // Récupérer les informations de la page d'accueil
                $accueil_data = $data['accueil'];
                $msg_accueil = $accueil_data['msg_accueil'];
                $paragraphe_un = $accueil_data['paragraphe_un'];
                $paragraphe_deux = $accueil_data['paragraphe_deux'];
                $paragraphe_trois = $accueil_data['paragraphe_trois'];
                $paragraphe_quatre = $accueil_data['paragraphe_quatre'];

                // Récupérer les horaires d'ouverture
                $horaires_data = $data['horaires'];
?>
                <!-- Afficher un formulaire pour modifier le message d'accueil -->
                <form action="../models/script_php/ajout.php?action=msg-acc" method="post" class="row justify-content-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <div class="form-group">
                            <!-- Ajouter un champ masqué pour stocker l'identifiant -->
                            <input type="hidden" name="id_msg" id="id_msg" value="1">
                        </div>
                    </div>
                    <!--    Message d'information    -->
                    <section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 text-center cadre_bois bg-light">
                        <article class="mx-2" style="width: 90%; height: 9.375rem">
                            <label for="msg_accueil" class="text-dark fw-bold text-decoration-underline pt-3">
                                Entrez votre message d'accueil:
                            </label>
                            <textarea class="form-control mx-auto pb-5" id="msg_accueil" name="msg_accueil" style="width: 90%; height: 75px"><?= $msg_accueil ?></textarea>
                        </article>
                    </section>
                    <section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 cadre_noir bg-light">
                        <article class="row justify-content-evenly">
                            <!--    A propos de nous    -->
                            <section class="bg-biere border border-3 border-dark my-3 mx-1
                        col-xs-11 col-sm-11 col-md-11 col-lg-5 col-xl-5 col-xxl-5">
                                <div class="row">
                                    <h3 class="col-12 txt-Center">A propos de nous</h3>
                                </div>
                                <hr>
                                <div class="form-floating mt-5 mx-2 border border-dark border-5 row">
                                    <!-- Ajouter un champ de texte pour afficher le message d'accueil -->
                                    <textarea class="form-control" id="para_accueil_un" name="para_accueil_un" style="height: 10rem"><?= $paragraphe_un ?></textarea>
                                    <label for="para_accueil_un" class="text-dark fw-bold text-decoration-underline">Entrez votre premier paragraphe:</label>
                                </div>
                                <div class="form-floating my-2 mx-2 border border-dark border-5 row">
                                    <!-- Ajouter un champ de texte pour afficher le message d'accueil -->
                                    <textarea class="form-control" id="para_accueil_deux" name="para_accueil_deux" style="height: 10rem"><?= $paragraphe_deux ?></textarea>
                                    <label for="para_accueil_deux" class="text-dark fw-bold text-decoration-underline">Entrez votre deuxième paragraphe:</label>
                                </div>
                                <div class="form-floating my-2 mx-2 border border-dark border-5 row">
                                    <!-- Ajouter un champ de texte pour afficher le message d'accueil -->
                                    <textarea class="form-control" id="para_accueil_trois" name="para_accueil_trois" style="height: 10rem"><?= $paragraphe_trois ?></textarea>
                                    <label for="para_accueil_trois" class="text-dark fw-bold text-decoration-underline">Entrez votre troisième paragraphe:</label>
                                </div>
                                <div class="form-floating my-2 mx-2 border border-dark border-5 row">
                                    <!-- Ajouter un champ de texte pour afficher le message d'accueil -->
                                    <textarea class="form-control" id="para_accueil_quatre" name="para_accueil_quatre" style="height: 10rem"><?= $paragraphe_quatre ?></textarea>
                                    <label for="para_accueil_quatre" class="text-dark fw-bold text-decoration-underline">Entrez votre quatrième paragraphe:</label>
                                </div>
                            </section>
                            <!--    Horaires D'ouverture    -->
                            <section id="horaire" class="bg-biere border border-3 border-dark my-3 mx-1
                        col-xs-11 col-sm-11 col-md-11 col-lg-5 col-xl-5 col-xxl-5">
                                <!--    Titre de la section horaire    -->
                                <div class="row">
                                    <h3 class="col-12 txt-Center">Horaires d'ouverture</h3>
                                    <p class="text-center fw-bold">du 01 Mars au 31 Septembre</p>
                                </div>

                                <!--    Tableau des horaires    -->
                                <div class="row table-responsive m-2">
                                    <table class="table table-striped table-bordered">
                                        <!--    en-tête du tableau    -->
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="txt-Start">Jours</th>
                                                <th class="txt-Start">Matin</th>
                                                <th class="txt-Start">Aprés-midi</th>
                                            </tr>
                                        </thead>
                                        <!--    corps du tableau    -->
                                        <tbody class="table-secondary">
                                            <?php


                                            // Afficher les résultats dans le tableau
                                            foreach ($horaires_data as $key => $resultat) {
                                            ?>
                                                <tr>
                                                    <td class='txt-Start'>
                                                        <?= $resultat['jour']   ?>
                                                    </td>
                                                    <td class='txt-End'>
                                                        <input type="text" class="form-control" id="horaire_matin_<?= $resultat['id_horaire_ouverture'] ?>" name="horaire_matin_<?= $key ?>" value="<?= $resultat['horaire_matin'] ?>">
                                                    </td>
                                                    <td class='txt-End'>
                                                        <input type="text" class="form-control" id="horaire_apres_midi_<?= $resultat['id_horaire_ouverture'] ?>" name="horaire_apres_midi_<?= $key ?>" value="<?= $resultat['horaire_apres_midi'] ?>">
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </article>
                    </section>
                    <button type="submit" class="btn btn-primary my-2 col-2">changer</button>
                </form>
            <?php
                break;

            case 'produit':
                // Récupérez l'ID de la bière depuis l'URL
                $id_biere = $_GET['id'];
                // récupérer les informations de la bière de la base de données
                $stmt = $bdd->prepare("SELECT * FROM produits WHERE id = :id_biere");
                $stmt->execute([':id_biere' => $id_biere]);
                $biere = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
                <div class="row my-2 justify-content-center">
                    <h2 class="col-10 cadre_bois bg-light text-center py-4">Modification de la bière <?= $biere["nom"] ?></h2>
                </div>
                <div class="row justify-content-center mb-2">
                    <form action="../models/script_php/ajout.php?action=update-biere" method="post" enctype="multipart/form-data" class="col-10 cadre_noir bg-biere">
                        <!-- Ajouter un champ caché pour stocker le jeton CSRF -->
                        <!-- <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"> -->
                        <div class="row mt-5">
                            <!-- <label for="id_biere">ID Bière:</label> -->
                            <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="nom de la bière" aria-label="nom de la bière" aria-describedby="nom de la bière" value="<?= htmlspecialchars($biere['id']) ?>" required hidden>
                            <div class="col-4">
                                <!-- Nom Bière: -->
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-echoppe fw-bold">Nom Bière:</span>
                                    <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="nom de la bière" aria-label="nom de la bière" aria-describedby="nom de la bière" value="<?= htmlspecialchars($biere['nom']) ?>" required>
                                </div>
                            </div>
                            <!-- Degrés d'alcool: -->
                            <div class="col-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-echoppe fw-bold">Degrés d'alcool:</span>
                                    <input type="number" name="degres_d_alcool" id="degres_d_alcool" class="form-control" step="0.1" value="<?= htmlspecialchars($biere['degres']) ?>" required>
                                </div>
                            </div>
                            <!-- Contenance (en cl): -->
                            <div class='col-3'>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-echoppe fw-bold">Contenance (en cl):</span>
                                    <input type="number" name="quantite" id="quantite" class="form-control" step="0.5" value="<?= htmlspecialchars($biere['contenance']) ?>" required>
                                </div>
                            </div>
                            <!-- Stock: -->
                            <div class="col-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-echoppe fw-bold">Stock:</span>
                                    <input type="number" name="stock" id="stock" class="form-control" step="1" value="<?= htmlspecialchars($biere['stock']) ?>" required>
                                </div>
                            </div>
                            <!-- Description: -->
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-echoppe fw-bold">Description:</span>
                                    <textarea name="description" id="description" class="form-control" aria-label="Description" required><?= htmlspecialchars($biere['description']) ?></textarea>
                                </div>
                            </div>
                            <!-- Type de bière: -->
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <label for="id_type_de_biere" class="input-group-text bg-echoppe fw-bold">Type de bière:</label>
                                    <select name="id_type_de_biere" id="id_type_de_biere" class="form-select" required>
                                        <?php
                                        $stmt = $bdd->prepare("SELECT id, nom FROM categories");
                                        $stmt->execute();
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $selected = ($row['id'] == $biere['id_categories']) ? "selected" : "";
                                            echo "<option value='{$row['id']}' {$selected}>{$row['nom']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Origine: -->
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <label for="id_origine" class="input-group-text bg-echoppe fw-bold">Origine:</label>
                                    <select name="id_origine" id="id_origine" class="form-select" required>
                                        <?php
                                        $stmt = $bdd->prepare("SELECT id, nom FROM origines");
                                        $stmt->execute();
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $selected = ($row['id'] == $biere['id_origines']) ? "selected" : "";
                                            echo "<option value='{$row['id']}' {$selected}>{$row['nom']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Image -->
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-echoppe fw-bold">Photo actuelle:</span>
                                    <img src="./images/produits/<?= htmlspecialchars($biere['img']) ?>" alt="<?= htmlspecialchars($biere['nom']) ?>" class="img-thumbnail">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-echoppe fw-bold">Nouvelle photo:</span>
                                    <input type="file" name="photo" id="photo" class="form-control" placeholder="photo de la bière" aria-label="photo de la bière" aria-describedby="photo de la bière">
                                </div>
                            </div>
                        </div>
                        <div class="row my-5 justify-content-center">
                            <input type="submit" class="col-2 btn btn-success" value="Ajouter">
                        </div>
                    </form>
                </div>
<?php
                break;
        }
    } else {
        // Rediriger vers la page 404 si l'utilisateur n'a pas les autorisations nécessaires
        header('Location:../index.php?page=404');
        exit;
    }
}
?>