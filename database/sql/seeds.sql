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