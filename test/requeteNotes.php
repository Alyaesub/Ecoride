<?php
//requetes pour ajouter une marque a la table marques

$stmt = $pdo->prepare("INSERT INTO marque (nom_marque) VALUES (?)");
$stmt->execute([$nouvelle_marque]);
$newIdMarque = $pdo->lastInsertId();

  ///////////////////////////////////////////////////
  //insertion covoiturage

  // Étape 1 : Insérer le covoiturage
  /* $stmt = $pdo->prepare("INSERT INTO covoiturage (...) VALUES (...)");
$stmt->execute([...]);
$id_covoiturage = $pdo->lastInsertId() */;

// Étape 2 : Insérer l'utilisateur dans user_covoiturage avec le rôle choisi
$stmt2 = $pdo->prepare("INSERT INTO user_covoiturage (id_utilisateur, id_covoiturage, role_utilisateur) VALUES (?, ?, ?)");
$stmt2->execute([$id_utilisateur, $id_covoiturage, $_POST['role_utilisateur']]);

/////////////////////////////////////////////////
//JS pour l'annulation de covoiturage

/* document.querySelectorAll('.cancel-covoiturage').forEach(button => {
button.addEventListener('click', () => {
const id = button.dataset.id;

fetch('annulerCovoiturage.php', {
method: 'POST',
body: new URLSearchParams({ id_covoiturage: id })
})
.then(response => response.json())
.then(data => {
if (data.success) {
alert("Covoiturage annulé !");
location.reload();
}
});
});
}); */



require 'db.php'; // Connexion PDO

if (!empty($_POST['id_covoiturage'])) {
  $stmt = $pdo->prepare("UPDATE covoiturage SET est_annule = 1 WHERE id_covoiturage = ?");
  $success = $stmt->execute([$_POST['id_covoiturage']]);

  echo json_encode(['success' => $success]);
}


//requet php pour mettre a jour la photo de profil

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
  $nomFichier = basename($_FILES['photo']['name']);
  $cheminDestination = __DIR__ . '/../../public/uploads/' . $nomFichier;

  if (move_uploaded_file($_FILES['photo']['tmp_name'], $cheminDestination)) {
    // Enregistre le nom du fichier dans la BDD
    $stmt = $pdo->prepare("UPDATE utilisateur SET photo = ? WHERE id_utilisateur = ?");
    $stmt->execute([$nomFichier, $_SESSION['user_id']]);
  }
}
