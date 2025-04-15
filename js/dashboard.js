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
	const divAutre = document.getElementById("divAutreMarque");
	if (selectObj.value === "autre") {
		divAutre.style.display = "block";
	} else {
		divAutre.style.display = "none";
	}
}

/* // Fonction de mise à jour de l'affichage depuis le localStorage
//pour afficher les données stockées dans le localStorage
// et les afficher dans les sections correspondantes

// Informations Personnelles
function updateDisplay() {
	// Informations Personnelles
	const infoData = JSON.parse(localStorage.getItem("infoPerso")) || {};
	const displayInfo = document.getElementById("displayInfo");
	displayInfo.innerHTML = `
    <p><strong>Pseudo :</strong> ${infoData.pseudo || "-"}</p>
    <p><strong>Email :</strong> ${infoData.email || "-"}</p>
    <p><strong>Password :</strong> ${infoData.password || "-"}</p>
  `;

	// Véhicule
	const vehiculeData = JSON.parse(localStorage.getItem("vehicule")) || {};
	const displayVehicule = document.getElementById("displayVehicule");
	displayVehicule.innerHTML = `
    <p><strong>ID Véhicule :</strong> ${vehiculeData.idVehicule || "-"}</p>
    <p><strong>ID Marque :</strong> ${vehiculeData.idMarque || "-"}</p>
    <p><strong>Nom de la Parque :</strong> ${vehiculeData.nomParque || "-"}</p>
    <p><strong>Modèle :</strong> ${vehiculeData.modele || "-"}</p>
    <p><strong>Immatriculation :</strong> ${
		vehiculeData.immatriculation || "-"
	}</p>
    <p><strong>Couleur :</strong> ${vehiculeData.couleur || "-"}</p>
    <p><strong>Énergie utilisée :</strong> ${vehiculeData.energie || "-"}</p>
  `;

	// Covoiturage
	const covoiturageData =
		JSON.parse(localStorage.getItem("covoiturage")) || {};
	const displayCovoiturage = document.getElementById("displayCovoiturage");
	displayCovoiturage.innerHTML = `
    <p><strong>Covoiturage fumeur :</strong> ${
		covoiturageData.fumeur || "-"
	}</p>
    <p><strong>Animaux acceptés :</strong> ${covoiturageData.animaux || "-"}</p>
  `;
}

// Gestion de la soumission des formulaires pour stocker les données dans le localStorage
// et mettre à jour l'affichage

// Informations Personnelles
document.getElementById("formInfo").addEventListener("submit", function (e) {
	e.preventDefault();
	const infoPerso = {
		nom: document.getElementById("nom").value,
		prenom: document.getElementById("prenom").value,
		email: document.getElementById("email").value,
	};
	localStorage.setItem("infoPerso", JSON.stringify(infoPerso));
	updateDisplay();
});

document
	.getElementById("formVehicule")
	.addEventListener("submit", function (e) {
		e.preventDefault();
		const vehicule = {
			idVehicule: document.getElementById("idVehicule").value,
			idMarque: document.getElementById("idMarque").value,
			nomMarque: document.getElementById("nomMarque").value,
			modele: document.getElementById("modele").value,
			immatriculation: document.getElementById("immatriculation").value,
			couleur: document.getElementById("couleur").value,
			energie: document.getElementById("energie").value,
		};
		localStorage.setItem("vehicule", JSON.stringify(vehicule));
		updateDisplay();
	});

document
	.getElementById("formCovoiturage")
	.addEventListener("submit", function (e) {
		e.preventDefault();
		const covoiturage = {
			fumeur: document.getElementById("fumeur").value,
			animaux: document.getElementById("animaux").value,
		};
		localStorage.setItem("covoiturage", JSON.stringify(covoiturage));
		updateDisplay();
	});

// Mise à jour de l'affichage au chargement de la page
document.addEventListener("DOMContentLoaded", updateDisplay); */
