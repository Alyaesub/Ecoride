-- Création de la table Utilisateurs
CREATE TABLE Utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    credits INT DEFAULT 20,
    role ENUM('utilisateur', 'employe', 'admin') DEFAULT 'utilisateur'
);

-- Création de la table Covoiturages
CREATE TABLE Covoiturages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conducteur_id INT NOT NULL,
    adresse_depart VARCHAR(255) NOT NULL,
    adresse_arrivee VARCHAR(255) NOT NULL,
    date_depart DATETIME NOT NULL,
    date_arrivee DATETIME NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    places_disponibles INT NOT NULL,
    est_ecologique BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (conducteur_id) REFERENCES Utilisateurs(id)
);

-- Création de la table Véhicules
CREATE TABLE Vehicules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    marque VARCHAR(50) NOT NULL,
    modele VARCHAR(50) NOT NULL,
    couleur VARCHAR(50) NOT NULL,
    energie ENUM('essence', 'diesel', 'electrique', 'hybride') NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(id)
);

-- Création de la table Avis
CREATE TABLE Avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    covoiturage_id INT NOT NULL,
    utilisateur_id INT NOT NULL,
    note INT CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    FOREIGN KEY (covoiturage_id) REFERENCES Covoiturages(id),
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(id)
);