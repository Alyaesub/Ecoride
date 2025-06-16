function verifierFormulaire() {
	const note = document.getElementById("note").value;
	const commentaire = document.getElementById("commentaire").value.trim();

	if (!note && commentaire) {
		alert("Tu dois d'abord mettre une note avant de commenter !");
		return false;
	}

	return true;
}
//function pour le changement du bouton démarré
document.addEventListener("DOMContentLoaded", function () {
	const btn = document.getElementById("btnTerminer");
	if (!btn) return;

	const statut = btn.dataset.statut;
	const isAuthor = btn.dataset.isAuthor === "1"; // tu dois passer cette info en data-attr

	// Si le covoit est déjà terminé
	if (statut === "termine") {
		if (!isAuthor) {
			btn.textContent = "✅ Confirmer la fin du trajet";
		} else {
			btn.textContent = "Covoiturage déjà terminé ✅";
			btn.disabled = true;
		}
		return;
	}

	// Si l'utilisateur est le chauffeur et que le covoit n'est pas terminé
	if (isAuthor && statut === "actif") {
		btn.textContent = "🟢 Démarrer / Terminer";
		btn.disabled = false;
	} else {
		// Passager, et trajet pas encore terminé
		btn.textContent = "🚗 En attente de fin de trajet";
		btn.disabled = true;
	}
});
