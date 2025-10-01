document.addEventListener("DOMContentLoaded", function () {
	const form = document.getElementById("searchCovoiturageForm");
	const dureeInput = document.getElementById("duree_max");
	const ecoOnly = document.getElementById("eco_only");

	form.addEventListener("submit", function () {
		setTimeout(() => {
			const dureeMax = parseInt(dureeInput.value);
			const filtrerEco = ecoOnly.checked;

			let aucunResultat = true;

			document.querySelectorAll(".covoit-result").forEach((div) => {
				const duree = parseInt(div.dataset.duree);
				const isEco = div.dataset.eco === "true";

				const valideDuree = isNaN(dureeMax) || duree <= dureeMax;
				const valideEco = !filtrerEco || isEco;

				if (valideDuree && valideEco) {
					div.style.display = "block";
					aucunResultat = false;
				} else {
					div.style.display = "none";
				}
			});

			// Afficher un message s’il n’y a aucun résultat visible
			const displayBox = document.getElementById("displayInfo");
			if (aucunResultat) {
				displayBox.innerHTML += `<p><strong>Aucun covoiturage ne correspond aux filtres.</strong></p>`;
			}
		}, 100);
	});
});
