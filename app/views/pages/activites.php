<?php $title = 'Historique de vos activités'; ?>

<section class="activite-section">
  <h1>Historique de vos covoiturages</h1>

  <div class="historique-covoiturages">
    <h2>Vos trajets passés</h2>
    <p>Aucun trajet pour le moment.</p>
    <section class="envoyer-avis">
      <h2>Laisser nous votre avis sur vos experiences</h2>
      <form method="POST" action="">
        <div class="form-group">
          <label for="note">Note (1 à 5) :</label>
          <select name="note" id="note" class="form-control" required>
            <option value="">-- Choisissez une note --</option>
            <option value="1">1 - Mauvais</option>
            <option value="2">2</option>
            <option value="3">3 - Moyen</option>
            <option value="4">4</option>
            <option value="5">5 - Excellent</option>
          </select>
        </div>
        <div class="form-group">
          <label for="commentaire">Commentaire :</label>
          <textarea name="commentaire" id="commentaire" class="form-control" placeholder="Votre avis en quelques mots..." required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Envoyer l'avis</button>
      </form>
    </section>
    <!-- À remplacer plus tard par une boucle PHP qui liste les trajets -->
  </div>

  <div class="contacts-covoiturages">
    <h2>Contacts établis via EcoRide</h2>
    <p>Aucun contact pour le moment.</p>
    <!-- À remplacer plus tard par une liste de contacts ou messages -->
  </div>
</section>