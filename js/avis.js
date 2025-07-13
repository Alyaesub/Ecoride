// Avis.js : Chargement et affichage des avis depuis le fichier JSON
/* document.addEventListener("DOMContentLoaded", function () {
	const idUser =
		""; */ /* récupère ici l'id de l'utilisateur connecté, par exemple depuis une variable globale ou un data-attribute */
/* const listeAvis = document.getElementById("listeAvis");

	fetch("/database/nosql/avis.json")
		.then((response) => response.json())
		.then((data) => { */
// Filtrer les avis correspondant à l'utilisateur
/* 	const avisUser = data.filter((avis) => avis.idUser == idUser);
			if (avisUser.length > 0) {
				avisUser.forEach((avis) => {
					const li = document.createElement("li");
					li.innerHTML = `Vous avez mis une note de <strong>${avis.note}/5</strong>
                          avec le commentaire : "${avis.commentaire}"
                          <small>(${avis.date})</small>`;
					listeAvis.appendChild(li);
				});
			} else {
				listeAvis.innerHTML = "<li>Aucun avis pour le moment.</li>";
			}
		})
		.catch((error) => {
			console.error("Erreur lors du chargement des avis:", error);
			listeAvis.innerHTML =
				"<li>Erreur lors du chargement des avis.</li>";
		});
}); */
