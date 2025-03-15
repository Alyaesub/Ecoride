CREATE DATABASE ecoride;

-- Table CONFIGURATION
CREATE TABLE configuration (
    id_configuration INT AUTO_INCREMENT PRIMARY KEY
) ENGINE=InnoDB;

-- Table PARAMETRE
CREATE TABLE parametre (
    id_parametre INT AUTO_INCREMENT PRIMARY KEY,
    propriete VARCHAR(50) NOT NULL,
    valeur VARCHAR(50),
    -- Clé étrangère vers CONFIGURATION (relation "dispose")
    id_configuration INT,
    CONSTRAINT fk_parametre_configuration
    FOREIGN KEY (id_configuration)
    REFERENCES configuration(id_configuration)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Création de la table Utilisateurs
CREATE TABLE Utilisateur (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(30),
    prenom VARCHAR(30),
    email VARCHAR (100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR (255) NOT NULL,
    credits INT DEFAULT 20,
    photo VARCHAR(50),
    role ENUM ('utilisateur', 'employe', 'admin') DEFAULT 'utilisateur'
) ENGINE=InnoDB;

-- Création de la table Véhicules
    CREATE TABLE Vehicule (
    id_vehicule INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    id_marque  INT NOT NULL,
    modele VARCHAR (50) NOT NULL,
    immatriculation VARCHAR(30),
    couleur VARCHAR (50) NOT NULL,
    energie ENUM ('essence', 'diesel', 'electrique', 'hybride') NOT NULL,
    CONSTRAINT fk_voiture_utilisateur
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs (id_utilisateur),
    CONSTRAINT fk_voiture_marque
    FOREIGN KEY (id_marque) REFERENCES marque(id_marque)
) ENGINE=InnoDB;

-- 5) Table MARQUE
CREATE TABLE marque (
    id_marque INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(30) NOT NULL
) ENGINE=InnoDB;

    -- Création de la table Covoiturages
    CREATE TABLE Covoiturage (
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
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs (id_utilisateur),
    FOREIGN KEY (id_vehicule) REFERENCES Vehicules(id_vehicule),
    CONSTRAINT chk_places CHECK (places_disponibles >= 0),
    CONSTRAINT chk_prix CHECK (prix >= 0)
) ENGINE=InnoDB;;

-- Table de liaison UTILISATEUR_COVOITURAGE (relation Many-to-Many "participe")
CREATE TABLE utilisateur_covoiturage (
    id_utilisateur INT NOT NULL,
    id_covoiturage INT NOT NULL,
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
    CREATE TABLE Avis(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_covoiturage INT NOT NULL,
    id_utilisateur INT NOT NULL,
    note INT CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    statut VARCHAR(30),
    FOREIGN KEY (id_covoiturage) REFERENCES Covoiturages (id),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs (id)
) ENGINE=InnoDB;

--Relations entre les tables :

-- Utilisateurs → Covoiturages : Un utilisateur (conducteur) peut proposer plusieurs covoiturages.
-- Utilisateurs → Vehicules : Un utilisateur peut posséder plusieurs véhicules.
-- Covoiturages → Vehicules : Un covoiturage est associé à un véhicule.
-- Covoiturages → Avis : Un covoiturage peut recevoir plusieurs avis.
-- Utilisateurs → Avis : Un utilisateur peut laisser plusieurs avis.