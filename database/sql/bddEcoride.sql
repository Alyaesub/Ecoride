CREATE DATABASE ecoride;

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
    date_arrivee DATETIME NOT NULL,
    prix_personne DECIMAL (10, 2) NOT NULL,
    places_disponibles INT NOT NULL,
    est_ecologique BOOLEAN DEFAULT FALSE,
    animaux_autorises BOOLEAN DEFAULT FALSE,
    fumeur BOOLEAN DEFAULT FALSE,
    statut ENUM('actif', 'en_cours' 'termine', 'annule') NOT NULL DEFAULT 'actif',
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
    trajet_termine TINYINT(1) DEFAULT 0,
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

#table pour les notes 
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
);

#table pour géré les transaction
CREATE TABLE transaction (
    id_transaction INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,           -- Celui qui reçoit les crédits (admin ou chauffeur)
    id_covoiturage INT NOT NULL,           -- Le covoit concerné
    id_passager INT NOT NULL,              -- Celui qui paie
    montant INT NOT NULL,                  -- Nombre de crédits transférés
    type ENUM('plateforme', 'chauffeur') NOT NULL,
    statut ENUM('en_attente', 'validée', 'refusée') DEFAULT 'en_attente',
    date_transaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
    FOREIGN KEY (id_passager) REFERENCES utilisateur(id_utilisateur),
    FOREIGN KEY (id_covoiturage) REFERENCES covoiturage(id_covoiturage)
);

-- Création de la table Avis NoSql
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

#collection NoSQl pour les avis
{
  "_id": ObjectId("..."),
  "id_utilisateur_cible": 3,          /* ID du conducteur noté */
  "id_utilisateur_auteur": 5,         /* ID de l'utilisateur qui laisse l'avis */
  "id_covoiturage": 7,                /* Pour faire le lien si besoin */
  "commentaire": "Conducteur très sympa, trajet agréable !",
  "date_avis": "2025-05-24T17:34:00Z",
  "valide": false                     /* Par défaut à false → modéré par un employé */
}


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