CREATE DATABASE ecoride;

-- Création de la table Utilisateurs
CREATE TABLE Utilisateurs (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    pseudo VARCHAR (50) NOT NULL,
    email VARCHAR (100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR (255) NOT NULL,
    credits INT DEFAULT 20,
    role ENUM ('utilisateur', 'employe', 'admin') DEFAULT 'utilisateur'
);

    -- Création de la table Covoiturages
    CREATE TABLE Covoiturages (
    id_covoiturage INT AUTO_INCREMENT PRIMARY KEY,
    id_conducteur INT NOT NULL,
    id_vehicule INT NOT NULL,
    adresse_depart VARCHAR (255) NOT NULL,
    adresse_arrivee VARCHAR (255) NOT NULL,
    date_depart DATETIME NOT NULL,
    date_arrivee DATETIME NOT NULL,
    prix DECIMAL (10, 2) NOT NULL,
    places_disponibles INT NOT NULL,
    est_ecologique BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_conducteur) REFERENCES Utilisateurs (id_utilisateur),
    FOREIGN KEY (id_vehicule) REFERENCES Vehicules(id_vehicule),
    CONSTRAINT chk_places CHECK (places_disponibles >= 0),
    CONSTRAINT chk_prix CHECK (prix >= 0)
);

        -- Création de la table Véhicules
    CREATE TABLE Vehicules (
    id_vehicule INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    marque VARCHAR (50) NOT NULL,
    modele VARCHAR (50) NOT NULL,
    couleur VARCHAR (50) NOT NULL,
    energie ENUM ('essence', 'diesel', 'electrique', 'hybride') NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs (id_utilisateur)
);

--             -- Création de la table Avis
--             CREATE TABLE Avis
--             (
--                 id INT
--                 AUTO_INCREMENT PRIMARY KEY,
--     covoiturage_id INT NOT NULL,
--     utilisateur_id INT NOT NULL,
--     note INT CHECK
--                 (note BETWEEN 1 AND 5),
--     commentaire TEXT,
--     FOREIGN KEY
--                 (covoiturage_id) REFERENCES Covoiturages
--                 (id),
--     FOREIGN KEY
--                 (utilisateur_id) REFERENCES Utilisateurs
--                 (id)
-- );

--Relations entre les tables :

-- Utilisateurs → Covoiturages : Un utilisateur (conducteur) peut proposer plusieurs covoiturages.
-- Utilisateurs → Vehicules : Un utilisateur peut posséder plusieurs véhicules.
-- Covoiturages → Vehicules : Un covoiturage est associé à un véhicule.
-- Covoiturages → Avis : Un covoiturage peut recevoir plusieurs avis.
-- Utilisateurs → Avis : Un utilisateur peut laisser plusieurs avis.