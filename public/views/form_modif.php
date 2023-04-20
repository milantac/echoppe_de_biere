<?php
$test=require_once('..\models\function_Accueil_Json.php');
var_dump($test);
?>
<?php
// // Je vérifie que l'utilisateur est bien administrateur pour effectuer des modifications
// session_start(); // Démarre une nouvelle session ou reprend une session existante
// if (!isset($_SESSION["admin"])) { // Si l'utilisateur n'est pas connecté en tant qu'administrateur
//     header('Location: ../index.php?page=404'); // Rediriger vers une page d'erreur 404
//     exit; // Arrêter l'exécution du script
// }


// Je vérifie si l'action est définie dans l'URL et n'est pas vide
if (isset($_GET["action"]) && !empty($_GET["action"])) {   // Si une action est spécifiée dans l'URL
    switch ($_GET["action"]) {
        case 'accueil':  // Préparez la requête préparée pour récupérer les informations de plusieurs tables
            // Charger les données du fichier JSON
            $data = read_json_file('..\data\accueil.json');

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
                <section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 cadre_noir bg-light
                ">
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
                        col-xs-11 col-sm-11 col-md-11 col-lg-5 col-xl-5 col-xxl-5
                    ">
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
                                        // Préparer la requête SQL avec des paramètres
                                        $sql = "SELECT id_horaire_ouverture, jour, horaire_matin, horaire_apres_midi FROM horaire_ouverture";
                                        $stmt = $bdd->prepare($sql);

                                        // Exécuter la requête préparée
                                        $stmt->execute();

                                        // Récupérer les résultats sous forme d'un tableau associatif
                                        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        // Afficher les résultats dans le tableau
                                        foreach ($horaires_data as $resultat) {
                                        ?>
                                            <tr>
                                                <td class='txt-Start'>
                                                    <?= $resultat['jour']   ?>
                                                </td>
                                                <td class='txt-End'>
                                                    <input type="text" class="form-control" id="horaire_matin_<?= $resultat['id_horaire_ouverture'] ?>" name="horaire_matin_<?= $resultat['id_horaire_ouverture'] ?>" value="<?= $resultat['horaire_matin'] ?>">
                                                </td>
                                                <td class='txt-End'>
                                                    <input type="text" class="form-control" id="horaire_apres_midi_<?= $resultat['id_horaire_ouverture'] ?>" name="horaire_apres_midi_<?= $resultat['id_horaire_ouverture'] ?>" value="<?= $resultat['horaire_apres_midi'] ?>">
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
    }
} else {
    // Rediriger vers la page 404 si l'utilisateur n'a pas les autorisations nécessaires
    header('Location:../index.php?page=404');
    exit;
}
?>