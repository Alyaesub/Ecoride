const carousel = document.querySelector(".carousel");
const prevBtn = document.querySelector(".carousel-control.prev");
const nextBtn = document.querySelector(".carousel-control.next");

if (carousel && prevBtn && nextBtn) {
	const scrollAmount = 300; // ajustable selon largeur des items

	prevBtn.addEventListener("click", () => {
		carousel.scrollBy({ left: -scrollAmount, behavior: "smooth" });
	});

	nextBtn.addEventListener("click", () => {
		carousel.scrollBy({ left: scrollAmount, behavior: "smooth" });
	});
}
