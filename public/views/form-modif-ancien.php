<?php
// // Je vérifie que l'utilisateur est bien administrateur pour effectuer des modifications
// session_start(); // Démarre une nouvelle session ou reprend une session existante
// if (!isset($_SESSION["admin"])) { // Si l'utilisateur n'est pas connecté en tant qu'administrateur
//     header('Location: ../index.php?page=404'); // Rediriger vers une page d'erreur 404
//     exit; // Arrêter l'exécution du script
// }

// Je Vérifie si l'action est définie dans l'URL et n'est pas vide
if (isset($_GET["action"]) && !empty($_GET["action"])) {   // Si une action est spécifiée dans l'URL
    switch ($_GET["action"]) {
        case 'modif-heure':
            // Je vérifie si idt est présent dans l'URL et n'est pas vide
            if (isset($_GET["idt"]) && !empty($_GET["idt"])) {
                // Préparer la requête SQL avec des paramètres
                $sql = "SELECT jour FROM horaire_ouverture WHERE id_horaire_ouverture = :id";
                $stmt = $bdd->prepare($sql);

                // Lier les valeurs aux paramètres de la requête préparée
                $stmt->bindParam(':id', $_GET["idt"]);

                // Exécuter la requête préparée
                $stmt->execute();

                // Récupérer le résultat sous forme d'un tableau associatif
                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
                $jour = $resultat["jour"];
?>
                <!-- Afficher un formulaire pour modifier les heures d'ouverture -->
                <form action="../models/script_php/ajout.php?action=horaire-ouverture" method="post" class="row justify-content-evenly">
                    <div class="form-group col-12">
                        <!-- Ajouter un champ masqué pour stocker l'identifiant -->
                        <input type="hidden" name="id" value="<?= $_GET['idt'] ?>">
                    </div>
                    <div class="form-group col-4 text-center">
                        <label for="jour" class="fw-bold">Jours:</label>
                        <!-- Ajouter un champ de texte pour afficher le jour de la semaine -->
                        <input type="text" class="form-control" id="jour" name="jour" value="<?= $jour ?>" readonly>
                    </div>
                    <div class="form-group col-4 text-center">
                        <label for="horaire-matin" class="fw-bold">Heure Matin:</label>
                        <!-- Ajouter un champ de texte pour saisir l'heure d'ouverture du matin -->
                        <input type="text" class="form-control" id="horaire-matin" name="horaire-matin" required>
                    </div>
                    <div class="form-group col-4 text-center">
                        <label for="horaire-apres-midi" class="fw-bold">Heure Après-midi:</label>
                        <!-- Ajouter un champ de texte pour saisir l'heure d'ouverture de l'après-midi -->
                        <input type="text" class="form-control" id="horaire-apres-midi" name="horaire-apres-midi" required>
                    </div>
                    <button type="submit" class="btn btn-primary col-3 my-2">changer</button>
                </form>
            <?php
            } // ELSE gérer le messasage de retour 
            break;
        case 'modif-msg-acc':
            if (isset($_GET['idt']) && !empty($_GET['idt'])) {
                // Préparer la requête SQL avec des paramètres
                $sql = "SELECT * FROM a_propos_de_nous WHERE id_msg_accueil = :id";
                $stmt = $bdd->prepare($sql);

                // Lier les valeurs aux paramètres de la requête préparée
                $stmt->bindParam(':id', $_GET["idt"]);

                // Exécuter la requête préparée
                $stmt->execute();

                // Récupérer le résultat sous forme d'un tableau associatif
                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
                $paragraphe_un = $resultat["paragraphe_un"];
                $paragraphe_deux = $resultat["paragraphe_deux"];
                $paragraphe_trois = $resultat["paragraphe_trois"];
                $paragraphe_quatre = $resultat["paragraphe_quatre"];
            ?>
                <!-- Afficher un formulaire pour modifier le message d'accueil -->
                <form action="../models/script_php/ajout.php?action=msg-acc" method="post" class="row justify-content-center">
                    <div class="form-group col-12">
                        <!-- Ajouter un champ masqué pour stocker l'identifiant -->
                        <input type="hidden" name="id_msg" id="id_msg" value="<?= $_GET['idt'] ?>">
                    </div>
                    <div class="col-11 text-center">
                        <div class="form-floating my-4 border border-dark border-5">
                            <!-- Ajouter un champ de texte pour afficher le message d'accueil -->
                            <textarea class="form-control" id="para_accueil_un" name="para_accueil_un" row="20" style="height: 13rem"><?= $paragraphe_un ?></textarea>
                            <label for="para_accueil_un" class="fw-bold">Entrez votre premier paragraphe:</label>
                        </div>
                        <div class="form-floating my-4 border border-dark border-5">
                            <!-- Ajouter un champ de texte pour afficher le message d'accueil -->
                            <textarea class="form-control" id="para_accueil_deux" name="para_accueil_deux" row="20" style="height: 13rem"><?= $paragraphe_deux ?></textarea>
                            <label for="para_accueil_deux" class="fw-bold">Entrez votre deuxième paragraphe:</label>
                        </div>
                        <div class="form-floating my-4 border border-dark border-5">
                            <!-- Ajouter un champ de texte pour afficher le message d'accueil -->
                            <textarea class="form-control" id="para_accueil_trois" name="para_accueil_trois" row="20" style="height: 13rem"><?= $paragraphe_trois ?></textarea>
                            <label for="para_accueil_trois" class="fw-bold">Entrez votre troisième paragraphe:</label>
                        </div>
                        <div class="form-floating my-4 border border-dark border-5">
                            <!-- Ajouter un champ de texte pour afficher le message d'accueil -->
                            <textarea class="form-control" id="para_accueil_quatre" name="para_accueil_quatre" row="20" style="height: 13rem"><?= $paragraphe_quatre ?></textarea>
                            <label for="para_accueil_quatre" class="fw-bold">Entrez votre quatrième paragraphe:</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary my-2 col-2">changer</button>
                </form>

<?php
            } // ELSE gérer le messasage de retour 
    }
} else {
    header('Location:../index.php?page=404');
    exit;
}