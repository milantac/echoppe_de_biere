<!-- col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 -->
<form class="
                col-xs-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 col-xxl-11 
                cadre_noir bg-biere my-2
            " method="post">
    <fieldset class="pb-5">
        <div class="row mx-3 mt-2">
            <span class="   
                        col-xs-0 col-sm-0 col-md-2 col-lg-2 col-xl-3 col-xxl-3 
                        d-none d-lg-block my-auto my-auto span-titre
                    ">
            </span>
            <legend class="
                        col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-6 col-xxl-6
                        h1 text-center
                    ">
                E-mail
            </legend>
            <span class="   
                        col-xs-0 col-sm-0 col-md-2 col-lg-2 col-xl-3 col-xxl-3 
                        d-none d-lg-block my-auto my-auto span-titre 
                    ">
            </span>
        </div>
        <div class="row mx-3">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mt-5 mb-2">
                <label for="nom" class="form-label fw-bold">Nom</label>
                <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mt-5 mb-2">
                <label for="prenom" class="form-label fw-bold">Prénom</label>
                <input type="text" class="form-control" id="prenom" placeholder="Entrez votre prénom">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mt-5 mb-2">
                <label for="email" class="form-label fw-bold">E-mail</label>
                <input type="email" class="form-control" id="email" placeholder="Entrez votre adresse e-mail">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mt-5 mb-2">
                <label for="tel" class="form-label fw-bold">Numéro de téléphone</label>
                <input type="tel" class="form-control" id="tel" placeholder="Entrez votre numéro de téléphone">
            </div>
        </div>
        <div class="row mx-3">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-12 col-xxl-12 my-2">
                <label for="objet" class="form-label fw-bold">Objet</label>
                <input type="text" class="form-control" id="objet" placeholder="Entrez l'objet de votre message">
            </div>
            <div class="input-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-12 col-xxl-12 my-2">
                <span class="input-group-text fw-bold bg-echoppe ">Message</span>
                <textarea class="form-control" id="message" name="message" rows="10" placeholder="Entrez votre message"></textarea>
            </div>
            <div class="row mx-auto justify-content-center ">
                <button type="submit" class="btn btn-primary btn-block col-2 my-2">Envoyer</button>
            </div>
        </div>
    </fieldset>
</form>
