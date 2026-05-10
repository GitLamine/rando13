<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- <a class="navbar-brand" href="#">Titre</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link">Bonjour <?= $_SESSION['user']['first_name']; ?></a>
                        </li>
                    <?php endif ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=home">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=articles">Articles</a>
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
                            <a class="nav-link" href="index.php?action=add_article">Ajouter article</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=logout" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')">Déconnexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=profile">Profil<?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === "admin") echo " admin"; ?></a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
        <span class="logo">Rando 13</span>
    </nav>
</header>
<main>