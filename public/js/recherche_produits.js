function filterProducts() {
    const searchInput = document.getElementById("searchInput");
    const searchText = searchInput.value.toLowerCase();
    const cards = document.getElementsByClassName("card");
  
    // Récupérer les filtres de type et origine
    const typeFilters = document.querySelectorAll('input[type="checkbox"][id^="type"]:checked');
    const originFilters = document.querySelectorAll('input[type="checkbox"][id^="origine"]:checked');
  
    for (let i = 0; i < cards.length; i++) {
      const cardTitle = cards[i].querySelector(".card-title");
  
      // Récupérer les informations de type et d'origine pour chaque carte
      const cardType = cards[i].getAttribute("data-type");
      const cardOrigin = cards[i].getAttribute("data-origin");
  
      // Vérifier si la carte correspond aux filtres de type et d'origine
      const typeMatch = typeFilters.length === 0 || Array.from(typeFilters).some(filter => filter.value === cardType);
      const originMatch = originFilters.length === 0 || Array.from(originFilters).some(filter => filter.value === cardOrigin);
  
      if (cardTitle.textContent.toLowerCase().indexOf(searchText) > -1 && typeMatch && originMatch) {
        cards[i].style.display = "block";
      } else {
        cards[i].style.display = "none";
      }
    }
  }
  