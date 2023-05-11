<?= $_GET['token']; ?>
<!--Page d'erreur 403-->
<article class="row justify-content-center py-3" title="Page interdite">
    <div class="card my-5 cadre_noir alert alert-danger
                col-xs-6 col-sm-6 col-md-6 col-lg-10 col-xl-10 col-xxl-10
                 text-center">
        <div class="row g-0">
            <!-- col-xs col-sm col-md col-lg col-xl col-xxl -->
                <img    src="./images/403.png" 
                        class=" img-fluid
                                col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 
                                border border-dark" 
                        alt="erreur 403">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
                <div class="card-header border border-dark">
                    <h1 class="h1 fw-bold">
                        Erreur: 403:
                    </h1> <!-- Titre de la page d'erreur -->
                </div>
                <div class="card-body border border-dark py-5">
                    <h2 class="h2clignote"> Accès refusé</h2> <!-- Message d'erreur pour l'erreur 403 -->
                    <hr>
                    <p class="lead fw-bold txt-Noir">
                        Désolé, vous n'êtes pas autorisé à accéder à cette ressource. Cela peut être dû à une authentification invalide ou à une autorisation insuffisante.
                    </p>
                </div>
                <div class="card-footer border border-dark">
                    <p class="lead fw-bold txt-Noir">
                        Veuillez contacter l'administrateur du site pour obtenir de l'aide.
                    </p>
                </div>
            </div>
        </div>
</article>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>