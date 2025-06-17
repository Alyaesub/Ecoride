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
(17, 12, 'Serie 1', 'AA-101-AA', 'Gris foncé', 'diesel'),
(18, 13, 'Classe A', 'BB-202-BB', 'Noir', 'essence'),
(19, 14, 'Focus', 'CC-303-CC', 'Rouge', 'essence'),
(20, 15, 'Corsa', 'DD-404-DD', 'Blanc', 'electrique'),
(21, 16, 'i30', 'EE-505-EE', 'Bleu', 'hybride');

#9 création d'utilisateur
INSERT INTO utilisateur (pseudo, nom, prenom, email, mot_de_passe, id_role, credits)
VALUES
('user12', 'Durand', 'Lucas', 'user12@mail.com', 'asher password123', 3, 20),
('user13', 'Moreau', 'Emma', 'user13@mail.com', 'asher password123', 3, 20),
('user14', 'Martin', 'Hugo', 'user14@mail.com', 'asher password123', 3, 20),
('user15', 'Lemoine', 'Léa', 'user15@mail.com', 'asher password123', 3, 20),
('user16', 'Petit', 'Max', 'user16@mail.com', 'asher password123', 3, 20);
('user17', 'Garcia', 'Camille', 'user17@mail.com', 'asher password123', 3, 20),
('user18', 'Leroux', 'Noah', 'user18@mail.com', 'asher password123', 3, 20),
('user19', 'Schmitt', 'Chloé', 'user19@mail.com', 'asher password123', 3, 20),
('user20', 'Bernard', 'Lilian', 'user20@mail.com', 'asher password123', 3, 20),
('user21', 'Rousseau', 'Inès', 'user21@mail.com', 'asher password123', 3, 20);

#10 création de covoit
INSERT INTO covoiturage (
  id_utilisateur, id_vehicule, adresse_depart, adresse_arrivee,
  date_depart, date_arrivee, prix_personne, places_disponibles,
  est_ecologique, animaux_autorises, fumeur, statut
)
VALUES
(1, 6, 'Arles', 'Marseille', '2025-08-15 08:00:00', '2025-08-15 10:00:00', 5.00, 3, 0, 1, 0, 'actif'),
(4, 8, 'Nîmes', 'Montpellier', '2025-09-03 09:30:00', '2025-09-03 11:00:00', 4.50, 2, 1, 0, 0, 'actif'),
(5, 9, 'Avignon', 'Orange', '2025-09-10 07:00:00', '2025-09-10 07:45:00', 3.00, 4, 0, 1, 0, 'actif'),
(6, 10, 'Aix-en-Provence', 'Nice', '2025-09-20 06:00:00', '2025-09-20 09:00:00', 8.00, 2, 1, 0, 0, 'actif'),
(7, 11, 'Salon-de-Provence', 'Toulon', '2025-09-28 10:00:00', '2025-09-28 12:30:00', 6.00, 3, 0, 1, 0, 'actif'),
(8, 12, 'Arles', 'Valence', '2025-10-05 08:15:00', '2025-10-05 11:45:00', 7.50, 1, 1, 0, 0, 'actif'),
(12, 13, 'Marseille', 'Gap', '2025-10-14 09:00:00', '2025-10-14 12:30:00', 6.50, 2, 1, 0, 0, 'actif'),
(17, 14, 'Toulouse', 'Bordeaux', '2025-10-21 09:00:00', '2025-10-21 12:00:00', 10.00, 2, 1, 0, 0, 'actif'),
(18, 15, 'Lyon', 'Grenoble', '2025-11-01 08:30:00', '2025-11-01 10:00:00', 6.00, 3, 0, 1, 0, 'actif'),
(19, 16, 'Nice', 'Cannes', '2025-11-09 14:00:00', '2025-11-09 15:00:00', 4.00, 2, 1, 0, 0, 'actif'),
(16, 19, 'Paris', 'Orléans', '2025-11-18 07:00:00', '2025-11-18 09:30:00', 12.00, 1, 0, 0, 0, 'actif'),
(6, 10, 'Montpellier', 'Narbonne', '2025-11-23 09:15:00', '2025-11-23 11:30:00', 5.50, 2, 0, 0, 0, 'actif'),
(1, 7, 'Avignon', 'Valence', '2025-12-01 08:45:00', '2025-12-01 10:45:00', 6.50, 3, 1, 0, 0, 'actif'),
(4, 8, 'Toulon', 'Marseille', '2025-12-08 07:00:00', '2025-12-08 08:30:00', 4.00, 2, 1, 1, 0, 'actif'),
(20, 17, 'Bayonne', 'Pau', '2025-12-12 10:00:00', '2025-12-12 11:30:00', 5.00, 3, 1, 0, 0, 'actif'),
(21, 18, 'Limoges', 'Poitiers', '2025-12-15 09:30:00', '2025-12-15 11:00:00', 6.00, 2, 1, 1, 0, 'actif'),
(23, 20, 'Reims', 'Troyes', '2025-12-18 14:00:00', '2025-12-18 15:30:00', 5.50, 4, 0, 0, 0, 'actif'),
(12, 13, 'Chambéry', 'Annecy', '2025-12-20 16:00:00', '2025-12-20 17:00:00', 4.50, 3, 1, 0, 0, 'actif'),
(19, 16, 'Saint-Étienne', 'Lyon', '2025-12-22 08:00:00', '2025-12-22 09:15:00', 3.50, 2, 1, 0, 0, 'actif'),
(6, 10, 'Brest', 'Quimper', '2025-12-24 07:00:00', '2025-12-24 08:30:00', 5.00, 2, 0, 0, 0, 'actif');

