-- Active: 1741715531234@@127.0.0.1@3306
Dossier Projet et ECF de la formations
Conception d'une apllication de covoiturage écologique

🔹 Objectif du projet EcoRide
Créer une application web de covoiturage écologique avec :
Un front-end dynamique et intuitif.
Un back-end avec une base SQL et NoSQL.
Un système de gestion des utilisateurs et trajets.
Une documentation complète et un déploiement.

📌 Répartition des tâches selon l'examen
🔷 Partie Front-end (Interface utilisateur)
✅ US 1 : Page d’accueil

Présentation de l’entreprise avec images.
Barre de recherche pour trouver un itinéraire.
Footer avec email et mentions légales.
✅ US 2 : Menu de navigation

Accès aux différentes sections : accueil, voyages, connexion, contact.
✅ US 3 : Vue des covoiturages

Formulaire de recherche (départ, arrivée, date).
Affichage des trajets existants (pseudo, photo, note chauffeur, places, prix, heure de départ, etc.).
US 4 : Filtres des covoiturages

Filtres par : prix max, durée max, note min, voiture électrique.
US 5 : Détail d’un covoiturage

Affichage des informations complètes du trajet.
Avis sur le chauffeur, modèle de voiture, préférences.
US 6 : Participer à un covoiturage

Vérification des places disponibles et des crédits.
Inscription ou connexion obligatoire pour réserver.
US 7 : Création de compte

Création avec pseudo, email, mot de passe sécurisé.
Attribution automatique de 20 crédits à l'inscription.
US 11 : Démarrer et arrêter un covoiturage

Bouton pour commencer et terminer un trajet.
Mise à jour automatique du statut du trajet et des crédits.
US 12 : Espace employé

Validation et modération des avis des utilisateurs.
Gestion des trajets problématiques.
US 13 : Espace administrateur

Création des comptes employés.
Statistiques sur les trajets et crédits gagnés.
Suspension de comptes utilisateurs/employés.

🔷 Partie Back-end (Base de données & serveur)
US 3 : Vue des covoiturages

Connexion à la base de données pour récupérer et afficher les trajets disponibles.
US 5 : Vue détaillée d’un covoiturage

Requête pour charger les détails d’un trajet sélectionné.
US 6 : Participer à un covoiturage

Vérification en base de données du nombre de places disponibles et des crédits de l’utilisateur.
Inscription automatique et mise à jour du trajet.
US 7 : Création de compte

Enregistrement d’un nouvel utilisateur en SQL avec validation de l’email et du mot de passe.
US 8 : Espace utilisateur

Gestion du profil (chauffeur, passager).
Ajout des informations sur la voiture et préférences.
US 9 : Saisie d’un voyage

Formulaire pour ajouter un nouveau trajet en tant que chauffeur.
Calcul des crédits et stockage en base de données.
US 10 : Historique des covoiturages

Liste des trajets passés et possibilité d’annuler une réservation.
US 11 : Démarrer et arrêter un covoiturage

Gestion du statut du covoiturage en base de données.
Envoi d’un mail automatique aux participants.
US 12 : Espace employé

Validation et gestion des avis laissés par les utilisateurs.
US 13 : Espace administrateur

Gestion des employés et suivi des statistiques des trajets.

📌 Ce que tu dois rendre (Livrables)
👉 Un dépôt GitHub public avec :

Une branche main et une branche développement.
Des branches fonctionnalités pour chaque tâche.
Un fichier README.md avec les instructions d’installation.
✅ Un fichier SQL pour la création de la base de données.

👉 Une application web déployée (Fly.io, Heroku, Vercel, etc.).

✅ Un tableau de gestion de projet (Trello, Notion, Jira).

👉 Une documentation complète en PDF avec :

✅ Charte graphique (couleurs, polices, wireframes).
✅ Modèle Conceptuel de Données (MCD).
✅ Diagramme de classes et de séquence.
Manuel d’utilisation pour expliquer l’application.
Documentation du déploiement.

🚀 Plan d’Action

1️⃣ Valider le Front-end
✅ --Installer et configurer le projet.
✅ --Maquetter les interfaces
🔹 Développer l’accueil, le menu, et la recherche de trajets.

2️⃣ Valider le Back-end
🔹 Créer la base de données SQL & NoSQL.
🔹 Développer l’API PHP pour gérer les trajets, comptes, réservations.
🔹 Mettre en place les routes pour Fetch API.

3️⃣ Finaliser et Déployer
🔹 Ajouter la gestion des employés et administrateurs.
🔹 Vérifier la sécurité et les tests.
🔹 Rédiger la documentation et déployer.

/////////////////////////////////////////////////////////// Liste index /////////////////////////////////////////////////

-   lien du github : https://github.com/Alyaesub/Ecoride.git

-   lien du tableau Trello : https://trello.com/invite/b/674dfbcb0c1b62a2c6577364/ ATTI5bbb7e636c9c9aac07b4b2c4cb037469670CFCA8/ecf-ecoride

-   lien du diagramme de classe : https://www.figma.com/design/UErDXx2fShe8iPASCSTqLB/diagramme-classe-Ecoride?node-id=0-1&p=f&t=Jbyde96Sn3lnjZMU-0

-   lien du diagramme d'utilisation : https://www.figma.com/design/tDpcbYwymMGQ1bRDxAunYQ/Diagramme-d'utilisation-Ecoride?node-id=0-1&m=dev&t=VxZjbrq5tiGvYXBt-1

-   lien du MCP Ecoride : https://www.figma.com/design/FiuUpMhBEJEVa6j3rrmASP/MCP-Ecoride?t=2s20kuSQRHPMHUQL-0

-   Lien du diagramme de sequence : https://www.figma.com/design/p2iUH1N3JGgNAPVyS23V2m/Diagramme-sequence-Ecoride?node-id=0-1&p=f&t=8V6XOYdk5I8PwSiH-0

-Maquetter une application:

3 maquettes mobile et 3 maquettes desktop

-   lien du figma: https://www.figma.com/design/wzlnTb3rpsE1tW39XHNRj9/Maquettage-Ecoride?node-id=0-1&m=dev&t=Js0XPddOeIyc9Kc3-1

//////////////// explication du processuce de dev //////////////////

Installation et paramétrage de VSC, relier mon vsc avec mon github installation des extensions comme:
autoRenam, Prettier, indent-rainbow, github codespace, ESlint, live Preview, mobile preview, et html Css support, SASS compilateur, JavaScript ES6, node.js et nmp pour mes packages pour coter front
et nod.js, php et sql, php server, php intelehense, MySql coter back ce projet

-mobile first

-barre de recherche

-section avec pub et lien qui envoie sur le forme de covoiturage
section avec pub pour le forma desktop

-utilisation du forme de covoit pour faire mes requetes des requêtes asynchrone sans rechargement de page avec fetch

gestion des bdd avec php et mysql
