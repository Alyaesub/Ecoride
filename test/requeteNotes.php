<?= route('detail-covoiturage') . '&id=' . $covoiturage['id_covoiturage'] ?>

<td><?= $covoiturage['prix_personne'] ?> crédits</td>
<td><?= $covoiturage['places_disponibles'] ?></td>


// Enregistrer l'avis NoSQL CODE POUR LES AVIS EN NOSQL
/* if (!empty($commentaire)) {
require_once __DIR__ . '/../../MongoDb/avisFunctions.php';
ajouterAvisMongo($id_auteur, $id_conducteur, $id_covoiturage, $commentaire);
} */