<div class="row justify-content-center mb-4">
  <h2 class="text-center bg-light mx-auto col-12 fw-bold h4 my-4 py-3 cadre_bois">Nos bières</h2>
  <?php
  if (isset($_SESSION['type_utilisateur']) && $_SESSION['type_utilisateur'] == 1) {
  ?>
    <div class="col-2">
      <a href="index.php?page=form_ajout_biere" class="btn btn-success btn-block">Ajouter une biere</a>
    </div>
  <?php
  }
  ?>
</div>
<?php
// Préparation de la requête SQL
$sql = "SELECT produits.id, produits.nom AS nom_biere, produits.img AS photo, produits.degres, produits.contenance, produits.description, produits.stock, categories.nom AS couleur, origines.nom AS pays
        FROM produits
        JOIN categories ON produits.id_categories = categories.id
        JOIN origines ON produits.id_origines = origines.id";
// Préparation de la requête avec l'objet PDO
$stmt = $bdd->prepare($sql);
// Exécution de la requête
$stmt->execute();
// Vérification si des résultats ont été trouvés
if ($stmt->rowCount() > 0) {
  $modal_id = 1; // Initialisation d'un compteur pour les modals
  if (isset($_SESSION['type_utilisateur']) && $_SESSION['type_utilisateur'] == 1) {
    // Affichage sous forme de tableau
?>
    <article class="container my-5 bg-light">
      <form action="../models/script_php/ajout.php?action=valid_com" method="post" class="row p-3 m-3 justify-content-center cadre_noir">
        <div class="table-responsive col-12 mt-3 mb-2">
          <table class='table table-bordered table-striped'>
            <thead class="table-dark">
              <tr>
                <th class="d-none">ID</th>
                <th>Nom</th>
                <th>Photo</th>
                <th>Degrés d'alcool</th>
                <th>cantenance</th>
                <th>Description</th>
                <th>stock</th>
                <th>Couleur</th>
                <th>Pays</th>
                <th>Modifier</th>
                <th>Supprimer</th>
              </tr>
            </thead>
            <tbody class="bg-echoppe">
              <?php
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_biere = $row['id'];
              ?>
                <tr>
                  <td class="d-none"><?= $id_biere ?></td>
                  <td><?= $row['nom_biere'] ?></td>
                  <td><img src='./images/produits/<?= $row['photo'] ?>' class='img-fluid rounded-start w-100' alt='<?= $row['photo'] ?>'></td>
                  <td><?= $row['degres'] ?></td>
                  <td><?= $row['contenance'] ?> cl</td>
                  <td><?= $row['description'] ?></td> 
                  <td><?= $row["stock"] ?></td>
                  <td><?= $row['couleur'] ?></td>
                  <td><?= $row['pays'] ?></td>
                  <td><a href="index.php?page=form_modif&action=produit&id=<?= $id_biere ?>" class="btn btn-primary">Modifier</a></td>
                  <td><a href="../models/script_php/supprimer.php?id=<?=  $id_biere ?>" class="btn btn-danger">Supprimer</a></td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </form>
    </article>
  <?php
  } else {
          // Affichage sous forme de cards
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          ?>
            <!-- Création d'une carte pour chaque bière -->
            <div class="card mx-2 mb-4 cadre_noir" style="width: 20%;">
              <div class="row g-0">
                <!-- Affichage de l'image de la bière -->
                <div class="col-md-4 my-auto">
                  <img src="./images/produits/<?= $row["photo"] ?>" class="img-fluid rounded-start w-100" alt="<?= $row["photo"] ?>">
                </div>
                <div class="col-md-8">
                  <div class="card-header">
                    <!-- Affichage du titre et de la quantité de la bière -->
                    <h5 class="card-title"><?= $row["nom_biere"] ?></h5>
                  </div>
                  <div class="card-body">
                    <!-- Affichage des 200 premiers caractères de la description et du contenu entier au survol -->
                    <!-- <p class="card-text description" title="description" data-bs-toggle="modal"><?= $row["description"] ?></p> -->
                    <p class="card-text"><?= substr($row["description"], 0, 200) ?><?php if (strlen($row["description"]) > 200) {
                                                                                      echo '...';
                                                                                    } ?>
                      <br>
                      <a href="#" data-bs-toggle="modal" data-bs-target="#descriptionModal<?= $modal_id ?>">lire la suite</a>
                    </p>
                      <p class="card-text fw-bold"><?= $row["contenance"] ?>cl
                      <br>
                      En stock: <?= ($row["stock"]>0 ? "<span class='text-success'>Oui</span>" : "<span class='text-danger'>Non</span>") ?>
                      <br>
                      Stock disponible: <?= $row["stock"] ?>
                    </p>

                  </div>
                  <div class="card-header">
                    <!-- Bouton pour ajouter la bière au panier -->
                    <a href="#" class="btn btn-primary mb-2">ajouter au panier</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal Bootstrap pour afficher la description complète -->
            <div class="modal fade" id="descriptionModal<?= $modal_id ?>" tabindex="-1" aria-labelledby="descriptionModalLabel<?= $modal_id ?>" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel<?= $modal_id ?>">Description de <?= $row["nom_biere"] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <?= $row["description"] ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                  </div>
                </div>
              </div>
            </div>
      <?php
            $modal_id++; // Incrémentation du compteur pour les modals
          }
        }
      } else {
        echo "Aucun résultat trouvé.";
      }
