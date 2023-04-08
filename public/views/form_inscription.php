<section class="container inscription-form">
    <h2 class="text-center">Inscription</h2>
    <article class="row my-5 justify-content-center">
        <form action="../models/script_php/inscription.php" method="POST" class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-8 col-xxl-8 cadre_noir bg-light">
            <div class="row mx-2">
                <div class="form-outline my-4 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3">
                    <label class="form-label" for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" placeholder="Votre nom" class="form-control" required>
                </div>
                <div class="form-outline my-4 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3">
                    <label class="form-label" for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" class="form-control" required>
                </div>

                <div class="form-outline my-4 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3">
                    <label class="form-label" for="email">Email :</label>
                    <input type="email" id="email" name="email" placeholder="Votre email" class="form-control" required>
                </div>
                <div class="form-outline my-4 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3">
                    <label class="form-label" for="telephone">Numéro de téléphone :</label>
                    <input type="tel" id="telephone" name="telephone" placeholder="Votre numéro de téléphone" class="form-control" required>
                </div>
            </div>
            <div class="row mx-2">
                <div class="form-outline my-4 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2 col-xxl-2">
                    <label class="form-label" for="numero-adresse">numéro:</label>
                    <input type="text" id="numero-adresse" name="numero-adresse" placeholder="numero" class="form-control" required>
                </div>
                <div class="form-outline my-4 col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-4 col-xxl-4">
                    <label class="form-label" for="voie-adresse">voie :</label>
                    <input type="text" id="voie-adresse" name="voie-adresse" placeholder="Votre adresse postale" class="form-control" required>
                </div>
                <div class="form-outline my-4 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3">
                    <label class="form-label" for="cp-adresse">code postal:</label>
                    <input type="text" id="cp-adresse" name="cp-adresse" placeholder="numero" class="form-control" required>
                </div>
                <div class="form-outline my-4 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3">
                    <label class="form-label" for="ville-adresse">ville :</label>
                    <input type="text" id="ville-adresse" name="ville-adresse" placeholder="Votre adresse postale" class="form-control" required>
                </div>
                <div class="form-outline my-4 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3">
                    <label class="form-label" for="motdepasse">Mot de passe :</label>
                    <input type="password" id="motdepasse" name="motdepasse" placeholder="Votre mot de passe" class="form-control" required>
                </div>
            </div>

            <div class="row justify-content-center">
                <button type="submit" class="btn btn-primary mb-5 col-2">S'inscrire</button>
            </div>
        </form>
    </article>
</section>