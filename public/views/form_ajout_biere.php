<div class="row my-2 justify-content-center">
    <h2 class="col-10 cadre_bois bg-light text-center py-4">Ajouter une bière</h2>
</div>
<div class="row justify-content-center mb-2">
    <form action="../models/script_php/ajout.php?action=new-biere" method="post" enctype="multipart/form-data" class="col-10 cadre_noir bg-biere">
        <div class="row m-3">
            <!-- <label for="id_biere">ID Bière:</label>
            <input type="number" name="id_biere" id="id_biere" required> -->
            <div class="col-6">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-echoppe fw-bold">Nom Bière:</span>
                    <input type="text" name="nom_biere" id="nom_biere" class="form-control" placeholder="nom de la bière" aria-label="nom de la bière" aria-describedby="nom de la bière" required>
                </div>
            </div>
            <div class="col-3">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-echoppe fw-bold">Degrés d'alcool:</span>
                    <input type="number" name="degres_d_alcool" id="degres_d_alcool" step="0.1" required>
                </div>
            </div>
            <div class='col-3'>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-echoppe fw-bold">Quantité (en cl):</span>
                    <input type="number" name="quantite" id="quantite" step="1" required>
                </div>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-9">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-echoppe fw-bold">Description:</span>
                    <textarea name="description" id="description" class="form-control" aria-label="Description" required></textarea>
                </div>
            </div>
            <div class="col-3">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-echoppe fw-bold">En stock:</span>
                    <div class="input-group-text bg-secondary">
                        <input type="checkbox" class="form-check-input" name="en_stock" id="en_stock" value="1">
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-6">
                <div class="input-group mb-3">
                    <label for="id_type_de_biere" class="input-group-text bg-echoppe fw-bold">Type de bière:</label>
                    <select name="id_type_de_biere" id="id_type_de_biere" class="form-select" required>
                        <?php
                        $stmt = $bdd->prepare("SELECT id_type_biere, couleur FROM type_de_biere");
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$row['id_type_biere']}'>{$row['couleur']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <label for="id_origine" class="input-group-text bg-echoppe fw-bold">Origine:</label>
                    <select name="id_origine" id="id_origine" class="form-select" required>
                        <?php
                        $stmt = $bdd->prepare("SELECT id_origine, pays FROM origine");
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$row['id_origine']}'>{$row['pays']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-echoppe fw-bold">Photo:</span>
                    <input type="file" name="photo" id="photo" class="form-control" placeholder="photo de la bière" aria-label="photo de la bière" aria-describedby="photo de la bière" required>
                </div>
            </div>
        </div>
        <div class="row m-3 justify-content-center">    
            <input type="submit" class="col-2 btn btn-success"value="Ajouter">
        </div>
    </form>
</div>