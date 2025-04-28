ecoride/
│
├─ app/
│ ├─ Controllers/
│ │ ├─ HomeController.php
│ │ ├─ CovoitController.php
│ │ ├─ UserController.php
│ │ └─ ...
│ │
│ ├─ Models/
│ │ ├─ User.php
│ │ ├─ Covoit.php
│ │ └─ ...
│ │
│ ├─ Views/
│ │ ├─ partials/
│ │ │ ├─ header.php
│ │ │ ├─ footer.php
│ │ │ └─ ...
│ │ ├─ pages/
│ │ │ ├─ accueil.php
│ │ │ ├─ covoiturages.php
│ │ │ ├─ profil.php
│ │ │ └─ ...
│ │ └─ ...
│ │
│ └─ Helpers/ (optionnel)
│ └─ utilitaires, fonctions d’aide, etc.
│
├─ config/
│ ├─ database.php (infos de connexion)
│ └─ app.php (constantes, variables globales, etc.)
│
├─ routes/
│ ├─ web.php (routes principales pour l’interface web)
│ └─ api.php (routes API si tu exposes des endpoints)
│
├─ database/
│ ├─ migrations/ (fichiers de création de tables si besoin)
│ ├─ seeds/ (fichiers de remplissage de tables, si besoin)
│ └─ bddEcorideUtilisateur.sql (ton script SQL)
│
├─ public/
│ ├─ assets/
│ │ ├─ images/
│ │ └─ fonts/ (optionnel)
│ │
│ ├─ css/
│ │ ├─ main.css
│ │ ├─ formulaire.css
│ │ └─ ...
│ │
│ ├─ js/
│ │ ├─ main.js
│ │ └─ ...
│ │
│ ├─ scss/
│ │ ├─ main.scss
│ │ ├─ \_variables.scss
│ │ ├─ \_mixins.scss
│ │ └─ ...
│ │
│ ├─ index.php (point d’entrée de l’application)
│ └─ .htaccess (si tu utilises la réécriture d’URL avec Apache)
│
├─ vendor/ (si tu utilises Composer)
│
├─ README.md
└─ composer.json (si tu utilises Composer)

probleme de carosuel:

Voici l’explication claire et visuelle de ce qui se passait et pourquoi les éléments ne scrollaient pas comme prévu :
👉 Ce justify-content: center centre tous les éléments enfants dans le container .section-photo-covoit, même quand tu actives overflow-x: auto.
code vieux
.section-photo-covoit {
display: flex;
justify-content: center;
}
Résultat ?
• Le début du scroll horizontal commence au milieu.
• Donc tes deux premiers éléments (link-covoit et photo-1) sont hors écran, décalés à gauche, et tu ne peux même pas scroller vers eux car le scroll est bloqué à gauche.
• Tu arrives à la fin (photo-2, photo-3, description) uniquement parce que tu peux scroller vers la droite à partir du centre.

En remplaçant ça par :
justify-content: flex-start;
Tu dis à ton container :

“Place les éléments au début de la ligne (à gauche), laisse-les défiler ensuite vers la droite.”

Résultat :
✔️ Tous les éléments sont bien dans le flux dès le début,
✔️ Le scroll horizontal fonctionne comme prévu,
✔️ Et tu peux voir tous les éléments de gauche à droite, naturellement.

Et avec flex-shrink: 0, on a renforcé ça

Chaque .carousel-item avait aussi besoin de cette ligne :
Ça signifie :

“Ne réduis jamais la largeur de cet élément, même s’il n’y a pas assez de place.”

Sans ça, certains items pouvaient être compressés ou mal visibles dans le scroll.

Ça signifie :

“Ne réduis jamais la largeur de cet élément, même s’il n’y a pas assez de place.”

Sans ça, certains items pouvaient être compressés ou mal visibles dans le scroll.
Ce qui bloquait
Ce quâ€™on a fait
justify-content: center
remplacÃ© par flex-start

Scroll mal positionnÃ©
forcÃ© Ã  partir du dÃ©but

Items compressÃ©s
ajout de flex-shrink: 0

✅ Un layout général propre
✅ Un système de vues dynamique
✅ Un moteur de rendu centralisé
✅ Un HomeController qui respecte le MVC
✅ Un SCSS bien structuré en mobile-first
✅ Et un footer stable, qui reste à sa place, même quand le contenu est court

Voici le récap de ce que tu as en place (et qui tourne au poil) :

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

shéma d'utilisation de config
────────────────────────────────────────────
🗂️ FICHIER │ UTILISATION
────────────────────────────────────────────
config/env.ini │ Stocke les infos sensibles
│ (base de données, debug, env)
────────────────────────────────────────────
config/config.php │ Charge la config globale
│ Active le mode DEBUG
│ Définit des constantes
│ À inclure dans TOUS les fichiers PHP
────────────────────────────────────────────
app/models/ConnexionDb.php
│ Classe qui crée une connexion PDO
│ À utiliser uniquement si tu fais des requêtes SQL
────────────────────────────────────────────

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

Pour rendre le <table> scrollable sur mobile, j’ai simplement appliqué ces deux propriétés CSS :

table {
display: block; // passe le tableau en bloc pour qu’il ne prenne plus forcément 100 % du conteneur
overflow-x: auto; // active le scroll horizontal si le contenu déborde
-webkit-overflow-scrolling: touch; // (optionnel) pour un défilement plus fluide sur iOS
}
• display: block : sans ça, la plupart des navigateurs gardent le tableau en display: table, et l’overflow ne fonctionne pas comme on veut.
• overflow-x: auto : c’est ce qui crée une barre de défilement horizontale quand les colonnes dépassent la largeur de l’écran.
• -webkit-overflow-scrolling: touch (facultatif) : ça ajoute l’inertie de scroll sur Safari mobile, pour un effet plus “natif”.
