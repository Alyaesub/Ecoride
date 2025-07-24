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


//////////////////: non details covoit
<p><strong>Conducteur :</strong> <?= htmlspecialchars($covoiturage['pseudo_conducteur']) ?>
  <?php if (!empty($covoiturage['note_conducteur'])) : ?>
    <span class="note-conducteur">— Moyenne : <?= $covoiturage['note_conducteur'] ?> ⭐</span>
  <?php endif; ?>
</p>






<?php foreach ($employes as $emp): ?>
  <tr>
    <td><?= htmlspecialchars($emp['nom']) ?></td>
    <td><?= htmlspecialchars($emp['prenom']) ?></td>
    <td><?= htmlspecialchars($emp['email']) ?></td>
    <td><?= $emp['actif'] ? 'Actif' : 'Suspendu' ?></td>
    <td>
      <form action="<?= route('toggleEmploye') ?>" method="post">
        <input type="hidden" name="id_utilisateur" value="<?= $emp['id_utilisateur'] ?>">
        <button class="suspend-btn"><?= $emp['actif'] ? 'Suspendre' : 'Réactiver' ?></button>
      </form>
    </td>
  </tr>
<?php endforeach; ?>