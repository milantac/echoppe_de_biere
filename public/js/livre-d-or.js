// Initialise l'index courant à 0 ou à la valeur enregistrée dans le localStorage
let currentIndex = localStorage.getItem('currentIndex') ? parseInt(localStorage.getItem('currentIndex')) : 0;

// Fonction pour sauvegarder la valeur de currentIndex dans le localStorage
function saveCurrentIndex() {
    localStorage.setItem('currentIndex', currentIndex);
}

// Mettez à jour les autres fonctions pour appeler saveCurrentIndex() après avoir modifié currentIndex

// Fonction pour passer aux entrées suivantes
function nextEntries() {
    currentIndex += 2;
    if (currentIndex >= livre_d_or_recup.length) {
        currentIndex = livre_d_or_recup.length > 1 ? 0 : currentIndex;
    }
    displayEntry(currentIndex, currentIndex + 1);
    saveCurrentIndex();
}

// Fonction pour revenir aux entrées précédentes
function prevEntries() {
    currentIndex -= 2;
    if (currentIndex < 0) {
        currentIndex = livre_d_or_recup.length > 1 ? livre_d_or_recup.length - 2 : currentIndex;
    }
    displayEntry(currentIndex, currentIndex + 1);
    saveCurrentIndex();
}

// Fonction pour afficher les entrées du livre d'or aux index donnés
function displayEntry(index1, index2) {
    // Si l'index est invalide, le définir sur 0
    if (index1 < 0 || index1 >= livre_d_or_recup.length) {
        index1 = 0;
    }
    if (index2 < 0 || index2 >= livre_d_or_recup.length) {
        index2 = livre_d_or_recup.length > 1 ? 1 : 0;
    }

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
                    <img src="../public/images/logo/Logo_Vectoriel_Or.svg" alt="Logo Echoppe de bière" class="img-fluid mt-3" />
                    <h1 class="fw-bold my-2">LIVRE D'OR</h1>
                    <p>l'échoppe de bière</p>
                </div>
            </li>
            <li>
                <!-- Buttons -->
                <div class="row mx-5 text-start">
                    <!-- Premier commentaire -->
                    <div class="container mt-3">
                        <div class="row my-2">
                            <br>
                        </div>
                        <div class="row m-4">
                            <br>
                            <p class="txt-commentaire text-start fw-bold fs-2 my-2">
                                ${entry1.commentaire}
                            </p>
                        </div>
                        <div class="row my-4 me-2">
                            <p class="mt-4 text-end fs-4 me-5">Commentaire de:</p>
                            <hr>
                            <p class="mb-4 txt-commentaire text-end fw-bold fs-1 me-5">
                                ${entry1.nom} - ${entry1.prenom}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <button class="fw-bold btn btn-echoppe" id="prevButton">
                        &LT;
                    </button>
                    <p>précédant</p>
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
                        <div class="row my-2">
                            <br>
                        </div>
                        <div class="row m-4">
                            <br>
                            <p class="txt-commentaire text-start fw-bold fs-2 my-2">
                                ${entry2.commentaire}
                            </p>
                        </div>
                        <div class="row my-4 me-2">
                            <p class="mt-4 text-end fs-4 me-5">Commentaire de:</p>
                            <hr>
                            <p class="mb-4 txt-commentaire text-end fw-bold fs-1 me-5">
                                ${entry2.nom} - ${entry2.prenom}
                            </p>
                        </div>
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

    // Ajoute les écouteurs d'événements pour les boutons "Suivant" et "Précédent" après avoir mis à jour l'élément 'livre_d_or_pages'
    const nextButton = document.getElementById('nextButton');
    nextButton.addEventListener('click', nextEntries);

    const prevButton = document.getElementById('prevButton');
    prevButton.addEventListener('click', prevEntries);
}

// Affiche les entrées initiales (index 0 et 1)
displayEntry(currentIndex, currentIndex + 1);