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

class Utilisateur {
  + id_utilisateur : INT
  + nom : VARCHAR(30)
  + prenom : VARCHAR(30)
  + email : VARCHAR(50)
  + motdepasse : VARCHAR(255)
  + photo : VARCHAR(50)
  + role : VARCHAR(30)
}

class Avis {
  + id_avis : INT
  + note : INT
  + commentaire : VARCHAR(255)
  + statut : VARCHAR(30)
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

class Role {
  + id_role : INT
  + libelle : VARCHAR(30)
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
  + prix_personne : FLOAT
  + places_disponibles : INT
  + est_ecologique BOOLEAN DEFAULT FALSE
}

class Utilisateur_covoiturage {
  + id_utilisateur INT NOT NULL
  + id_covoiturage INT NOT NULL
}

/////////////////////////////////////
  Les Relations


-- 1 Configuration -- Parametre
Configuration "1" -- "0..*" Parametre : dispose

-- 2 Utilisateur -- Avis
Utilisateur "1" -- "0..*" Avis : possede


-- 3 Utilisateur -- Covoiturage
-- Relation "participe" = un utilisateur peut participer à plusieurs covoiturages
-- et un covoiturage peut avoir plusieurs utilisateurs
Utilisateur "0..*" -- "0..*" Covoiturage : participe

-- 4 Utilisateur -- Voiture
-- On voit "gere" ou "dep(o)se". 
-- Selon le MCD, un utilisateur peut gérer ou déposer plusieurs voitures.
Utilisateur "1" -- "0..*" Vehicule : gere / depose

-- 5 Voiture -- Covoiturage
--   Une voiture peut être utilisée pour plusieurs covoiturages,
--   un covoiturage utilise une seule voiture à la fois (a priori).
Vehicule "1" -- "0..*" Covoiturage : utilise

-- 6 Marque -- Voiture
Marque "1" -- "0..*" Voiture : detient

@enduml


Table Configuration {
  id_configuration  INT
}
Table Parametre {
   id_parametre  INT
   propriete  VARCHAR(50)
   valeur  VARCHAR(50)
}

Table Utilisateur {
   id_utilisateur  INT
   nom  VARCHAR(30)
   prenom  VARCHAR(30)
   email  VARCHAR(50)
   motdepasse  VARCHAR(255)
   photo  VARCHAR(50)
   role  VARCHAR(30)
}

Table Avis {
   id_avis  INT
   note  INT
   commentaire  VARCHAR(255)
   statut  VARCHAR(30)
}

Table Vehicule {
   id_vehicule  INT
   id_utilisateur INT
   id_marque  INT
   modele  VARCHAR(50)
   immatriculation  VARCHAR(30)
   couleur  VARCHAR(30)
   energie  VARCHAR(30)
}

Table Marque {
   id_marque  INT
   libelle  VARCHAR(30)
}

Table Covoiturage {
   id_covoiturage  INT
   id_conducteur INT
   id_vehicule INT
   adresse_depart VARCHAR (255)
   adresse_arrivee VARCHAR (255)
   date_depart DATETIME
   heure_depart TIME
   date_arrivee DATETIME 
   heure_arrive TIME
   prix_personne  FLOAT
   places_disponibles  INT
   est_ecologique BOOLEAN 
}