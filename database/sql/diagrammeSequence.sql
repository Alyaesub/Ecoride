
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

@startuml
actor Utilisateur
participant "Navigateur\n(HTML/JS)" as Front
participant "JavaScript\n(Fetch)" as JS
participant "Contrôleur PHP\n(CovoiturageController)" as Controller
participant "Modèle PHP\n(Covoiturage.php)" as Model
database MySQL
database "MongoDB\n(avis.json)" as MongoDB

== Début de la réservation ==

Utilisateur -> Front : Clique sur "Réserver"
Front -> JS : Déclenche Fetch POST /participer
JS -> Controller : $_POST (id_covoit, id_user)
Controller -> Model : vérifier dispo / crédits
Model -> MySQL : SELECT places dispo + crédits
MySQL --> Model : Résultat
Model -> MySQL : INSERT user_covoiturage
Model -> MongoDB : Créer un avis vide (optionnel)
MongoDB --> Model : OK
Model --> Controller : Réservation réussie
Controller --> JS : JSON success
JS --> Front : Affiche message "Réservation OK"

@enduml