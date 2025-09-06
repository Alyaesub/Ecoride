<section class="title-search">
  <div class="title">
    <h1>Bienvenue sur EcoRide</h1>
    <h2>Trouvez votre covoiturage en toute simplicité.</h2>
  </div>
</section>
<!--Section de la seach-bar-->
<section class="search-bar-section" id="searchBarSection">
  <div class="search-bar">
    <input type="text" placeholder="Rechercher une ville..." id="searchInput">
    <button type="submit" id="searchBtn">🔍</button>
    <div id="results"></div>
  </div>
</section>
<!--Section general des pubs et de la section covoit-->
<section class="section-photo-covoit carousel">
  <a href="<?= route('covoitVoyage') ?>">
    <div class="carousel-item link-covoit " id="link-covoit">
      <p>envie de voyager ? GO!!</p>
    </div>
  </a>
  <div class=" photo-1 carousel-item">
    <img class="photo-1 carousel-item" src="/public/assets/pexels-pripicart-620335 (1).webp" alt="photo-voiture">
  </div>
  <div class=" photo-2 carousel-item">
    <img class="photo-2 carousel-item" src="/public/assets/pexels-amar-31688476.webp" alt="photo-voiture">
  </div>
  <div class=" photo-3 carousel-item">
    <img class="photo-3 carousel-item" src="/public/assets/pexels-rachel-claire-7263902.webp" alt="photo-voiture">
  </div>
  <div class=" description-desktop carousel-item">
    <h2>Pourquoi choisir EcoRide ?</h2>
    <p>EcoRide est la plateforme idéale pour trouver des trajets en covoiturage.<br>
      Que vous soyez conducteur ou passager, nous vous mettons en relation avec d'autres<br>
      utilisateurs pour partager vos trajets et réduire vos coûts de transport.</p>
  </div>
  <!-- Version simplifiée pour mobile -->
  <div class="description-mobile carousel-item">
    <h2>EcoRide en bref</h2>
    <p>Trouvez rapidement votre covoiturage et partagez vos trajets pour économiser.</p>
  </div>
  <section class="contact-mobile caroussel-item">
    </h3>Contactez-nous</h3>
    <p>Pour toute question ou information, n'hésitez pas à nous contacter :</p>
    <p><a class="contactForm" href="<?= route('contactForm') ?>"><strong>Contactez nous par e-mail</strong> </a></p>
    <p>par téléphone : 01 23 45 67 89</p>
    <p>adresse : 123 Rue de l'Écologie, 75000 Paris, France</p>
    <a class="cgv" href="<?= route('mentions') ?>">Mentions légales & CGV</a>
  </section>
  <section class="social-media-mobile caroussel-item">
    <h3>Suivez-nous sur les réseaux sociaux</h3>
    <a href="https://www.facebook.com/EcoRide" target="_blank">Facebook</a>
    <a href="https://www.twitter.com/EcoRide" target="_blank">Twitter</a>
    <a href="https://www.instagram.com/EcoRide" target="_blank">Instagram</a>
    <a href="https://www.linkedin.com/company/EcoRide" target="_blank">LinkedIn</a>
  </section>
</section>
<section id="popular-covoits">
  <h2>🚗 Covoiturages les plus populaires</h2>
  <div class="popular-covoits-container">
    <?php foreach ($covoituragesPopulaires as $covoit) : ?>
      <div class="covoit-card">
        <p><strong>Départ :</strong> <?= htmlspecialchars($covoit['adresse_depart']) ?></p>
        <p><strong>Arrivée :</strong> <?= htmlspecialchars($covoit['adresse_arrivee']) ?></p>
        <p><strong>Date :</strong> <?= date('d/m/Y H:i', strtotime($covoit['date_depart'])) ?></p>
        <p><strong>Prix :</strong> <?= $covoit['prix_personne'] ?> crédits</p>
        <a class="btn-details" href="/detailsCovoit?id=<?= $covoit['id_covoiturage'] ?>">🔍 Voir détails</a>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="popular-covoits-actions">
    <a class="btn-voir-plus" href="<?= route('covoitVoyage') ?>">Trouvez votre covoiturages</a>
  </div>
</section>
<script src="/public/js/searchBar.js"></script>