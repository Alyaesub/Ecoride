<?php $title = "Dashboard Employer"; ?>

<section class="main-admin">
  <h1>Dashboard Employé</h1>

  <a class="logout" href="<?= route("logout") ?>">Déconnexion</a>

  <section class="review-validation">
    <h2>Validation des avis</h2>
    <div class="review">
      <p><strong>Chauffeur :</strong> Paul Dupont</p>
      <p><strong>Passager :</strong> Sophie Martin</p>
      <p><strong>Avis :</strong> Super trajet, chauffeur très sympa !</p>
      <button class="validate-btn">Valider</button>
      <button class="reject-btn">Refuser</button>
    </div>
    <div class="review">
      <p><strong>Chauffeur :</strong> Laura Bernard</p>
      <p><strong>Passager :</strong> Marc Lemoine</p>
      <p><strong>Avis :</strong> Chauffeur en retard de 15 minutes.</p>
      <button class="validate-btn">Valider</button>
      <button class="reject-btn">Refuser</button>
    </div>
  </section>

  <section class="problematic-rides">
    <h2>Covoiturages problématiques</h2>
    <table>
      <thead>
        <tr>
          <th>Numéro</th>
          <th>Pseudo Conducteur</th>
          <th>Mail Conducteur</th>
          <th>Pseudo Passager</th>
          <th>Mail Passager</th>
          <th>Descriptif</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>4578</td>
          <td>PaulD</td>
          <td>paul.dupont@mail.com</td>
          <td>SophieM</td>
          <td>sophie.martin@mail.com</td>
          <td>Conflit sur le lieu de dépose.</td>
        </tr>
        <tr>
          <td>4592</td>
          <td>LauraB</td>
          <td>laura.bernard@mail.com</td>
          <td>MarcL</td>
          <td>marc.lemoine@mail.com</td>
          <td>Retard important signalé par le passager.</td>
        </tr>
      </tbody>
    </table>
  </section>
</section>