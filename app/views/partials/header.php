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
        <?php if (!empty($_SESSION['user_id'])) : ?>
            <button class="buttonlog" id="btn-log">Vous êtes connecté</button>
        <?php else : ?>
            <a href="<?= route('login') ?>" class="buttonlog" id="btn-log">Connectez-vous</a>
        <?php endif; ?>
    </div>
</header>