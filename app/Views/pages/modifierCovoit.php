<h1>Modifier le covoiturage</h1>

<form action="<?= route('validerModifCovoit') ?>" method="post">
  <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCsrfToken()); ?>">

  <label for="adresse_depart">Adresse de départ :</label>
  <input type="text" id="adresse_depart" name="adresse_depart" value="<?= htmlspecialchars($covoiturage['adresse_depart']) ?>" required>

  <label for="adresse_arrivee">Adresse d'arrivée :</label>
  <input type="text" id="adresse_arrivee" name="adresse_arrivee" value="<?= htmlspecialchars($covoiturage['adresse_arrivee']) ?>" required>

  <label for="date_depart">Date de départ :</label>
  <input type="datetime-local" id="date_depart" name="date_depart" value="<?= date('Y-m-d\TH:i', strtotime($covoiturage['date_depart'])) ?>" required>

  <label for="date_arrivee">Date d'arrivée :</label>
  <input type="datetime-local" id="date_arrivee" name="date_arrivee" value="<?= date('Y-m-d\TH:i', strtotime($covoiturage['date_arrivee'])) ?>" required>

  <label for="prix_personne">Prix par personne (crédits) :</label>
  <input type="number" id="prix_personne" name="prix_personne" step="0.01" value="<?= $covoiturage['prix_personne'] ?>" required>

  <label for="places_disponibles">Places disponibles :</label>
  <input type="number" id="places_disponibles" name="places_disponibles" min="0" value="<?= $covoiturage['places_disponibles'] ?>" required>

  <label for="est_ecologique">Est écologique :</label>
  <input type="checkbox" id="est_ecologique" name="est_ecologique" <?= $covoiturage['est_ecologique'] ? 'checked' : '' ?>>

  <label for="animaux_autoriser">Animaux autorisés :</label>
  <input type="checkbox" id="animaux_autoriser" name="animaux_autoriser" <?= $covoiturage['animaux_autorises'] ? 'checked' : '' ?>>

  <label for="fumeur">Fumeur :</label>
  <input type="checkbox" id="fumeur" name="fumeur" <?= $covoiturage['fumeur'] ? 'checked' : '' ?>>

  <button type="submit" class="btn">✅ Sauvegarder</button>
</form>