function verifierFormulaire() {
	const note = document.getElementById("note").value;
	const commentaire = document.getElementById("commentaire").value.trim();

	if (!note && commentaire) {
		alert("Tu dois d'abord mettre une note avant de commenter !");
		return false;
	}

	return true;
}
