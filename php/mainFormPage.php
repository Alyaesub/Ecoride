<main class="content" id="home">
    <div class="title">
        <h1>Formulaire de Covoiturage</h1>
    </div>
    <form id="addCovoiturageForm" action="saveCodeTest\traitement.php" method="post">

        <label for="conducteur_id">ID Conducteur :</label>
        <input type="number" id="conducteur_id" name="conducteur_id" required><br>

        <label for="vehicule_id">ID Vehicule :</label>
        <input type="number" id="vehicule_id" name="vehicule_id" required><br>

        <label for="adresse_depart">Adresse de départ :</label>
        <input type="text" id="adresse_depart" name="adresse_depart" required><br>

        <label for="adresse_arrivee">Adresse d'arrivée :</label>
        <input type="text" id="adresse_arrivee" name="adresse_arrivee" required><br>

        <label for="date_depart">Date et heure de départ :</label>
        <input type="datetime-local" id="date_depart" name="date_depart" required><br>

        <label for="date_arrivee">Date et heure d'arrivée :</label>
        <input type="datetime-local" id="date_arrivee" name="date_arrivee" required><br>

        <label for="prix">Prix :</label>
        <input type="number" id="prix" name="prix" required><br>

        <label for="places_disponibles">Places disponibles :</label>
        <input type="number" id="places_disponibles" name="places_disponibles" required><br>

        <label for="est_ecologique">Trajet écologique ? :</label>
        <input type="checkbox" id="est_ecologique" name="est_ecologique" required><br>

        <button type="submit">Ajouter</button>
    </form>
</main>