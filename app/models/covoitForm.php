<main class="content" id="home">
    <div class="title">
        <h1>Formulaire de Covoiturage</h1>
    </div>
    <section class="formulaire">
        <section class="search-covoit">
            <h2>trouver un covoiturage</h2>
            <form id="searchCovoiturageForm" action="/app\controllers\traitement.php" method="get">
                <label for="adresse_depart">Adresse de départ :</label>
                <input type="text" id="adresse_depart" name="adresse_depart" required><br>

                <label for="adresse_arrivee">Adresse d'arrivée :</label>
                <input type="text" id="adresse_arrivee" name="adresse_arrivee" required><br>

                <label for="date_depart">Date et heure de départ :</label>
                <input type="datetime-local" id="date_depart" name="date_depart" required><br>

                <label for="prix_max">Prix maximum :</label>
                <input type="number" id="prix_max" name="prix_max" step="0.01"><br>

                <label for="places_disponibles">Places disponibles :</label>
                <input type="number" id="places_disponibles" name="places_disponibles"><br>

                <label for="est_ecologique">Trajet écologique ? :</label>
                <input type="checkbox" id="est_ecologique" name="est_ecologique"><br>

                <button type="submit">Rechercher</button>
            </form>
        </section>
        <section class="add-covoit">
            <h2>Ajouter un covoiturage</h2>
            <form id="addCovoiturageForm" action="/app\controllers\traitement.php" method="post">

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
        </section>
    </section>
</main>