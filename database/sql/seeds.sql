/* ici je met les exemples de requetes utilisées pour remplir les tables */

#1 Insert des role via values
INSERT INTO role (libelle) VALUES
('administrateur'),
('employe'),
('utilisateur');

#2 creation du 1er UTILISATEUR
INSERT INTO utilisateur (pseudo, nom, prenom, email, mot_de_passe, id_role)
VALUES ('bob', 'nakamoto', 'bob', 'bob@test.com', '$2y$12$2s50yS7QpCu/4t4EKlsbhuzzTq.RKMu4jk0s4Nn/nJENPq9YdmJai', 3);

#3 creation du 1er ADMINISTRATEUR 
INSERT INTO utilisateur (pseudo, nom, prenom, email, mot_de_passe, id_role)
VALUES ('satoshi', 'nakamoto', 'satoshi', 'satoshiAdmin@test.com', '$2y$12$2s50yS7QpCu/4t4EKlsbhuzzTq.RKMu4jk0s4Nn/nJENPq9YdmJai', 1);

#4 creation du 2em UTILISATEUR
INSERT INTO utilisateur (pseudo, nom, prenom, email, mot_de_passe, id_role)
VALUES ('alice', 'nakamoto', 'alice', 'alice@test.com', '$2y$12$2s50yS7QpCu/4t4EKlsbhuzzTq.RKMu4jk0s4Nn/nJENPq9YdmJai', 3);

#5 creation du 1er EMPLOYER
INSERT INTO utilisateur (pseudo, nom, prenom, email, mot_de_passe, id_role)
VALUES ('hal', 'finney', 'hal', 'hal@test.com', '$2y$12$2s50yS7QpCu/4t4EKlsbhuzzTq.RKMu4jk0s4Nn/nJENPq9YdmJai', 2);

#6 UPDATE de ADMINISTRATEUR SATOSHI
UPDATE `utilisateur` SET `poste` = 'administrateur', `numero_badge` = '10' WHERE `utilisateur`.`id_utilisateur` = 2;

#7 UPDATE de EMPLOYE HAL
UPDATE `utilisateur` SET `poste` = 'moderateur', `numero_badge` = '11' WHERE `utilisateur`.`id_utilisateur` = 3;

#8 crétion de véhicule
INSERT INTO vehicule (id_utilisateur, id_marque, modele, immatriculation, couleur, energie)
VALUES
(1, 4, 'Clio', 'AB-123-CD', 'Bleu', 'essence'),
(4, 3, '208', 'EF-456-GH', 'Rouge', 'diesel'),
(5, 7, 'C3', 'IJ-789-KL', 'Noir', 'essence'),
(6, 8, 'Model 3', 'MN-321-OP', 'Blanc', 'electrique'),
(7, 9, 'Sandero', 'QR-654-ST', 'Gris', 'essence'),
(8, 10, 'Golf', 'UV-987-WX', 'Vert', 'diesel'),
(12, 11, 'Yaris', 'YZ-741-AA', 'Bleu clair', 'hybride');

#9 création d'utilisateur
INSERT INTO utilisateur (pseudo, nom, prenom, email, mot_de_passe, id_role, credits)
VALUES
('user12', 'Durand', 'Lucas', 'user12@mail.com', '$2y$12$2s50yS7QpCu/4t4EKlsbhuzzTq.RKMu4jk0s4Nn/nJENPq9YdmJai', 3, 20),
('user13', 'Moreau', 'Emma', 'user13@mail.com', '$2y$12$2s50yS7QpCu/4t4EKlsbhuzzTq.RKMu4jk0s4Nn/nJENPq9YdmJai', 3, 20),
('user14', 'Martin', 'Hugo', 'user14@mail.com', '$2y$12$2s50yS7QpCu/4t4EKlsbhuzzTq.RKMu4jk0s4Nn/nJENPq9YdmJai', 3, 20),
('user15', 'Lemoine', 'Léa', 'user15@mail.com', '$2y$12$2s50yS7QpCu/4t4EKlsbhuzzTq.RKMu4jk0s4Nn/nJENPq9YdmJai', 3, 20),
('user16', 'Petit', 'Max', 'user16@mail.com', '$2y$12$2s50yS7QpCu/4t4EKlsbhuzzTq.RKMu4jk0s4Nn/nJENPq9YdmJai', 3, 20);

#10 création de covoit
INSERT INTO covoiturage (
  id_utilisateur, id_vehicule, adresse_depart, adresse_arrivee,
  date_depart, date_arrivee, prix_personne, places_disponibles,
  est_ecologique, animaux_autorises, fumeur, est_annule
)
VALUES
(1, 6, 'Arles', 'Marseille', '2025-06-01 08:00:00', '2025-06-01 10:00:00', 5.00, 3, 0, 1, 0, 0),
(4, 8, 'Nîmes', 'Montpellier', '2025-06-02 09:30:00', '2025-06-02 11:00:00', 4.50, 2, 1, 0, 0, 0),
(5, 9, 'Avignon', 'Orange', '2025-06-03 07:00:00', '2025-06-03 07:45:00', 3.00, 4, 0, 1, 0, 0),
(6, 10, 'Aix-en-Provence', 'Nice', '2025-06-04 06:00:00', '2025-06-04 09:00:00', 8.00, 2, 1, 0, 0, 0),
(7, 11, 'Salon-de-Provence', 'Toulon', '2025-06-05 10:00:00', '2025-06-05 12:30:00', 6.00, 3, 0, 1, 0, 0),
(8, 12, 'Arles', 'Valence', '2025-06-06 08:15:00', '2025-06-06 11:45:00', 7.50, 1, 1, 0, 0, 0),
(12, 13, 'Marseille', 'Gap', '2025-06-07 09:00:00', '2025-06-07 12:30:00', 6.50, 2, 1, 0, 1, 0);

#11 création des user_covoit
INSERT INTO user_covoiturage (id_utilisateur, id_covoiturage, role_utilisateur)
VALUES
(1, 11, 'conducteur'),
(4, 12, 'conducteur'),
(5, 13, 'conducteur'),
(6, 14, 'conducteur'),
(7, 15, 'conducteur'),
(8, 16, 'conducteur'),
(12, 17, 'conducteur');

#12 création de passager
INSERT INTO user_covoiturage (id_utilisateur, id_covoiturage, role_utilisateur)
VALUES
(12, 10, 'passager'),
(13, 12, 'passager'), 
(14, 13, 'passager'), 
(15, 14, 'passager'), 
(16, 15, 'passager'); 