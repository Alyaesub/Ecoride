<!-- À remplacer plus tard par une boucle PHP qui liste les trajets -->
<?php
// Faux covoiturages simulés pour test
$covoiturages = [
  [
    'id_covoiturage' => 1,
    'conducteur_id' => 3,
    'adresse_depart' => 'Arles',
    'adresse_arrivee' => 'Marseille',
    'date_depart' => '2025-05-20 08:00',
    'date_arrivee' => '2025-05-20 10:00',
    'note_donnee' => null
  ],
  [
    'id_covoiturage' => 2,
    'conducteur_id' => 4,
    'adresse_depart' => 'Nîmes',
    'adresse_arrivee' => 'Montpellier',
    'date_depart' => '2025-05-15 07:30',
    'date_arrivee' => '2025-05-15 09:00',
    'note_donnee' => 4
  ]
];
?>

<section class="activite-section">
  <h1>Historique de vos covoiturages</h1>

  <div class="historique-covoiturages">
    <h2>Vos trajets passés</h2>

    <?php foreach ($covoiturages as $covoit): ?>
      <div class="covoit-passe-block">
        <div class="infos-trajet">
          <p><strong>Trajet :</strong> <?= $covoit['adresse_depart'] ?> → <?= $covoit['adresse_arrivee'] ?></p>
          <p><strong>Départ :</strong> <?= $covoit['date_depart'] ?></p>
          <p><strong>Arrivée :</strong> <?= $covoit['date_arrivee'] ?></p>
        </div>

        <?php if ($covoit['note_donnee'] !== null): ?>
          <div class="note-existante">
            <p>✅ Vous avez déjà noté ce trajet : <strong><?= $covoit['note_donnee'] ?>/5</strong></p>
          </div>
        <?php else: ?>
          <section class="envoyer-avis">
            <h3>Noter ce trajet</h3>
            <form method="POST" action="<?= route("ajouter-note") ?>" class="form-note">
              <input type="hidden" name="conducteur_id" value="<?= $covoit['conducteur_id'] ?>">
              <input type="hidden" name="covoiturage_id" value="<?= $covoit['id_covoiturage'] ?>">

              <div class="form-group">
                <label for="note-<?= $covoit['id_covoiturage'] ?>">Note :</label>
                <select name="note" id="note-<?= $covoit['id_covoiturage'] ?>" class="form-control" required>
                  <option value="">-- Choisissez une note --</option>
                  <option value="1">1 - Mauvais</option>
                  <option value="2">2</option>
                  <option value="3">3 - Moyen</option>
                  <option value="4">4</option>
                  <option value="5">5 - Excellent</option>
                </select>
              </div>

              <div class="form-group">
                <label for="commentaire-<?= $covoit['id_covoiturage'] ?>">Commentaire :</label>
                <textarea name="commentaire" id="commentaire-<?= $covoit['id_covoiturage'] ?>" class="form-control" placeholder="Votre avis..."></textarea>
              </div>

              <button type="submit" class="btn btn-success">Envoyer</button>
            </form>
          </section>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="contacts-covoiturages">
    <h2>Contacts établis via EcoRide</h2>
    <p>Aucun contact pour le moment.</p>
  </div>
</section>