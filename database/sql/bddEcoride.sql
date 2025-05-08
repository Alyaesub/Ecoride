CREATE DATABASE ecoride;


/* -- Table CONFIGURATION
CREATE TABLE configuration (
    id_configuration INT AUTO_INCREMENT PRIMARY KEY
) ENGINE=InnoDB; */

-- Table PARAMETRE
CREATE TABLE parametre (
    id_parametre INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    propriete VARCHAR(50) NOT NULL,
    valeur VARCHAR(50),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

--  Table ROLE
CREATE TABLE role (
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(30) NOT NULL
) ENGINE=InnoDB;
INSERT INTO role (libelle) VALUES
('administrateur'),
('employe'),
('utilisateur');

-- Création de la table Utilisateurs
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

--  Table MARQUE
CREATE TABLE marque (
    id_marque INT AUTO_INCREMENT PRIMARY KEY,
    nom_marque VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

-- Création de la table Véhicules
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
) ENGINE=InnoDB;


    -- Création de la table Covoiturages
    CREATE TABLE covoiturage (
    id_covoiturage INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    id_vehicule INT NOT NULL,
    adresse_depart VARCHAR (255) NOT NULL,
    adresse_arrivee VARCHAR (255) NOT NULL,
    date_depart DATETIME NOT NULL,
    heure_depart TIME,
    date_arrivee DATETIME NOT NULL,
    heure_arrive TIME,
    prix_personne DECIMAL (10, 2) NOT NULL,
    places_disponibles INT NOT NULL,
    est_ecologique BOOLEAN DEFAULT FALSE,
    animaux_autoriser BOOLEAN DEFAULT FALSE,
    fumeur BOOLEAN DEFAULT FALSE,
    est_annule BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur),
    FOREIGN KEY (id_vehicule) REFERENCES vehicule(id_vehicule),
    CONSTRAINT chk_places CHECK (places_disponibles >= 0),
    CONSTRAINT chk_prix CHECK (prix_personne >= 0)
) ENGINE=InnoDB;

-- Table de liaison UTILISATEUR_COVOITURAGE (relation Many-to-Many "participe")
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

-- Création de la table Avis 
    CREATE TABLE avis(
    id_avis INT AUTO_INCREMENT PRIMARY KEY,
    id_covoiturage INT NOT NULL,
    id_utilisateur INT NOT NULL,
    note INT CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    statut VARCHAR(30),
    FOREIGN KEY (id_covoiturage) REFERENCES covoiturage (id_covoiturage),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur)
) ENGINE=InnoDB;

--Relations entre les tables :

-- Utilisateurs → Covoiturages : Un utilisateur (conducteur) peut proposer plusieurs covoiturages.
-- Utilisateurs → Vehicules : Un utilisateur peut posséder plusieurs véhicules.
-- Covoiturages → Vehicules : Un covoiturage est associé à un véhicule.
-- Covoiturages → Avis : Un covoiturage peut recevoir plusieurs avis.
-- Utilisateurs → Avis : Un utilisateur peut laisser plusieurs avis.