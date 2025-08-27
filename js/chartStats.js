//code pour les stats des covoit
if (document.getElementById("covoitChart")) {
	const ctx = document.getElementById("covoitChart").getContext("2d");

	new Chart(ctx, {
		type: "bar",
		data: {
			labels: statsLabelsCovoit, // Transmis via PHP
			datasets: [
				{
					label: "Nombre de covoiturages cette semaine",
					data: statsDataCovoit,
					backgroundColor: "rgba(75, 192, 192, 0.6)",
					borderColor: "rgba(75, 192, 192, 1)",
					borderWidth: 1,
				},
			],
		},
		options: {
			scales: {
				y: {
					beginAtZero: true,
					ticks: {
						stepSize: 2,
					},
				},
			},
		},
	});
}

//code pour les stats des credit
if (document.getElementById("creditChart")) {
	const ctx = document.getElementById("creditChart").getContext("2d");

	new Chart(ctx, {
		type: "bar",
		data: {
			labels: statsLabelsCredits,
			datasets: [
				{
					label: "Crédits gagnés cette semaine",
					data: statsDataCredits,
					backgroundColor: "rgba(255, 159, 64, 0.6)",
					borderColor: "rgba(255, 159, 64, 1)",
					borderWidth: 1,
				},
			],
		},
		options: {
			scales: {
				y: {
					beginAtZero: true,
					ticks: {
						stepSize: 5,
					},
				},
			},
		},
	});
}
