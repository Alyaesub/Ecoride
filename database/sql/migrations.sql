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