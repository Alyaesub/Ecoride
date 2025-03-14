@startuml
actor "Utilisateur (Conducteur)" as conducteur
actor "Utilisateur (Passager)" as passager
participant "Système" as system
participant "Voiture" as voiture
participant "Covoiturage" as covoit

== Connexion du Conducteur ==
conducteur -> system : Saisit email + mot de passe
system -> system : Vérifie identifiants
system --> conducteur : Confirmation de connexion

== Création d'une voiture ==
conducteur -> system : Saisit infos Voiture (modèle, immat, marque, ...)
system -> voiture : Crée un nouvel enregistrement Voiture
voiture --> system : Retourne l'ID de la voiture créée
system --> conducteur : Confirmation création voiture

== Création d'un Covoiturage ==
conducteur -> system : Demande de créer un covoiturage
system -> covoit : Crée un nouvel enregistrement Covoiturage
system -> covoit : Associe la voiture au covoiturage
covoit --> system : Retourne l'ID du covoiturage
system --> conducteur : Confirmation création covoiturage

== Participation du Passager ==
passager -> system : Consulte la liste des covoiturages
system --> passager : Affiche covoiturages disponibles
passager -> system : Sélectionne le covoiturage et participe
system -> covoit : Ajoute l'utilisateur (passager) au covoiturage
covoit --> system : Confirme l'ajout
system --> passager : Confirmation de participation

@enduml
