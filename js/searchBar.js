console.log("test");

//fiche JS qui gére la searchbar
// Sélectionne les éléments du DOM
const searchInput = document.getElementById("searchInput"); // Champ de saisie utilisateur
const searcBtn = document.getElementById("searchBtn"); // Bouton de recherche
const resultsDiv = document.getElementById("results"); // Div qui affiche les résultats

// Fonction qui écoute les frappes dans l'input
searchInput.addEventListener("input", function () {
	const query = this.value; // Récupère la valeur tapée par l'utilisateur
	// N'affiche rien si moins de 2 caractères
	if (query.length < 2) {
		resultsDiv.style.display = "none";
		resultsDiv.innerHTML = "";
		return;
	}

	// Appelle le contrôleur SearchCitiesController via Fetch pour récupérer les suggestions
	// search-cities&q sert de route pour aller chercher le controller 'searchCitiesController.php'
	fetch(`/searchCities?q=${encodeURIComponent(query)}`)
		.then((response) => response.json()) // Convertit la réponse en JSON
		.then((data) => {
			resultsDiv.innerHTML = ""; // Vide les anciens résultats
			if (data.length > 0) {
				// Pour chaque ville reçue, crée un div affichant le nom de la ville
				data.forEach((city) => {
					const div = document.createElement("div");
					div.textContent = city.adresse_depart;
					div.classList.add("result-item");

					div.addEventListener("click", () => {
						searchInput.value = city.adresse_depart; // Remplit l'input avec la ville cliquée
						resultsDiv.style.display = "none"; // Cache les suggestions après sélection
						window.location.href = `/detailsCovoit?id=${city.id}`;
					});
					resultsDiv.appendChild(div); // Ajoute le div à la liste des résultats
				});
				resultsDiv.style.display = "block"; // Affiche la div des résultats
			} else {
				resultsDiv.style.display = "none"; // Cache si aucun résultat
			}
		})
		.catch((error) => {
			console.error("Erreur:", error); // Gère les erreurs de requête
		});
});
