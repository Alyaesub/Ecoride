# 🌱 EcoRide - Application de Covoiturage Écologique

## À propos

**EcoRide** est une application web de covoiturage écoresponsable. Elle permet aux utilisateurs de proposer, réserver et gérer des trajets partagés afin de réduire leur empreinte carbone.

## Technologies

-   **Front-end** : HTML5, SCSS, JavaScript (ES6+)
-   **Back-end** : PHP 8.4.6, MySQL, Mongodb
-   **Outils** : chart.js, npm: '11.1.0', node: '22.13.0', Composer,
    Docker version 28.0.1, build 068a01e, Docker Compose version v2.33.1-desktop.1
-   **PDO (gestion SQL sécurisée)**
-   **MongoDB Atlas (NoSQL pour les avis)**

## Comptes de test

-   **Utilisateur** :
    -   `pseudo`: bob / `mail`: bob@test.com / `mot de passe`: password123
    -   `pseudo`: alice / `mail`: alice@test.com / `mot de passe`: password123
-   **Administrateur** :

    -   `pseudo`: satoshi / `mail`: satoshiAdmin@test.com / `mot de passe`: password123

-   **Employé** :

    -   `pseudo`: hal / `mail`: hal@test.com / `mot de passe`: password123

-   **Formulaire** : Création d’un utilisateur via le formulaire registerUser.

    -   `pseudo`: aly / `mail`: aly@test.com / `mot de passe`: password123
    -   `pseudo`: matthieu / `mail`: matthieu@test.com / `mot de passe`: password123
    -   `pseudo`: marie / `mail`: marie@test.com / `mot de passe`: password123
    -   `pseudo`: claudia / `mail`: claudi@test.com / `mot de passe`: password123
    -   `pseudo`: testmaj/ `mail`: testmaj@test.com / `mot de passe`: testmaj

-   **Formulaire** : Création d’employes via le formulaire registerEmploye.
    -   `pseudo`: vitalik/ `mail`: vitalik@test.com / `poste` : moderateur/ `numéro de badge` : 12 / `mot de passe`: password123
    -   `pseudo`: albert/ `mail`: albert@test.com / `poste` : informaticien / `numéro de badge` : 13 / `mot de passe`: password123
    -   `pseudo`: magalie/ `mail`: magalie@test.com / `poste` : moderatrice / `numéro de badge` : 14 / `mot de passe`: password123
        > Note : Les utilisateurs créés via le formulaire reçoivent 20 crédits à l'inscription. L'administrateur est créé en amont. Les employés sont créés via l'espace administrateur.

## Installation

```bash
# Cloner le projet
git clone https://github.com/Alyaesub/Ecoride.git

# Installer les dépendances front
npm install

# Configurer la base de données
# → Exécuter les scripts SQL dans /database/sql
# → Configurer MongoDB Atlas : renseigner l'URI dans le fichier .env (MONGO_URI)
# → Adapter les infos dans config/env.ini
```

## 📦 Architecture et Structure du projet

### MVC

-   Structure `app/` : `controllers/`, `models/`, `views/`, `functions/`
-   `public/` : racine propre avec `index.php` central
-   Gestion hybride : modèles SQL via PDO (MySQL) et modèle Avis (MongoDB)

### Autoload

-   Autoload via Composer (`vendor/`, `composer.json`, `dump-autoload`)
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

## Configuration

### `.env`

```.env
DB_HOST = 127.0.0.1
DB_NAME = ecoride
DB_USER =
DB_PASS =


APP_ENV = local
DEBUG = true
MONGO_URI = mongodb+srv://user:pass@cluster0.xxxx.mongodb.net/Ecoride
```

-   Séparation des infos sensibles
-   Adaptable pour un déploiement en production

### `config/config.php`

-   Charge `.env`
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

## Déploiement

### Hébergement O2Switch

-   L'application est déployée sur [O2Switch](https://www.o2switch.fr/).
-   PHP 8.3+ et MySQL sont nativement supportés par l’hébergement.
-   Déploiement via FTP ou Git (branche principale).

### Étapes de déploiement

1. **Préparer le projet**

    - Vérifier que `.env` contient les identifiants de la base de données de production (MySQL + MongoDB Atlas).
    - Vérifier que `APP_ENV = prod` et `DEBUG = false`.

2. **Transférer les fichiers**

    - Envoyer les fichiers du projet dans le répertoire `www/` via FTP ou Git.
    - `public/` doit être utilisé comme racine du site.

3. **Configurer la base de données**

    - Importer les fichiers SQL présents dans `/database/sql` dans phpMyAdmin (O2Switch).
    - Vérifier les accès utilisateurs MySQL.

4. **Vérifier la configuration Apache**
    - `.htaccess` redirige toutes les requêtes vers `public/index.php`.
    - Protection des fichiers sensibles activée.

### Liens utiles

-   [Documentation O2Switch](https://www.o2switch.fr/faq)
-   [phpMyAdmin O2Switch](https://phpmyadmin.o2switch.net/)

## Bonnes pratiques

-   Configuration centralisée et sécurisée
-   Séparation environnement local / prod
-   Connexion BDD fiable via PDO
-   Architecture MVC propre et maintenable
-   Sécurisation via tokens CSRF sur tous les formulaires
-   Gestion complète des crédits (transactions en attente, redistribution, remboursements)
-   Validation des avis par les employés avant publication (MongoDB)
-   Gestion des comptes suspendus (utilisateurs et employés)
-   Projet prêt pour la mise en ligne
