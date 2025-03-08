<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide</title>
    <link rel="stylesheet" href="styles\css\main.css">
</head>

<body>
    <header class="header">
        <img class="logo" src="assets/Design_sans_titre-removebg-preview.png" alt="logoecoride">
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="FormeCovoit.php">Voyages</a></li>
                <li><a href="">Activités</a></li>
                <li><a href="">Profil</a></li>
            </ul>
        </nav>
        <div class="login">
            <button class="buttonlog" id="btn-log">Connectez vous</button>
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
        <section class="section-pubs-covoit">
            <!--div et lien qui méne au formulaire de covoit-->
            <a href="FormeCovoit.php">
                <div class="link-covoit" id="link-covoit">
                    <p>Envie de voyage?<br> Cliquez ici et GO!!!!</p>
                </div>
            </a>
            <!--Section pour les pubs pour le format desktop-->
            <div class="pub-1">PUB 1</div>
            <div class="pub-2">PUB 2</div>
        </section>

    </main>


    <footer class="footer">
        <p>&copy; 2024 EcoRide. Tous droits réservés.</p>
    </footer>
</body>

</html>