<?php $title = 'Formulaire de covoiturage';
require "../Ecoride/app/Controllers/DataTestController.php"
?>


<div class="voyage-page-container">
  <!--  <div class="title">
    <h1>Formulaire de recherche de Covoiturage</h1>
  </div> -->
  <section class="formulaire">
    <section class="search-covoit ">
      <h1>trouver un covoiturage</h1>
      <form id="searchCovoiturageForm" action="/app/Controllers/Traitement.php" method="get">
        <label for="adresse_depart">Adresse de départ :</label>
        <select id="adresse_depart" name="adresse_depart" required>
          <option value="">Sélectionnez une adresse de départ</option>
          <?php foreach ($departAdresses as $adresse): ?>
            <option value="<?= $adresse['id'] ?>"><?= $adresse['nom'] ?></option>
          <?php endforeach; ?>
        </select><br>

        <label for="adresse_arrivee">Adresse d'arrivée :</label>
        <select id="adresse_arrivee" name="adresse_arrivee" required>
          <option value="">Sélectionnez une adresse d'arrivée</option>
          <?php foreach ($arriveeAdresses as $adresse): ?>
            <option value="<?= $adresse['id'] ?>"><?= $adresse['nom'] ?></option>
          <?php endforeach; ?>
        </select><br>

        <label for="date_depart">Date et heure de départ :</label>
        <select id="date_depart" name="date_depart" required>
          <option value="">Sélectionnez date et heure</option>
          <?php foreach ($datesDepart as $date): ?>
            <option value="<?= $date ?>"><?= $date ?></option>
          <?php endforeach; ?>
        </select><br>

        <label for="prix_max">Prix maximum :</label>
        <select id="prix_max" name="prix_max">
          <option value="">Sélectionnez un prix maximum</option>
          <?php foreach ($prixMax as $prix): ?>
            <option value="<?= $prix ?>"><?= $prix ?> crédits</option>
          <?php endforeach; ?>
        </select><br>

        <label for="places_disponibles">Places disponibles :</label>
        <select id="places_disponibles" name="places_disponibles">
          <option value="">Sélectionnez le nombre de places</option>
          <?php foreach ($places as $place): ?>
            <option value="<?= $place ?>"><?= $place ?></option>
          <?php endforeach; ?>
        </select><br>

        <label for="est_ecologique">Trajet écologique ? :</label>
        <select id="est_ecologique" name="est_ecologique">
          <option value="">Sélectionnez</option>
          <option value="1">Oui</option>
          <option value="0">Non</option>
        </select><br>

        <button type="submit">Afficher les covoiturage</button> <!-- affiche les covoit si user est log sinon redirection form register -->
      </form>
      <div id="displayInfo" class="display-box">
        <!-- Affichage des informations personnelles enregistrées -->
      </div>
    </section>
  </section>
  <section class="description-photo">
    <div class="description-page-voyage">
      <p>
        EcoRide se présente comme la solution idéale pour dénicher des trajets en covoiturage.<br>
        Que vous soyez au volant ou en quête d’un voyage confortable, nous facilitons et optimisont vos déplacements.<br>
        Veuillez vous connecter pour valider votre recherche ou rejoigner des millier d'utilisateur en créant un compte. <br>
        et partagons la route ensemble.
      </p>
    </div>
    <div class="photo-page-voyage">
      <img class="photo-voyage" src="/public/assets/pexels-cottonbro-5329298.webp" alt="photo-voiture">
    </div>
  </section>