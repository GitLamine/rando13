<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Titre</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link" href="../main/index.php">Accueil</a>
                </li>
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../main/login.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../main/register.php">Inscription</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../main/add_article.php">Ajouter article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../main/logout.php" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')">Déconnexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../main/profile.php">Profil<?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === "admin") echo " admin"; ?></a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>