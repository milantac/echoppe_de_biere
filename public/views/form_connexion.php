<section class="container connexion-form">
    <h1>Connexion</h1>
    <?php
    if (isset($_GET["action"])) {
        echo "<h6>vous avez été deconnecter</h6>";
    }
    ?>
    <div class="row my-5">
        <form action="../models/script_php/login.php" method="POST" class="col-12 border border-5 border-dark my-5">
            <!-- Email input -->
            <div class="form-outline my-4">
                <input type="mail" id="mail" name="mail" class="form-control" required>
                <label class="form-label" for="mail">e-mail de connexion</label>
            </div>

            <!-- Password input -->
            <div class="form-outline-info mb-4">
                <input type="password" id="mdp" name="mdp" class="form-control">
                <label class="form-label" for="mdp">Mot de passe</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Connexion</button>
        </form>
        <a href="index.php?page=form_inscription" class="inscription-link">Pas encore inscrit ? S'inscrire ici</a>
    </div>
</section>