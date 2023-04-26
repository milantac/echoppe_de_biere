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
    if (nom.value === "" || prenom.value === "" || email.value === "" || tel.value === "" || commentaire.value === "") {
        errorMessages.push("Veuillez remplir tous les champs requis.");
        nom.classList.toggle("border-danger", nom.value === "");
        prenom.classList.toggle("border-danger", prenom.value === "");
        email.classList.toggle("border-danger", email.value === "");
        tel.classList.toggle("border-danger", tel.value === "");
        commentaire.classList.toggle("border-danger", commentaire.value === "");
    } else {
        nom.classList.remove("border-danger");
        prenom.classList.remove("border-danger");
        email.classList.remove("border-danger");
        tel.classList.remove("border-danger");
        commentaire.classList.remove("border-danger");
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