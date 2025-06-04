<section class="activite-section">
  <h1>Historique de vos covoiturages</h1>

  <div class="historique-covoiturages">
    <h2>Vos trajets passés</h2>

    <?php if (empty($covoiturages)) : ?>
      <p>Tu n’as pas encore de covoiturage dans ton historique.</p>
    <?php else : ?>
      <?php foreach ($covoiturages as $covoit): ?>
        <div class="covoit-passe-block <?= $covoit['statut'] ?>">
          <div class="infos-trajet">
            <p><strong>Trajet :</strong> <?= htmlspecialchars($covoit['adresse_depart']) ?> → <?= htmlspecialchars($covoit['adresse_arrivee']) ?></p>
            <p><strong>Départ :</strong> <?= htmlspecialchars($covoit['date_depart']) ?></p>
            <p><strong>Arrivée :</strong> <?= htmlspecialchars($covoit['date_arrivee']) ?></p>
            <p class="statut-covoit">Statut : <strong><?= ucfirst($covoit['statut']) ?></strong></p>
            <p><strong>Détails :</strong> <a class="btn-details" href="/detailsCovoit?id=<?= $covoit['id_covoiturage'] ?>">🔍 Voir détails</a></p>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <div class="contacts-covoiturages">
    <h2>Contacts établis via EcoRide</h2>
    <p>Aucun contact pour le moment.</p>
  </div>
</section>