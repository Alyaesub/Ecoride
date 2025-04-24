# 🌱 EcoRide - Application de Covoiturage Écologique

## 📋 À propos du projet

EcoRide est une application web de covoiturage écologique. Elle facilite les déplacements tout en réduisant l'empreinte carbone, permettant aux utilisateurs de proposer et réserver des trajets partagés.

## 🗂️ Structure du projet

-   `/database/sql` : scripts d'installation et de test de la base relationnelle.
-   `/database/nosql` : données utilisateurs (avis) au format JSON.

## 🚀 Fonctionnalités

### Front-end

-   [x] Page d'accueil avec présentation et barre de recherche
-   [x] Menu de navigation responsive
-   [x] Vue des covoiturages disponibles
-   [x] Système de filtres avancés
-   [x] Page de détail des covoiturages
-   [ ] Système de réservation (en cours)
-   [ ] Gestion des comptes utilisateurs (en cours)
-   [ ] Système de démarrage/arrêt des trajets (en cours)
-   [ ] Interface employé (en cours)
-   [ ] Interface administrateur (en cours)

### Back-end

-   [ ] Base de données SQL & NoSQL (en cours)
-   [ ] Système d'authentification (en cours)
-   [ ] Gestion des trajets (en cours)
-   [ ] Système de crédits (en cours)
-   [ ] Système de modération (en cours)

## 🛠️ Technologies

-   Front-end : HTML5, SCSS, JavaScript (ES6+)
-   Back-end : PHP 8, MySQL
-   Outils : Node.js, npm, Composer
-   Déploiement : O2Switch (prévu)

## ⚙️ Installation du projet

```bash
# Cloner le repository
git clone https://github.com/Alyaesub/Ecoride.git

# Installer les dépendances
npm install

# Configurer la base de données via les scripts SQL et ajuster le fichier config/env.ini
```

## 🔍 État d'avancement

### Structure MVC

• app/ structuré avec : controllers, models, views, functions.

### Public / racine

• public/ ou racine bien propre avec un index.php central.

### Autoload Composer

• composer.json configuré proprement  
• dossier vendor/ bien généré  
• `composer dump-autoload` réalisé ✅  
• Les classes sont automatiquement chargées via `require 'vendor/autoload.php'`.

### Whoops

• Installé via Composer  
• Activé dans index.php  
• Affiche des erreurs jolies et utiles si besoin ✅

### Fonction render()

• Dans app/functions/view.php  
• Utilisée partout via `require_once` (ou bientôt via namespace)  
• Injecte le contenu + le layout avec `$pageContent` & `$title`.

### Layout général

• layout.php propre avec :  
 • balises `<html>`, `<head>`, `<body>` centralisées  
 • chargement du CSS  
 • affichage dynamique du contenu de chaque page

✅ Et maintenant… des liens centralisés et dynamiques !

## 🔗 Liens utiles

-   [GitHub Repository](https://github.com/Alyaesub/Ecoride.git)
-   [Trello Board](https://trello.com/invite/b/674dfbcb0c1b62a2c6577364/ATTI5bbb7e636c9c9aac07b4b2c4cb037469670CFCA8/ecf-ecoride)
-   [Documentation](https://github.com/Alyaesub/Ecoride/wiki)

## 📚 Documentation

-   Maquettes : [Lien](https://www.figma.com/design/wzlnTb3rpsE1tW39XHNRj9/Maquettage-Ecoride?t=qEgEUtOSJ5wLQTr0-0)
-   Diagramme d'utilisation : [Lien](https://www.figma.com/design/tDpcbYwymMGQ1bRDxAunYQ/Diagramme-d-utilisation-Ecoride?node-id=0-1&p=f&t=qEgEUtOSJ5wLQTr0-0)
-   Diagramme de classe : [Lien](https://www.figma.com/design/UErDXx2fShe8iPASCSTqLB/diagramme-classe-Ecoride?node-id=0-1&p=f&t=7E1L6cUHexjM0Wb3-0)
-   MCP Ecoride : [Lien](https://www.figma.com/design/FiuUpMhBEJEVa6j3rrmASP/MCP-Ecoride)
-   Diagramme de séquence : [Lien](https://www.figma.com/design/p2iUH1N3JGgNAPVyS23V2m/Diagramme-sequence-Ecoride)

## ⚙️ Configuration

### `config/env.ini` (local)

```ini
[database]
DB_HOST = 127.0.0.1
DB_NAME = ecoride
DB_USER = root
DB_PASS = root

[settings]
APP_ENV = local
DEBUG = true
```

✅ Permet de **séparer les infos sensibles** (connexion BDD, debug, env)  
✅ Facile à adapter en production (ex : O2Switch)

---

### `config/config.php`

-   Charge `env.ini` en tableau associatif
-   Active le `DEBUG` si configuré
-   Définit une constante `APP_ENV`
-   Gère les cas où `env.ini` est manquant

---

### `.htaccess`

```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]

<FilesMatch "\.(ini|env|sql|log|sh|bak|htaccess)$">
    Order allow,deny
    Deny from all
</FilesMatch>

ErrorDocument 404 /404.html
ErrorDocument 403 /403.html
AddDefaultCharset UTF-8
```

✅ Redirection vers `index.php` (routing MVC)  
✅ Protection des fichiers sensibles  
✅ Encodage UTF-8  
✅ Pages d’erreur personnalisables

---

### `ConnexionDb.php`

```php
use App\Models\ConnexionDb;

$pdo = ConnexionDb::getPdo();
```

-   Récupère les infos depuis `env.ini` via `config.php`
-   Retourne un objet `PDO` prêt à l'emploi
-   Centralise la connexion à la base (évite duplication)
-   Tu pourras supprimer les fallback plus tard pour plus de sécurité

## 🧰 Bonnes pratiques appliquées

-   ✅ Centralisation de la configuration
-   ✅ Séparation env local / prod
-   ✅ Connexion sécurisée à la base de données
-   ✅ Prêt pour le déploiement chez O2Switch
-   ✅ Compatible avec PHP 8 et architecture MVC propre

---
