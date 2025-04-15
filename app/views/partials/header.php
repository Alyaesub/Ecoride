<header class="header">
    <img class="logo" src="/public/assets/Design_sans_titre-removebg-preview.png" alt="logoecoride">
    <nav class="navbar">
        <ul>
            <li><a href="<?= route('home') ?>">Accueil</a></li>
            <li><a href="<?= route('covoitVoyage') ?>">Voyages</a></li>
            <li><a href="<?= route('activites') ?>">Activités</a></li>
            <li><a href="<?= route('profil') ?>">Profil</a></li>
        </ul>
    </nav>
    <div class="login">
        <a href="<?= route('login') ?>" class="buttonlog" id="btn-log">Connectez-vous</a>
    </div>
</header>