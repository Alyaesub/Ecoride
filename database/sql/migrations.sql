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

#6 ajout de la table covoiturage
CREATE TABLE covoiturage (
    id_covoiturage INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    id_vehicule INT NOT NULL,
    adresse_depart VARCHAR (255) NOT NULL,
    adresse_arrivee VARCHAR (255) NOT NULL,
    date_depart DATETIME NOT NULL,
    date_arrivee DATETIME NOT NULL,
    prix_personne DECIMAL (10, 2) NOT NULL,
    places_disponibles INT NOT NULL,
    est_ecologique BOOLEAN DEFAULT FALSE,
    animaux_autorises BOOLEAN DEFAULT FALSE,
    fumeur BOOLEAN DEFAULT FALSE,
    est_annule BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur),
    FOREIGN KEY (id_vehicule) REFERENCES vehicule(id_vehicule),
    CONSTRAINT chk_places CHECK (places_disponibles >= 0),
    CONSTRAINT chk_prix CHECK (prix_personne >= 0)
) ENGINE=InnoDB;

#7 ajout de la table user_covoiturage
CREATE TABLE user_covoiturage (
    id_utilisateur INT NOT NULL,
    id_covoiturage INT NOT NULL,
    role_utilisateur ENUM('conducteur', 'passager') NOT NULL,
    PRIMARY KEY (id_utilisateur, id_covoiturage),
    CONSTRAINT fk_uc_utilisateur
    FOREIGN KEY (id_utilisateur)
    REFERENCES utilisateur(id_utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    CONSTRAINT fk_uc_covoiturage
    FOREIGN KEY (id_covoiturage)
    REFERENCES covoiturage(id_covoiturage)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

#8 ajout de la table notation
CREATE TABLE notation (
    id_notation INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur_cible INT NOT NULL,
    id_utilisateur_auteur INT NOT NULL,
    id_covoiturage INT NOT NULL,
    note TINYINT NOT NULL CHECK (note BETWEEN 1 AND 5),
    date_notation DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(id_utilisateur_auteur, id_covoiturage),
    FOREIGN KEY (id_utilisateur_cible) REFERENCES utilisateur(id_utilisateur),
    FOREIGN KEY (id_utilisateur_auteur) REFERENCES utilisateur(id_utilisateur),
    FOREIGN KEY (id_covoiturage) REFERENCES covoiturage(id_covoiturage)
);ENGINE=InnoDB;

#9 retire la colonne est_annule pour la remplacer par la colonne statut
ALTER TABLE covoiturage DROP COLUMN est_annule;

#10 ajout collone statut pour faciliter la gestion des covoit
ALTER TABLE covoiturage
ADD statut ENUM('actif', 'termine', 'annule') NOT NULL DEFAULT 'actif';



