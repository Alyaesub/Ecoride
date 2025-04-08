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
        <section class="section-photo-covoit carousel">
            <a href="app/views/pages/FormeCovoit.php">
                <div class="carousel-item link-covoit " id="link-covoit">
                    <p>envie de voyager ? GO!!</p>
                </div>
            </a>
            <div class=" photo-1 carousel-item">photo 1</div>
            <div class=" photo-2 carousel-item">photo 2</div>
            <div class=" photo-3 carousel-item">photo 3</div>
            <div class=" description carousel-item">
                <h2>Pourquoi choisir EcoRide ?</h2>
                <p>EcoRide est la plateforme idéale pour trouver des trajets en covoiturage.<br>
                    Que vous soyez conducteur ou passager, nous vous mettons en relation avec d'autres<br>
                    utilisateurs pour partager vos trajets et réduire vos coûts de transport.</p>
            </div>
        </section>

    </main>


    <footer class="footer">
        <p>&copy; 2024 EcoRide. Tous droits réservés.</p>
    </footer>
</body>

</html>