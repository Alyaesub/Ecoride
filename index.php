<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil EcoRide</title>
    <link rel="stylesheet" href="/public/styles/css/main.css">
</head>

<body>
    <header class="header">
        <img class="logo" src="public\assets\Design_sans_titre-removebg-preview.png" alt="logoecoride">
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="app\views\pages\FormeCovoit.php">Voyages</a></li>
                <li><a href="">Activités</a></li>
                <li><a href="app/views/pages/ProfilUsers.php">Profil</a></li>
            </ul>
        </nav>
        <div class="login">
            <a href="app\views\pages\login.php" class="buttonlog" id="btn-log">Connectez-vous</a>
        </div>
    </header>

    <main class="content" id="home"> <!--Main general de la page-->
        <section class="title-search">
            <div class="title">
                <h1>Bienvenue sur EcoRide</h1>
                <p>Trouvez votre covoiturage en toute simplicité.</p>
            </div>
        </section>
        <!--Section de la seach-bar-->
        <section class="search-bar-section">
            <div class="search-bar">
                <input type="text" placeholder="Rechercher..." id="searchInput">
                <button type="submit">🔍</button>
            </div>
        </section>
        <!--Section general des pubs et de la section covoit-->
        <section class="section-photo-covoit">
            <!--div et lien qui méne au formulaire de covoit-->
            <a href="app\views\pages\FormeCovoit.php">
                <div class="link-covoit" id="link-covoit">
                    <p>Envie de voyage?<br> Cliquez ici et GO!!!!</p>
                </div>
            </a>
            <!--Section pour les pubs pour le format desktop-->
            <div class="photo-1">photo- 1</div>
            <div class="photo-2">photo- 2</div>
            <div class="photo-3">photo- 3</div>
            <div class="description">
                <p>
                    EcoRide – Le covoiturage éco-responsable 🌿🚗
                    EcoRide est la plateforme de covoiturage dédiée aux trajets en voiture, alliant économie et écologie.<br>
                    Notre mission ? Réduire l’impact environnemental des déplacements en connectant des voyageurs soucieux de la planète.<br>
                    Voyagez malin, partagez vos trajets et contribuez à un monde plus vert avec EcoRide ! 💚
                </p>
            </div>
        </section>

    </main>


    <footer class="footer">
        <p>&copy; 2024 EcoRide. Tous droits réservés.</p>
    </footer>
</body>

</html>