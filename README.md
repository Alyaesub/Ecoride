# 🚗 EcoRide - Application de Covoiturage Écologique

## 📋 À propos du projet

EcoRide est une application web de covoiturage écologique visant à faciliter les déplacements tout en réduisant l'impact environnemental. L'application permet aux utilisateurs de proposer et de réserver des trajets en covoiturage.

## Structure :

📁 /database/sql contient les scripts d’installation et de test pour la base relationnelle.
📁 /database/nosql contient les données stockées au format JSON, utilisées pour les avis utilisateurs.

## 🎯 Fonctionnalités

### Front-end

-   [x] Page d'accueil avec présentation et barre de recherche
-   [x] Menu de navigation responsive
-   [x] Vue des covoiturages disponibles
-   [x] Système de filtres avancés
-   [x] Page de détail des covoiturages
-   [ ] Système de réservation
-   [ ] Gestion des comptes utilisateurs
-   [ ] Système de démarrage/arrêt des trajets
-   [ ] Interface employé
-   [ ] Interface administrateur

### Back-end

-   [ ] Base de données SQL & NoSQL
-   [ ] Système d'authentification
-   [ ] Gestion des trajets
-   [ ] Système de crédits
-   [ ] Système de modération

## 🛠️ Technologies utilisées

-   Front-end : HTML5, CSS3, JavaScript (ES6+)
-   Back-end : PHP, MySQL
-   Outils : Node.js, npm
-   Déploiement : [À définir]

## 📦 Installation

```bash
# Cloner le repository
git clone https://github.com/Alyaesub/Ecoride.git

# Installer les dépendances
npm install

# Configurer la base de données
# [Instructions à venir]
```

Voici le récap de ce qui fonctionne :

⸻

🧱 Structure projet
• app/ bien organisée : controllers, models, views, functions, etc.
• public/ ou racine bien propre avec un index.php central

⸻

⚙️ Autoload Composer
• composer.json configuré proprement
• Dossier vendor/ bien généré
• composer dump-autoload fait ✅
• Les classes sont automatiquement chargées via require 'vendor/autoload.php'

⸻

📦 Whoops
• Installé via Composer
• Activé dans index.php
• T’affiche des erreurs jolies et utiles si besoin ✅

⸻

🧠 Fonction render()
• Dans app/functions/view.php
• Utilisée partout via require_once (ou bientôt via namespace si tu veux)
• Injecte le contenu + le layout avec $pageContent & $title

⸻

📄 Layout général
• layout.php propre avec :
• balises <html>, <head>, <body> centralisées
• chargement du CSS
• affichage dynamique du contenu de chaque page

✅ et maintenant… des liens centralisés et dynamiques !

## 🔗 Liens utiles

-   [GitHub Repository](https://github.com/Alyaesub/Ecoride.git)
-   [Trello Board](https://trello.com/invite/b/674dfbcb0c1b62a2c6577364/ATTI5bbb7e636c9c9aac07b4b2c4cb037469670CFCA8/ecf-ecoride)
-   [Documentation](https://github.com/Alyaesub/Ecoride/wiki)

## 📊 Documentation

-   a refaire [Diagramme de classe](https://www.figma.com/design/UErDXx2fShe8iPASCSTqLB/diagramme-classe-Ecoride)
-   a refaire [Diagramme d'utilisation](https://www.figma.com/design/tDpcbYwymMGQ1bRDxAunYQ/Diagramme-d'utilisation-Ecoride)
-   a refaire [MCP Ecoride](https://www.figma.com/design/FiuUpMhBEJEVa6j3rrmASP/MCP-Ecoride)
-   [Diagramme de séquence](https://www.figma.com/design/p2iUH1N3JGgNAPVyS23V2m/Diagramme-sequence-Ecoride)
-   [Maquettes](https://www.figma.com/design/wzlnTb3rpsE1tW39XHNRj9/Maquettage-Ecoride)

## ⚙️ `config/env.ini` (local)

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

## 📄 `config/config.php`

-   Charge `env.ini` en tableau associatif
-   Active le `DEBUG` si configuré
-   Définit une constante `APP_ENV`
-   Gère les cas où `env.ini` est manquant

---

## 🔐 `.htaccess`

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

## 🧠 `ConnexionDb.php`

```php
use App\Models\ConnexionDb;

$pdo = ConnexionDb::getPdo();
```

-   Récupère les infos depuis `env.ini` via `config.php`
-   Retourne un objet `PDO` prêt à l'emploi
-   Centralise la connexion à la base (évite duplication)
-   Tu pourras supprimer les fallback plus tard pour + de sécurité

---

## 🛠️ Bonnes pratiques mises en place

-   ✅ Centralisation de la config
-   ✅ Séparation env local / prod
-   ✅ Connexion sécurisée à la BDD
-   ✅ Ready pour le déploiement chez O2Switch
-   ✅ Compatible avec PHP 8 et MVC propre

---
