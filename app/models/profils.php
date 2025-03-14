<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Utilisateur</title>
  <link rel="stylesheet" href="styles\css\main.css">
</head>

<body>
  <div class="profile-container">
    <h1>bienvenue sur votre profil</h1>
  </div>
  <form action="#" method="post">
    <!-- Informations personnelles -->
    <fieldset>
      <legend>Informations personnelles</legend>

      <label for="nom">Nom :</label><br>
      <input type="text" id="nom" name="nom" required><br><br>

      <label for="prenom">Prénom :</label><br>
      <input type="text" id="prenom" name="prenom" required><br><br>

      <label for="email">Adresse email :</label><br>
      <input type="email" id="email" name="email" required><br><br>

      <label for="wallet">Wallet (solde de crédit) :</label><br>
      <input type="number" id="wallet" name="wallet" value="20" readonly><br><br>

      <button type="button" onclick="window.location.href='covoiturage.html'">
        Course (Covoiturage)
      </button>
    </fieldset>

    <br>

    <!-- Gestion des trajets -->
    <fieldset>
      <legend>Gestion des trajets</legend>

      <p>Sélectionnez votre statut :</p>
      <input type="radio" id="chauffeur" name="statut" value="chauffeur" required>
      <label for="chauffeur">Chauffeur</label><br>

      <input type="radio" id="passager" name="statut" value="passager" required>
      <label for="passager">Passager</label><br>

      <input type="radio" id="lesdeux" name="statut" value="lesdeux" required>
      <label for="lesdeux">Passager Chauffeur (les deux)</label><br><br>
    </fieldset>

    <br>

    <!-- Informations pour chauffeur / passager chauffeur -->
    <fieldset>
      <legend>Informations pour Chauffeur / Passager Chauffeur (à remplir si applicable)</legend>

      <label for="plaque">Plaque d’immatriculation :</label><br>
      <input type="text" id="plaque" name="plaque"><br><br>

      <label for="dateImmat">Date de première immatriculation :</label><br>
      <input type="date" id="dateImmat" name="dateImmat"><br><br>

      <label for="modele">Modèle du véhicule :</label><br>
      <input type="text" id="modele" name="modele"><br><br>

      <label for="couleur">Couleur du véhicule :</label><br>
      <input type="text" id="couleur" name="couleur"><br><br>

      <label for="marque">Marque du véhicule :</label><br>
      <input type="text" id="marque" name="marque"><br><br>

      <label for="places">Nombre de places disponibles :</label><br>
      <input type="number" id="places" name="places" min="1"><br><br>

      <p>Préférences :</p>

      <p>Fumeur :</p>
      <input type="radio" id="fumeurOui" name="pref_fumeur" value="oui" required>
      <label for="fumeurOui">Oui</label>
      <input type="radio" id="fumeurNon" name="pref_fumeur" value="non" required>
      <label for="fumeurNon">Non</label><br><br>

      <p>Animaux :</p>
      <input type="radio" id="animalOui" name="pref_animal" value="oui" required>
      <label for="animalOui">Oui</label>
      <input type="radio" id="animalNon" name="pref_animal" value="non" required>
      <label for="animalNon">Non</label><br><br>
    </fieldset>

    <br>
    <button type="submit">Enregistrer</button>
  </form>
</body>
</body>

</html>