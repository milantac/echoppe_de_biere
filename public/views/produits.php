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
// Récupération des produits pour les cartes de produits
$sqlCards = " SELECT produits.id, produits.nom AS nom_biere, produits.img AS photo, produits.degres, produits.contenance, produits.prix, produits.description, produits.stock, categories.nom AS couleur, origines.nom AS pays
              FROM produits
              JOIN categories ON produits.id_categories = categories.id
              JOIN origines ON produits.id_origines = origines.id";
$stmtCards = $bdd->prepare($sqlCards);
$stmtCards->execute();
// Vérification si des résultats ont été trouvés
if ($stmtCards->rowCount() > 0) {
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
                <th>Contenance</th>
                <th>Prix</th>
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
              while ($row = $stmtCards->fetch(PDO::FETCH_ASSOC)) {
                $id_biere = $row['id'];
              ?>
                <tr>
                  <td class="d-none"><?= $id_biere ?></td>
                  <td><?= $row['nom_biere'] ?></td>
                  <td><img src='./images/produits/<?= $row['photo'] ?>' class='img-fluid rounded-start img-resize' alt='<?= $row['photo'] ?>'></td>
                  <td><?= $row['degres'] ?></td>
                  <td><?= $row['contenance'] ?> cl</td>
                  <td><?= $row['prix'] ?>€</td>
                  <td><?= $row['description'] ?></td>
                  <td><?= $row["stock"] ?></td>
                  <td><?= $row['couleur'] ?></td>
                  <td><?= $row['pays'] ?></td>
                  <td><a href="index.php?page=form_modif&action=produit&id=<?= $id_biere ?>" class="btn btn-primary">Modifier</a></td>
                  <td><a href="../models/script_php/supprimer.php?id=<?= $id_biere ?>" class="btn btn-danger">Supprimer</a></td>
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
  ?>
    <div class="container">
      <div class="row mb-3">
        <!-- Barre latérale avec champ de recherche et filtres (col-3) -->
        <section class="col-2 bg-echoppe">
          <div class="row">
            <h3 class="col-12">Recherche de produits</h3>
            <input type="text" class="search-input" id="searchInput" placeholder="Rechercher un produit..." onkeyup="filterProducts()">
          </div>
          <?php
          // Récupérer la liste des types de bière (catégories)
          $stmt = $bdd->prepare('SELECT DISTINCT nom FROM categories ORDER BY nom ASC');
          $stmt->execute();
          $types = $stmt->fetchAll(PDO::FETCH_COLUMN);

          // Récupérer la liste des origines
          $stmt = $bdd->prepare('SELECT DISTINCT nom FROM origines ORDER BY nom ASC');
          $stmt->execute();
          $origins = $stmt->fetchAll(PDO::FETCH_COLUMN);
          ?>

          <!-- Filtres par type -->
          <div class="row">
            <h4 class="col-12">Type de bière</h4>
            <?php foreach ($types as $type) : ?>
              <div class="form-check col-6">
                <input class="form-check-input" type="checkbox" value="<?= htmlspecialchars($type) ?>" id="<?= htmlspecialchars($type) ?>" onchange="filterProducts()">
                <label class="form-check-label" for="<?= htmlspecialchars($type) ?>">
                  <?= htmlspecialchars($type) ?>
                </label>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Filtres par origine -->
          <div class="row">
            <h4 class="col-12">Origine</h4>
            <?php foreach ($origins as $origin) : ?>
              <div class="form-check col-6">
                <input class="form-check-input" type="checkbox" value="<?= htmlspecialchars($origin) ?>" id="<?= htmlspecialchars($origin) ?>" onchange="filterProducts()">
                <label class="form-check-label" for="<?= htmlspecialchars($origin) ?>">
                  <?= htmlspecialchars($origin) ?>
                </label>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Filtre de prix -->
          <div class="row">
            <h4 class="col-12">Prix (€)</h4>
            <div class="d-flex justify-content-between">
              <span>0</span>
              <input type="range" class="form-range" min="0" max="50" step="1" id="priceRange" oninput="updatePriceLabel()" onchange="filterProducts()">
              <span>50</span>
            </div>
            <span id="priceLabel">0 - 50€</span>
          </div>
        </section>

        <!-- Cartes de produits (col-9) -->
        <section class="col-10">
          <div class="container-fluid">
            <div class="row">
              <?php
              // Affichage sous forme de cards
              while ($row = $stmtCards->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <!-- Création d'une carte pour chaque bière -->
                <div class="card cadre_noir col-3 my-1">
                  <div class="row my-2">
                    <!-- Affichage de l'image de la bière -->
                    <div class="col-12 d-flex justify-content-center align-items-center">
                      <img src="./images/produits/<?= $row["photo"] ?>" class="img-fluid rounded-start img-resize mx-auto" alt="<?= $row["photo"] ?>">
                    </div>
                    <div class="col-12">
                      <div class="card-header">
                        <!-- Affichage du titre et de la quantité de la bière -->
                        <h5 class="card-title text-center"><?= $row["nom_biere"] ?></h5>
                      </div>
                      <div class="card-body">
                        <!-- Affichage des 100 premiers caractères de la description et du contenu entier au survol -->
                        <!-- <p class="card-text description" title="description" data-bs-toggle="modal"><?= $row["description"] ?></p> -->
                        <p class="card-text"><?= substr($row["description"], 0, 100) ?><?php if (strlen($row["description"]) > 100) {
                                                                                          echo '...';
                                                                                        } ?>
                          <br>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#descriptionModal<?= $modal_id ?>">lire la suite</a>
                        </p>
                        <p class="card-text fw-bold"><?= $row["contenance"] ?>cl
                          <br>
                          En stock: <?= ($row["stock"] > 0 ? "<span class='text-success'>Oui</span>" : "<span class='text-danger'>Non</span>") ?>
                          <br>
                          Stock disponible: <?= $row["stock"] ?>
                          <br>
                          Prix: <?= $row["prix"] ?>€
                        </p>

                      </div>
                      <div class="card-header d-flex justify-content-center align-items-center">
                        <!-- Bouton pour ajouter la bière au panier -->
                        <a href="#" class="btn btn-primary my-2 mx-auto ">ajouter au panier</a>
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
              ?>
            </div>
          </div>
        </section>
      </div>
    </div>
<?php
  }
} else {
  echo "Aucun résultat trouvé.";
}
