//fonction qui permet de rentre asynchrone mes formulaire
function handleAjaxForm(formId, resultTargetId) {
	const form = document.getElementById(formId);
	form.addEventListener("submit", async function (e) {
		e.preventDefault();
		const formData = new FormData(form);
		const response = await fetch(form.action, {
			method: "POST",
			body: formData,
			headers: {
				"X-Requested-With": "XMLHttpRequest",
			},
		});
		const result = await response.json();

		const zone = document.getElementById(resultTargetId);
		zone.innerHTML = result.success
			? `<div class="alert alert-success">${result.success}</div>`
			: `<div class="alert alert-danger">${result.error}</div>`;

		if (result.success) {
			zone.innerHTML = `<div class="alert alert-success">${result.success}</div>`;

			setTimeout(() => {
				if (result.role === 1) {
					window.location.href = "/dashboardAdmin";
				} else if (result.role === 2) {
					window.location.href = "/dashboardEmploye";
				} else {
					window.location.href = "/profil";
				}
			}, 1000);
		}
	});
}
// appeler la fonction
handleAjaxForm("formLogin", "loginResult");
