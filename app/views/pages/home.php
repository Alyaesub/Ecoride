<!-- page de la vue de la page d'accueil -->
<?php
$title = 'Accueil';
?>
<section class="title-search">
  <div class="title">
    <h1>Bienvenue sur EcoRide</h1>
    <p>Trouvez votre covoiturage en toute simplicité.</p>
  </div>
</section>
<!--Section de la seach-bar-->
<section class="search-bar-section">
  <div class="search-bar">
    <input type="text" placeholder="Rechercher..." id="searchInput">
    <button type="submit">🔍</button>
  </div>
</section>
<!--Section general des pubs et de la section covoit-->
<section class="section-photo-covoit carousel">
  <a href="<?= route('covoitVoyage') ?>">
    <div class="carousel-item link-covoit " id="link-covoit">
      <p>envie de voyager ? GO!!</p>
    </div>
  </a>
  <div class=" photo-1 carousel-item">photo 1</div>
  <div class=" photo-2 carousel-item">photo 2</div>
  <div class=" photo-3 carousel-item">photo 3</div>
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
    <p>par e-mail : www.ecoride.com</p>
    <p>par téléphone : 01 23 45 67 89</p>
    <p>adresse : 123 Rue de l'Écologie, 75000 Paris, France</p>
  </section>
  <section class="social-media-mobile caroussel-item">
    <h3>Suivez-nous sur les réseaux sociaux</h3>
    <a href="https://www.facebook.com/EcoRide" target="_blank">Facebook</a>
    <a href="https://www.twitter.com/EcoRide" target="_blank">Twitter</a>
    <a href="https://www.instagram.com/EcoRide" target="_blank">Instagram</a>
    <a href="https://www.linkedin.com/company/EcoRide" target="_blank">LinkedIn</a>
  </section>
</section>