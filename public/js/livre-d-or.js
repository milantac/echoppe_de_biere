// Initialise l'index courant à 0
let currentIndex = 0;

// Fonction pour afficher les entrées du livre d'or aux index donnés
function displayEntry(index1, index2) {
    // Récupère les entrées aux index spécifiés
    const entry1 = livre_d_or_recup[index1];
    const entry2 = livre_d_or_recup[index2];

    // Construit le HTML pour afficher les entrées
    const entryHtml = `
    <!-- Front -->
    <ul class='hardcover_front'>
        <!--    Couverture  -->
        <li>
            <div class="coverDesign dark">
                <img src="../public/images/logo/Logo_Vectoriel.svg" alt="Logo Echoppe de bière" class="img-fluid mt-3" />
                <h1 class="fw-bold my-2">LIVRE D'OR</h1>
                <p>l'échoppe de bière</p>
            </div>
        </li>
        <li>
            <!-- Buttons -->
            <div class="row mx-5 text-start">
                <!-- Premier commentaire -->
                <div class="container mt-3">
                    <div class="input-group my-4">
                        <span class="input-group-text bg-echoppe text-start" id="nom-et-prénom">Commentaire de </span>
                        <input type="text" class="form-control bg-echoppe fw-bold" placeholder="${entry1.nom} - ${entry1.prenom}" aria-label="${entry1.nom} - ${entry1.prenom}" aria-describedby="nom-et-prénom" readonly>
                    </div>
                    <div class="input-group my-2">
                        <span class="input-group-text bg-echoppe">Commentaire:</span>
                        <textarea class="form-control" aria-label="With textarea" rows="10">${entry1.commentaire}</textarea>
                    </div>
                </div>
    
                <div class="col-2 text-center">
                    <button class="fw-bold btn btn-echoppe" id="prevButton">
                        &LT;
                    </button>
                    <p>précédant</p>
                </div>
            </div>
        </li>
    </ul>
    
    <!-- Pages -->
    <!--    affichage du second commentaire    -->
    <ul class='page' id="livre_d_or_pages">
        <!-- Les pages seront ajoutées dynamiquement ici -->
        <li>
            <!-- Second commentaire -->
            <div class="container mt-3">
                <div class="input-group my-4">
                    <span class="input-group-text bg-echoppe text-start" id="nom-et-prénom">Commentaire de </span>
                    <input type="text" class="form-control bg-echoppe fw-bold" placeholder="${entry2.nom} - ${entry2.prenom}" aria-label="${entry2.nom} - ${entry2.prenom}" aria-describedby="nom-et-prénom" readonly>
                </div>
                <div class="input-group my-2">
                    <span class="input-group-text bg-echoppe">Commentaire:</span>
                    <textarea class="form-control" aria-label="With textarea" rows="10">${entry2.commentaire}</textarea>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-2 text-center">
                    <button class="fw-bold btn btn-echoppe" id="nextButton">
                        &GT;
                    </button>
                    <p>suivant</p>
                </div>
            </div>
        </li>
    </ul>
    
    <!-- Back -->
    <ul class='hardcover_back'>
        <li></li>
        <li></li>
    </ul>
    <ul class='book_spine'>
        <li></li>
        <li></li>
    </ul>
    `;

    // Met à jour l'élément 'livre_d_or_pages' avec le nouveau contenu HTML
    const pagesElement = document.getElementById('livre_d_or_pages');
    pagesElement.innerHTML = entryHtml;
}

// Fonction pour passer aux entrées suivantes
function nextEntries() {
    currentIndex += 1;
    if (currentIndex >= livre_d_or_recup.length) {
        currentIndex = 0;
    }
    displayEntry(currentIndex, currentIndex + 1);
}

// Fonction pour revenir aux entrées précédentes
function prevEntries() {
    currentIndex -= 1;
    if (currentIndex < 0) {
        currentIndex = livre_d_or_recup.length - 2;
    }
    displayEntry(currentIndex, currentIndex + 1);
}

// Affiche les entrées initiales (index 0 et 1)
displayEntry(currentIndex, currentIndex + 1);

// Sélectionne le bouton "Suivant" et ajoute un gestionnaire d'événements pour appeler la fonction nextEntries lors d'un clic
const nextButton = document.getElementById('nextButton');
nextButton.addEventListener('click', nextEntries);

// Sélectionne le bouton "Précédent" et ajoute un gestionnaire d'événements pour appeler la fonction prevEntries lors d'un clic
const prevButton = document.getElementById('prevButton');
prevButton.addEventListener('click', prevEntries);