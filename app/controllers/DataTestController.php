<?php
// Fake user
$user = [
  'pseudo' => 'JohnDoe42',
  'email' => 'john.doe@example.com',
  'nom' => 'Doe',
  'prenom' => 'John',
  'mot de passe' => '*******',
  'credits' => '100',
  'photo' => '/public/assets/mowgli-personnage-livre-jungle-10.jpg'
];

//fake parametres
$parametre = [
  'langue' => 'Français',
  'notifications' => 'activé'
];
// Fake véhicule
$vehicule = [
  'marque' => 'Peugeot',
  'modele' => '208',
  'immatriculation' => 'AB-123-CD',
  'couleur' => 'Rouge',
  'energie' => 'Essence'
];

// Fake covoiturage
$covoiturage = [
  [
    'id_covoiturage' => '231',
    'adresse_depart' => '123 Rue A',
    'adresse_arrivee' => '456 Rue B',
    'date_depart' => '2025-05-01',
    'prix_personne' => '10.00',
    'places' => 3
  ],
  [
    'id_covoiturage' => '231',
    'adresse_depart' => '123 Rue A, Marseille',
    'adresse_arrivee' => '456 Rue B, Aix-en-Provence',
    'date_depart' => '2025-05-21 08:30:00',
    'prix_personne' => '10.00',
    'places' => 3
  ],
  [
    'id_covoiturage' => '232',
    'adresse_depart' => '10 Boulevard National, Lyon',
    'adresse_arrivee' => '22 Rue des Alpes, Grenoble',
    'date_depart' => '2025-05-22 07:15:00',
    'prix_personne' => '12.50',
    'places' => 2
  ],
  [
    'id_covoiturage' => '233',
    'adresse_depart' => 'Place Bellecour, Lyon',
    'adresse_arrivee' => 'Gare de Valence TGV',
    'date_depart' => '2025-05-23 09:45:00',
    'prix_personne' => '8.00',
    'places' => 4
  ],
  [
    'id_covoiturage' => '234',
    'adresse_depart' => '1 Rue de la République, Avignon',
    'adresse_arrivee' => 'Parc du Mercantour, Nice',
    'date_depart' => '2025-05-24 06:00:00',
    'prix_personne' => '15.00',
    'places' => 1
  ]
];

$covoiturageAnnule = [
  'id_covoiturage' => '453',
  'adresse_depart' => '987 Rue M',
  'adresse_arrivee' => '765 Rue V',
  'date_depart' => '2025-03-09',
  'prix_personne' => '15.00',
  'places' => 2
];



//ajout de data teste a mettre apres dans un fichier de logique au propre
// Ajout de données test pour éviter que les variables soient undefined
if (!isset($departAdresses)) {
  $departAdresses = [
    ['id' => 1, 'nom' => 'Paris'],
    ['id' => 2, 'nom' => 'Lyon'],
    ['id' => 3, 'nom' => 'Marseille']
  ];
}
if (!isset($arriveeAdresses)) {
  $arriveeAdresses = [
    ['id' => 1, 'nom' => 'Nice'],
    ['id' => 2, 'nom' => 'Bordeaux'],
    ['id' => 3, 'nom' => 'Lille']
  ];
}
if (!isset($datesDepart)) {
  $datesDepart = [
    '2025-05-01 08:00',
    '2025-05-02 10:00',
    '2025-05-03 14:00'
  ];
}
if (!isset($prixMax)) {
  $prixMax = [10, 20, 30];
}
if (!isset($places)) {
  $places = [1, 2, 3, 4];
}
