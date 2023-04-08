// Fonction pour valider le formulaire
function validateForm() {
    // Récupération des éléments du formulaire
    let nom = document.getElementById("nom");
    let prenom = document.getElementById("prenom");
    let email = document.getElementById("email");
    let tel = document.getElementById("tel");
    let commentaire = document.getElementById("commentaire");

    // Tableau pour stocker les messages d'erreur
    let errorMessages = [];

    // Vérification si tous les champs sont remplis
    if (nom.value == "") {
        errorMessages.push("Veuillez remplir le champ nom est requis.");
        nom.classList.add("border border-danger border-2");
    }else if (prenom.value == ""){
        errorMessages.push("Veuillez remplir le champ prénom et requis.");
        prenom.classList.add("border border-danger border-2");
    }else if (email.value == ""){
        errorMessages.push("Veuillez remplir le champ email est requis.");
        email.classList.add("border border-danger border-2");
    }else if (tel.value == ""){
        errorMessages.push("Veuillez remplir le champ téléphone est requis.");
        tel.classList.add("border border-danger border-2");
    }else if (commentaire.value == ""){
        errorMessages.push("Veuillez remplir le champ commentaire est requis.");
    }else{
        nom.classList.remove("border border-danger border-2");
        prenom.classList.remove("border border-danger border-2");
        email.classList.remove("border border-danger border-2");
        tel.classList.remove("border border-danger border-2");
    }


    // Expression régulière pour valider l'adresse e-mail
    let emailRegEx = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    // Vérification si l'adresse e-mail est valide
    if (!emailRegEx.test(email.value)) {
        errorMessages.push("Veuillez entrer une adresse e-mail valide.");
        email.classList.add("border-danger");
    } else {
        email.classList.remove("border-danger");
    }

    // Expression régulière pour valider le numéro de téléphone
    let telRegEx = /^\d{10}$/;
    // Vérification si le numéro de téléphone est valide
    if (!telRegEx.test(tel.value)) {
        errorMessages.push("Veuillez entrer un numéro de téléphone valide (10 chiffres).");
        tel.classList.add("border-danger");
    } else {
        tel.classList.remove("border-danger");
    }

    // Récupération de l'élément pour afficher les messages d'erreur
    let errorMsgElement = document.getElementById("errorMessages");
    // Affichage des messages d'erreur
    errorMsgElement.innerHTML = errorMessages.join("<br>");

    // Si aucun message d'erreur, la fonction retourne true, sinon false
    return errorMessages.length === 0;
}