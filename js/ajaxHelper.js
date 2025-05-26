//fonction qui permet de rentre asynchrone mes formulaire
//a integrés dans mes controllers plus tard une fois les logique fini
function handleAjaxForm(formId, resultTargetId) {
	const form = document.getElementById(formId);
	form.addEventListener("submit", async function (e) {
		e.preventDefault();
		const formData = new FormData(form);
		const response = await fetch(form.action, {
			method: "POST",
			body: formData,
		});
		const result = await response.json();

		const zone = document.getElementById(resultTargetId);
		zone.innerHTML = result.success
			? `<div class="alert alert-success">${result.success}</div>`
			: `<div class="alert alert-danger">${result.error}</div>`;
	});
}
// appeler la fonction
handleAjaxForm("formInfo", "updateMessage");

/* L’inscription (registerUser, registerEmploye)
• La connexion (login)
• La mise à jour du profil
• Le formulaire de recherche de covoiturages
• Les validations d’avis, trajets à problèmes côté employé/admin
• L’ajout de trajets (covoiturage)
• Et même les commentaires ou votes plus tard */
