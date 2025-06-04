<div class="voyage-page-container">

  <section class="formulaire">
    <section class="search-covoit ">
      <h1>trouver un covoiturage</h1>
      <form id="searchCovoiturageForm" action="<?= route('search-covoit-form') ?>" method="get">
        <label for="adresse_depart">Adresse de départ :</label>
        <select id="adresse_depart" name="adresse_depart" required>
          <option value="">Sélectionnez une adresse de départ</option>
          <?php foreach ($departAdresses as $adresse): ?>
            <option value="<?= htmlspecialchars($adresse['nom']) ?>"><?= htmlspecialchars($adresse['nom']) ?></option>
          <?php endforeach; ?>
        </select><br>

        <label for="adresse_arrivee">Adresse d'arrivée :</label>
        <select id="adresse_arrivee" name="adresse_arrivee" required>
          <option value="">Sélectionnez une adresse d'arrivée</option>
          <?php foreach ($arriveeAdresses as $adresse): ?>
            <option value="<?= htmlspecialchars($adresse['nom']) ?>"><?= htmlspecialchars($adresse['nom']) ?></option>
          <?php endforeach; ?>
        </select><br>

        <label for="date_depart">Date et heure de départ :</label>
        <select id="date_depart" name="date_depart" required>
          <option value="">Sélectionnez date et heure</option>
          <?php foreach ($datesDepart as $date): ?>
            <option value="<?= htmlspecialchars($date) ?>"><?= htmlspecialchars($date) ?></option>
          <?php endforeach; ?>
        </select><br>
        <button type="submit">Afficher les covoiturage</button> <!-- affiche les covoit si user est log sinon redirection form register -->
      </form>
      <div id="displayInfo" class="display-box">
        <!-- Affichage des informations personnelles enregistrées -->
        <h2>Résultats de la recherche</h2>
        <?php if (empty($covoiturages)) : ?>
          <p><strong>Aucun covoiturage trouvé.</strong></p>
        <?php else: ?>
          <?php foreach ($covoiturages as $covoit): ?>
            <div class="covoit-result">
              <p><strong>Départ :</strong> <?= $covoit['adresse_depart'] ?></p>
              <p><strong>Arrivée :</strong> <?= $covoit['adresse_arrivee'] ?></p>
              <p><strong>Date :</strong> <?= $covoit['date_depart'] ?></p>

              <?php if (isset($_SESSION['user'])): ?>
                <a href="/detailsCovoit?id=<?= $covoit['id_covoiturage'] ?>">🔍 Voir détails</a>
              <?php else: ?>
                <a href="<?= route('login') ?>"> Connectez vous pour 🔍 Voir détails</a>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
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