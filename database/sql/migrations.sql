/* Ordre de création des tables :
Les tables référencées par des clés étrangères doivent être créées avant celles qui les référencent. 
Dans le script, crée d’abord role puis utilisateur ; et crée d’abord marque puis vehicule. */

#creation de la BDD
CREATE DATABASE ecoride;

#1 creation de la table role
CREATE TABLE role (
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(30) NOT NULL
) ENGINE=InnoDB;

#2 Création de la table Utilisateurs
CREATE TABLE utilisateur (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    pseudo VARCHAR(30) NOT NULL UNIQUE,
    nom VARCHAR(30),
    prenom VARCHAR(30),
    email VARCHAR (100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR (255) NOT NULL,
    credits INT DEFAULT 20,
    photo VARCHAR(50),
    id_role INT,
    CONSTRAINT fk_utilisateur_role
    FOREIGN KEY (id_role) REFERENCES role(id_role)
) ENGINE=InnoDB;

#3 Ajout des 2 colonnes pour les employer
ALTER TABLE utilisateur
    ADD COLUMN poste VARCHAR(50),
    ADD COLUMN numero_badge VARCHAR(20);

#4 ajout de la table marques
CREATE TABLE marque (
    id_marque INT AUTO_INCREMENT PRIMARY KEY,
    nom_marque VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

#5 ajout de la table vehicule
CREATE TABLE vehicule (
    id_vehicule INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    id_marque  INT NOT NULL,
    modele VARCHAR (50) NOT NULL,
    immatriculation VARCHAR(30),
    couleur VARCHAR (50) NOT NULL,
    energie ENUM ('essence', 'diesel', 'electrique', 'hybride') NOT NULL,
    CONSTRAINT fk_voiture_utilisateur
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur),
    CONSTRAINT fk_voiture_marque
    FOREIGN KEY (id_marque) REFERENCES marque(id_marque)
) ENGINE=InnoDB