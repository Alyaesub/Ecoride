<h2>Vos commentaires reçus</h2>
<div class="avis-liste">
  <ul id="listeAvis">
    <?php if (!empty($avisReçus)) : ?>
      <?php foreach ($avisReçus as $avis) : ?>
        <li>
          <strong>Commentaire :</strong> <?= htmlspecialchars($avis['commentaire']) ?>
          <br>
          <small>Ajouté le : <?= isset($avis['date']) ? htmlspecialchars($avis['date']) : 'Date inconnue' ?></small>
        </li>
      <?php endforeach; ?>
    <?php else : ?>
      <h2>Commentaires que vous avez laissés</h2>
      <div class="avis-liste">
        <ul>
          <?php if (!empty($avisDonnes)) : ?>
            <?php foreach ($avisDonnes as $avis) : ?>
              <li>
                <strong>Commentaire :</strong> <?= htmlspecialchars($avis['commentaire']) ?>
                <br>
                <small>Ajouté le : <?= htmlspecialchars($avis['date']) ?></small>
              </li>
            <?php endforeach; ?>
          <?php else : ?>
            <li>Vous n’avez encore laissé aucun commentaire.</li>
          <?php endif; ?>
        </ul>
      </div>
      <li>Aucun commentaire enregistré.</li>
    <?php endif; ?>
  </ul>
</div>