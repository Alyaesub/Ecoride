
@startuml
actor "Utilisateur (Conducteur)" as Conducteur
actor "Utilisateur (Passager)" as Passager
participant "Système" as System
participant "Voiture" as Voiture
participant "Covoiturage" as Covoit

== Connexion du Conducteur ==
Conducteur -> System : Saisit email + mot de passe
System -> System : Vérifie les identifiants
System --> Conducteur : Connexion réussie

== Création d’une voiture ==
Conducteur -> System : Remplit le formulaire voiture
System -> Voiture : Crée l’enregistrement
Voiture --> System : Retourne l’ID voiture
System --> Conducteur : Confirmation création

== Création d’un covoiturage ==
Conducteur -> System : Saisit les infos du trajet
System -> Covoit : Crée le covoiturage
System -> Covoit : Associe l’ID de la voiture
Covoit --> System : Retourne l’ID covoiturage
System --> Conducteur : Confirmation de publication

== Participation du passager ==
Passager -> System : Recherche des trajets
System --> Passager : Liste des covoiturages
Passager -> System : Participe à un covoiturage
System -> Covoit : Ajoute le passager au trajet
Covoit --> System : Confirmation de participation
System --> Passager : Trajet réservé avec succès

@enduml