# 🌱 EcoRide - Application de Covoiturage Écologique

## 📋 À propos

**EcoRide** est une application web de covoiturage écoresponsable. Elle permet aux utilisateurs de proposer, réserver et gérer des trajets partagés afin de réduire leur empreinte carbone.

## 🗂️ Structure du projet

-   `/database/sql` : Scripts SQL d’installation et de test de la base relationnelle.
-   `/database/nosql` : Données utilisateurs (avis) au format JSON.

## 👤 Comptes de test

-   **Utilisateur** :
    -   `pseudo`: bob / `mail`: bob@test.com / `mot de passe`: password123
    -   `pseudo`: alice / `mail`: alice@test.com / `mot de passe`: password123
-   **Administrateur** :
    -   `pseudo`: satoshi / `mail`: satoshiAdmin@test.com / `mot de passe`: password123
-   **Employé** :

    -   `pseudo`: hal / `mail`: hal@test.com / `mot de passe`: password123

-   **Formulaire** : Création d’un utilisateur via le formulaire d’inscription.
    -   `pseudo`: / `mail`: @test.com / `mot de passe`: password123
    -   `pseudo`: / `mail`: @test.com / `mot de passe`: password123
    -   `pseudo`: / `mail`: @test.com / `mot de passe`: password123
    -   `pseudo`: / `mail`: @test.com / `mot de passe`: password123

## 🚀 Fonctionnalités

### Front-end

-   ✅ Page d’accueil avec présentation et barre de recherche
-   ✅ Menu de navigation responsive
-   ✅ Vue des covoiturages disponibles
-   ✅ Système de filtres avancés
-   ✅ Page de détail des covoiturages
-   ⏳ Système de réservation (en cours)
-   ✅ Gestion des comptes utilisateurs
-   ⏳ Système de démarrage/arrêt des trajets
-   ⏳ Interface employé
-   ⏳ Interface administrateur

### Back-end

-   ✅ Base de données SQL & NoSQL
-   ✅ Système d’authentification
-   ⏳ Gestion des trajets
-   ⏳ Système de crédits
-   ⏳ Système de modération

## 🛠️ Technologies

-   **Front-end** : HTML5, SCSS, JavaScript (ES6+)
-   **Back-end** : PHP 8, MySQL
-   **Outils** : Node.js, npm, Composer
-   **Déploiement** : O2Switch

## ⚙️ Installation

```bash
# Cloner le projet
git clone https://github.com/Alyaesub/Ecoride.git

# Installer les dépendances front
npm install

# Configurer la base de données
# → Exécuter les scripts SQL dans /database/sql
# → Adapter les infos dans config/env.ini
```

## 📦 Architecture

### MVC

-   Structure `app/` : `controllers/`, `models/`, `views/`, `functions/`
-   `public/` : racine propre avec `index.php` central

### Autoload

-   Autoload via Composer (`vendor/`, `composer.json`, `dump-autoload` ✅)
-   Chargement automatique des classes avec `require 'vendor/autoload.php'`

### Débogage

-   Whoops installé et activé (`index.php`) pour une gestion élégante des erreurs

### Vue & Layout

-   Fonction `render()` (dans `functions/view.php`) pour charger dynamiquement les pages
-   Layout unique (`layout.php`) avec `html`, `head`, `body` centralisés et dynamiques

## 🔗 Ressources

-   [GitHub](https://github.com/Alyaesub/Ecoride.git)
-   [Trello](https://trello.com/invite/b/674dfbcb0c1b62a2c6577364/ATTI5bbb7e636c9c9aac07b4b2c4cb037469670CFCA8/ecf-ecoride)
-   [Documentation](https://github.com/Alyaesub/Ecoride/wiki)

## 📚 Documentation technique

-   [Maquettes Figma](https://www.figma.com/design/wzlnTb3rpsE1tW39XHNRj9/Maquettage-Ecoride)
-   [Diagramme d’utilisation](https://www.figma.com/design/tDpcbYwymMGQ1bRDxAunYQ/Diagramme-d-utilisation-Ecoride)
-   [Diagramme de classe](https://www.figma.com/design/UErDXx2fShe8iPASCSTqLB/diagramme-classe-Ecoride)
-   [MCP - Modèle de Conceptualisation du Projet](https://www.figma.com/design/FiuUpMhBEJEVa6j3rrmASP/MCP-Ecoride)
-   [Diagramme de séquence](https://www.figma.com/design/p2iUH1N3JGgNAPVyS23V2m/Diagramme-sequence-Ecoride)

## 🔐 Configuration

### `config/env.ini`

```ini
[database]
DB_HOST = 127.0.0.1
DB_NAME = ecoride
DB_USER =
DB_PASS =

[settings]
APP_ENV = local
DEBUG = true
```

-   Séparation des infos sensibles
-   Adaptable pour un déploiement en production

### `config/config.php`

-   Charge `env.ini`
-   Active le mode `DEBUG`
-   Définit la constante `APP_ENV`
-   Gère l’absence de fichier de config

### `.htaccess`

```apache
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

-   Redirection vers `index.php` (MVC)
-   Protection des fichiers sensibles
-   Personnalisation des erreurs

### Connexion à la base

```php
use App\Models\ConnexionDb;

$pdo = ConnexionDb::getPdo();
```

-   Connexion centralisée via `ConnexionDb`
-   Requêtes prêtes à l’emploi avec PDO

## ✅ Bonnes pratiques

-   Configuration centralisée et sécurisée
-   Séparation environnement local / prod
-   Connexion BDD fiable via PDO
-   Architecture MVC propre et maintenable
-   Projet prêt pour la mise en ligne

---