#11 création des user_covoit
INSERT INTO user_covoiturage (id_utilisateur, id_covoiturage, role_utilisateur)
VALUES
(1, 11, 'conducteur'),
(4, 12, 'conducteur'),
(5, 13, 'conducteur'),
(6, 14, 'conducteur'),
(7, 15, 'conducteur'),
(8, 16, 'conducteur'),
(12, 17, 'conducteur'),
(17, 25, 'conducteur'),
(18, 26, 'conducteur'),
(19, 27, 'conducteur'),
(20, 28, 'conducteur'),
(21, 29, 'conducteur');

#12 création de passager
INSERT INTO user_covoiturage (id_utilisateur, id_covoiturage, role_utilisateur)
VALUES
(12, 10, 'passager'),
(13, 12, 'passager'), 
(14, 13, 'passager'), 
(15, 14, 'passager'), 
(16, 15, 'passager'),
(14, 11, 'passager'),
(15, 11, 'passager'),
(17, 12, 'passager'),
(16, 13, 'passager'),
(19, 13, 'passager'),
(20, 14, 'passager'),
(5, 15, 'passager'),
(6, 16, 'passager'),
(21, 16, 'passager'),
(18, 17, 'passager'),
(22, 20, 'passager'),
(4, 21, 'passager'),
(13, 22, 'passager'),
(12, 23, 'passager'),
(1, 24, 'passager'),
(7, 25, 'passager'),
(8, 26, 'passager'),
(15, 27, 'passager'),
(13, 28, 'passager'),
(17, 29, 'passager'),
(19, 30, 'passager'),
(21, 31, 'passager'),
(18, 32, 'passager'),
(20, 33, 'passager'),
(22, 34, 'passager'),
(16, 35, 'passager');

#13 création de marques
INSERT INTO marque (id_marque, nom_marque) VALUES
(12, 'BMW'),
(13, 'Mercedes-Benz'),
(14, 'Ford'),
(15, 'Opel'),
(16, 'Hyundai'),
(17, 'Kia'),
(18, 'Mazda'),
(19, 'Nissan'),
(20, 'Mitsubishi'),
(21, 'Alfa Romeo'),
(22, 'Volvo'),
(23, 'Honda'),
(24, 'Suzuki'),
(25, 'Jeep');

