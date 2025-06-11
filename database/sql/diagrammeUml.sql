@startuml


class Role {
  +id_role : INT
  +libelle : VARCHAR
}

class Utilisateur {
  +id_utilisateur : INT
  +pseudo : VARCHAR
  +nom : VARCHAR
  +prenom : VARCHAR
  +email : VARCHAR
  +mot_de_passe : VARCHAR
  +credits : INT
  +photo : VARCHAR
  +id_role : INT
}

Role "1" -- "0..*" Utilisateur : a pour rôle


class Marque {
  +id_marque : INT
  +nom_marque : VARCHAR
}

class Vehicule {
  +id_vehicule : INT
  +id_utilisateur : INT
  +id_marque : INT
  +modele : VARCHAR
  +immatriculation : VARCHAR
  +couleur : VARCHAR
  +energie : ENUM
}

Utilisateur "1" -- "0..*" Vehicule : possède
Marque "1" -- "0..*" Vehicule : est de marque

class Covoiturage {
  +id_covoiturage : INT
  +id_utilisateur : INT
  +id_vehicule : INT
  +adresse_depart : VARCHAR
  +adresse_arrivee : VARCHAR
  +date_depart : DATETIME
  +date_arrivee : DATETIME
  +prix_personne : DECIMAL
  +places_disponibles : INT
  +est_ecologique : BOOLEAN
  +animaux_autorises : BOOLEAN
  +fumeur : BOOLEAN
  +statut : ENUM
}

Utilisateur "1" -- "0..*" Covoiturage : organise
Vehicule "1" -- "0..*" Covoiturage : utilisé pour


class User_Covoiturage {
  +id_utilisateur : INT
  +id_covoiturage : INT
  +role_utilisateur : ENUM
}

Utilisateur "1" -- "0..*" User_Covoiturage
Covoiturage "1" -- "0..*" User_Covoiturage


class Notation {
  +id_notation : INT
  +id_utilisateur_cible : INT
  +id_utilisateur_auteur : INT
  +id_covoiturage : INT
  +note : TINYINT
  +date_notation : DATETIME
}

Utilisateur "1" -- "0..*" Notation : reçoit
Utilisateur "1" -- "0..*" Notation : écrit
Covoiturage "1" -- "0..*" Notation : concerne

class Avis {
  +id_avis : INT
  +id_covoiturage : INT
  +id_utilisateur : INT
  +note : INT
  +commentaire : TEXT
  +statut : VARCHAR
}

Utilisateur "1" -- "0..*" Avis
Covoiturage "1" -- "0..*" Avis

@enduml

####/////////////////////////////////////////////////
-- Table Configuration pour faire les diagrammes UML
@startuml

Table Role {
  id_role  INT [pk]
  libelle  VARCHAR(30)
}

Table Utilisateur {
  id_utilisateur  INT [pk]
  pseudo  VARCHAR(30)
  nom  VARCHAR(30)
  prenom  VARCHAR(30)
  email  VARCHAR(50)
  motdepasse  VARCHAR(255)
  credits  INT
  photo  VARCHAR(50)
  id_role  INT
}



Table Marque {
  id_marque  INT [pk]
  nom_marque  VARCHAR(50)
}

Table Vehicule {
  id_vehicule  INT [pk]
  id_utilisateur  INT
  id_marque  INT
  modele  VARCHAR(50)
  immatriculation  VARCHAR(30)
  couleur  VARCHAR(30)
  energie  ENUM('essence','diesel','electrique','hybride')
}



Table Covoiturage {
  id_covoiturage  INT [pk]
  id_utilisateur  INT
  id_vehicule  INT
  adresse_depart  VARCHAR(255)
  adresse_arrivee  VARCHAR(255)
  date_depart  DATETIME
  date_arrivee  DATETIME 
  prix_personne  DECIMAL(10,2)
  places_disponibles  INT
  est_ecologique  BOOLEAN 
  animaux_autoriser  BOOLEAN
  fumeur  BOOLEAN
  statut  ENUM
}



Table Utilisateur_covoiturage {
  id_utilisateur INT
  id_covoiturage INT
  role_utilisateur  ENUM
  Note: "clé composite"
}



Table Notation {
  id_notation  INT [pk]
  id_utilisateur_cible INT
  id_utilisateur_auteur  INT
  id_covoiturage  INT
  note  TINYINT
  date_notation  DATETIME
}



Table Avis {
  id_avis  INT [pk]
  id_utilisateur  INT
  id_covoiturage  INT
  note  INT
  commentaire  VARCHAR(255)
  statut  VARCHAR(30)
}

Ref: Utilisateur.id_role > Role.id_role

Ref: Vehicule.id_utilisateur > Utilisateur.id_utilisateur
Ref: Vehicule.id_marque > Marque.id_marque

Ref: Covoiturage.id_utilisateur > Utilisateur.id_utilisateur
Ref: Covoiturage.id_vehicule > Vehicule.id_vehicule

Ref: Utilisateur_covoiturage.id_utilisateur > Utilisateur.id_utilisateur
Ref: Utilisateur_covoiturage.id_covoiturage > Covoiturage.id_covoiturage

Ref: Notation.id_utilisateur_cible > Utilisateur.id_utilisateur
Ref: Notation.id_utilisateur_auteur > Utilisateur.id_utilisateur
Ref: Notation.id_covoiturage > Covoiturage.id_covoiturage

Ref: Avis.id_utilisateur > Utilisateur.id_utilisateur
Ref: Avis.id_covoiturage > Covoiturage.id_covoiturage






@enduml