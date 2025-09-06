console.log("test");

document.addEventListener("DOMContentLoaded", () => {
	// Vérif email avec regex simple
	const isValidEmail = (email) => /\S+@\S+\.\S+/.test(email);

	// Validation Register
	const registerForm = document.getElementById("registerForm");
	if (registerForm) {
		registerForm.addEventListener("submit", (e) => {
			const pseudo = registerForm
				.querySelector("input[name='pseudo']")
				.value.trim();
			const email = registerForm
				.querySelector("input[name='email']")
				.value.trim();
			const pass = registerForm.querySelector(
				"input[name='mot_de_passe']"
			).value;
			const confirm = registerForm.querySelector(
				"input[name='motdepasse_confirm']"
			).value;

			if (!pseudo) {
				e.preventDefault();
				alert("Le pseudo est obligatoire.");
			} else if (!isValidEmail(email)) {
				e.preventDefault();
				alert("L'email n'est pas valide.");
			} else if (pass !== confirm) {
				e.preventDefault();
				alert("Les mots de passe ne correspondent pas.");
			}
		});
	}

	// Validation Login
	const loginForm = document.getElementById("formLogin");
	if (loginForm) {
		loginForm.addEventListener("submit", (e) => {
			const email = loginForm
				.querySelector("input[name='email']")
				.value.trim();
			const password = loginForm.querySelector(
				"input[name='password']"
			).value;

			if (!isValidEmail(email)) {
				e.preventDefault();
				alert("L'adresse email est invalide.");
			} else if (!password) {
				e.preventDefault();
				alert("Le mot de passe est obligatoire.");
			}
		});
	}

	// Validation Update User
	const updateForm = document.getElementById("formUpdate");
	if (updateForm) {
		updateForm.addEventListener("submit", (e) => {
			const email = updateForm
				.querySelector("input[name='email']")
				.value.trim();
			const pass = updateForm.querySelector(
				"input[name='motdepasse']"
			).value;
			const confirm = updateForm.querySelector(
				"input[name='motdepasse_confirm']"
			).value;

			if (!isValidEmail(email)) {
				e.preventDefault();
				alert("L'email est invalide.");
			} else if (pass !== confirm) {
				e.preventDefault();
				alert("Les mots de passe ne correspondent pas.");
			}
		});
	}

	// Validation Covoiturage
	const covoitForm = document.getElementById("formCovoiturage");
	if (covoitForm) {
		covoitForm.addEventListener("submit", (e) => {
			const depart = covoitForm
				.querySelector("input[name='adresse_depart']")
				.value.trim();
			const arrivee = covoitForm
				.querySelector("input[name='adresse_arrivee']")
				.value.trim();
			const date = covoitForm.querySelector(
				"input[name='date_depart']"
			).value;
			const places = parseInt(
				covoitForm.querySelector("input[name='places_disponibles']")
					.value
			);

			if (!depart || !arrivee) {
				e.preventDefault();
				alert("Les adresses de départ et d'arrivée sont obligatoires.");
			} else if (!date) {
				e.preventDefault();
				alert("Veuillez entrer une date de départ.");
			} else if (isNaN(places) || places <= 0) {
				e.preventDefault();
				alert("Le nombre de places doit être supérieur à 0.");
			}
		});
	}
});
