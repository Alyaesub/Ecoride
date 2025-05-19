// Fonctionnalité de changement d'onglet pour le dashboard
// Cette fonctionnalité permet de changer d'onglet dans le dashboard
const tabs = document.querySelectorAll(".tab-link");
const tabContents = document.querySelectorAll(".tab-content");

tabs.forEach((tab) => {
	tab.addEventListener("click", function () {
		// Désactive tous les onglets et cache tout le contenu
		tabs.forEach((t) => t.classList.remove("active"));
		tabContents.forEach((content) => content.classList.remove("active"));

		// Active l'onglet cliqué et affiche le contenu correspondant
		tab.classList.add("active");
		const activeTab = document.getElementById(tab.getAttribute("data-tab"));
		activeTab.classList.add("active");
	});
});

// Fonction pour afficher ou masquer le champ "Autre" pour la marque
// Cette fonction est appelée lorsque l'utilisateur sélectionne une marque dans le menu déroulant
function toggleMarqueAutre(selectObj) {
	const divAutre = document.getElementById("autre_marque_container");
	if (selectObj.value === "autre") {
		divAutre.style.display = "block";
	} else {
		divAutre.style.display = "none";
	}
}
