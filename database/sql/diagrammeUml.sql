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
  + utilisateur_id : INT
  + email : VARCHAR(50)
  + nom : VARCHAR(30)
  + prenom : VARCHAR(30)
  + motdepasse : VARCHAR(255)
  + photo : VARCHAR(50)
  + statut : VARCHAR(30)
}

class Avis {
  + id_avis : INT
  + note : INT
  + commentaire : VARCHAR(255)
  + statut : VARCHAR(30)
}

class Voiture {
  + id_voiture : INT
  + modele : VARCHAR(50)
  + immatriculation : VARCHAR(30)
  + energie : VARCHAR(30)
  + couleur : VARCHAR(30)
  + date_premiere_immatriculation : DATE
}

class Marque {
  + id_marque : INT
  + libelle : VARCHAR(30)
}

class Covoiturage {
  + id_covoiturage : INT
  + date : DATE
  + heure : TIME
  + lieu_depart : VARCHAR(255)
  + lieu_arrivee : VARCHAR(255)
  + nb_places : INT
  + prix_personne : FLOAT
}


/////////////////////////////////////
  Les Relations


1 Configuration -- Parametre
Configuration "1" -- "0..*" Parametre : dispose

2 Utilisateur -- Avis
Utilisateur "1" -- "0..*" Avis : possede

3 Utilisateur -- Covoiturage
Relation "participe" = un utilisateur peut participer à plusieurs covoiturages
et un covoiturage peut avoir plusieurs utilisateurs
Utilisateur "0..*" -- "0..*" Covoiturage : participe

4 Utilisateur -- Voiture
On voit "gere" ou "dep(o)se". 
Selon le MCD, un utilisateur peut gérer ou déposer plusieurs voitures.
Utilisateur "1" -- "0..*" Voiture : gere / depose

5 Voiture -- Covoiturage
  Une voiture peut être utilisée pour plusieurs covoiturages,
  un covoiturage utilise une seule voiture à la fois (a priori).
Voiture "1" -- "0..*" Covoiturage : utilise

6 Marque -- Voiture
Marque "1" -- "0..*" Voiture : detient

@enduml