@startuml

  Les Classes

class Configuration {
  + id_configuration : INT
}

class Parametre {
  + id_parametre : INT
  + propriete : VARCHAR(50)
  + valeur : VARCHAR(50)
}

class Role {
  + id_role : INT
  + libelle : VARCHAR(30)
}

class Utilisateur {
  + id_utilisateur : INT
  + pseudo : VARCHAR(30)
  + nom : VARCHAR(30)
  + prenom : VARCHAR(30)
  + email : VARCHAR(50)
  + motdepasse : VARCHAR(255)
  + credits : INT DEFAULT 20
  + photo : VARCHAR(50)
  + id_role : INT
}


class Marque {
  + id_marque : INT
  + nom_marque: VARCHAR(30)
}

class Vehicule {
  + id_vehicule : INT
  + id_utilisateur : INT NOT NULL
  + id_marque : INT NOT NULL
  + modele : VARCHAR(50)
  + immatriculation : VARCHAR(30)
  + couleur : VARCHAR(30)
  + energie : VARCHAR(30)
}

class Covoiturage {
  + id_covoiturage : INT NOT NULL
  + id_conducteur INT NOT NULL
  + id_vehicule INT NOT NULL
  + adresse_depart VARCHAR (255) NOT NULL
  + adresse_arrivee VARCHAR (255) NOT NULL
  + date_depart DATETIME NOT NULL
  + heure_depart TIME : TIME
  + date_arrivee DATETIME NOT NULL
  + heure_arrive TIME
  + prix_personne  FLOAT
  + places_disponibles  INT
  + est_ecologique BOOLEAN DEFAULT FALSE
  + animaux_autoriser BOOLEAN DEFAULT FALSE
  + fumeur BOOLEAN DEFAULT FALSE
}

class Utilisateur_covoiturage {
  + id_utilisateur INT NOT NULL
  + id_covoiturage INT NOT NULL
}
class Avis {
  + id_avis : INT
  + id_utilisateur : INT
  + id_covoiturage : INT
  + note : INT
  + commentaire : VARCHAR(255)
  + statut : VARCHAR(30)
}

  Les Associations

  -- 1 Configuration -- Parametre
  Configuration "1" -- "0..*" Parametre : dispose

  -- 2 Utilisateur -- Avis
  Utilisateur "1" -- "0..*" Avis : possede

  -- 3 Utilisateur -- Covoiturage
  Utilisateur "0..*" -- "0..*" Covoiturage : participe

  -- 4 Utilisateur -- Voiture
  Utilisateur "1" -- "0..*" Vehicule : gere / depose

  -- 5 Voiture -- Covoiturage
  Vehicule "1" -- "0..*" Covoiturage : utilise

  -- 6 Marque -- Voiture
  Marque "1" -- "0..*" Vehicule : detient

  -- 7 Utilisateur -- Role
  Utilisateur "1" -- "1" Role : possede

  -- 8 Covoiturage -- Utilisateur
  Covoiturage "1" -- "0..*" Utilisateur : participe

  -- 9 Covoiturage -- Utilisateur_covoiturage
  Covoiturage "1" -- "0..*" Utilisateur_covoiturage : participe   

@enduml


-- Table Configuration pour faire les diagrammes UML
Table Configuration {
  id_configuration  INT
}

Table Parametre {
  id_parametre  INT
  propriete  VARCHAR(50)
  valeur  VARCHAR(50)
  id_configuration  INT
}

Table Role {
  id_role  INT
  libelle  VARCHAR(30)
}

Table Utilisateur {
  id_utilisateur  INT
  pseudo  VARCHAR(30)
  nom  VARCHAR(30)
  prenom  VARCHAR(30)
  email  VARCHAR(50)
  motdepasse  VARCHAR(255)
  photo  VARCHAR(50)
  id_role  INT
}

Table Marque {
  id_marque  INT
  nom_marque  VARCHAR(50)
}

Table Vehicule {
  id_vehicule  INT
  id_utilisateur  INT
  id_marque  INT
  modele  VARCHAR(50)
  immatriculation  VARCHAR(30)
  couleur  VARCHAR(30)
  energie  ENUM('essence','diesel','electrique','hybride')
}

Table Covoiturage {
  id_covoiturage  INT
  id_utilisateur  INT
  id_vehicule  INT
  adresse_depart  VARCHAR(255)
  adresse_arrivee  VARCHAR(255)
  date_depart  DATETIME
  heure_depart  TIME
  date_arrivee  DATETIME 
  heure_arrive  TIME
  prix_personne  DECIMAL(10,2)
  places_disponibles  INT
  est_ecologique  BOOLEAN 
  animaux_autoriser  BOOLEAN
  fumeur  BOOLEAN
}

class Utilisateur_covoiturage {
  id_utilisateur INT NOT NULL
  id_covoiturage INT NOT NULL
}

Table Avis {
  id_avis  INT
  id_utilisateur  INT
  id_covoiturage  INT
  note  INT
  commentaire  VARCHAR(255)
  statut  VARCHAR(30)
}