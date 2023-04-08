function showDescriptionInModal(id, fullDescription) {
    // Récupérer l'élément HTML pour afficher la description complète
    const descriptionElement = document.getElementById("fullDescription");
    
    // Mettre à jour le contenu de l'élément avec la description complète
    descriptionElement.textContent = fullDescription;
}