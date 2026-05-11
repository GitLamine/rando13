<header>
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php?action=home">
                <span class="logo">Rando<em>13</em></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=home">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=articles">Randonnées</a>
                    </li>
                    <?php if (!isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=login">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=register">Inscription</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=profile">Mon profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=logout" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')">Déconnexion</a>
                        </li>
                    <?php endif ?>
                </ul>
                <a href="index.php?action=add_article" class="btn btn-cta ms-3">Partager une rando</a>
            </div>
        </div>
    </nav>
</header>
<main>