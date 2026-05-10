<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/rando13/src/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/rando13/src/processes/articles_process.php';
$titre = "Accueil";
// var_dump($datas);
?>
<div class="container">
    <h2 class="my-4">Articles :</h2>

    <?php foreach ($datas as $data) : ?>
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="card-title"><?= htmlspecialchars($data["title"]); ?></h2>
            </div>

            <div class="card-body">
                <h4>Article créé par : <?= htmlspecialchars($data['first_name']) ?>, <?= htmlspecialchars($data['last_name']) ?> </h4>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') : ?>
                    <h5 class="card-subtitle mb-2 text-muted">ID : <?= htmlspecialchars($data["id"]); ?></h5>
                <?php endif; ?>

                <time class="card-subtitle mb-2 text-muted">Article ajouté le : <?= htmlspecialchars($data["created_at"]); ?></time>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') : ?>
                    <a href="rando13/index.php?action=articles&delete_article=<?= $data['id']; ?>" class="card-link" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer cet article</a>
                <?php endif; ?>

                <p class="card-text"><?= $data["content"]; ?></p>
                <img class="img-fluid" src="/rando13<?= $data["image"]; ?>" alt="<?= $data["image"]; ?>">
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Pagination -->
    <nav>
        <ul class="pagination">
            <?php if ($currentPage > 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="rando13/index.php?action=articles&page=<?= $currentPage - 1; ?>">Précédent</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?= ($i == $currentPage) ? 'active' : ''; ?>">
                    <a class="page-link" href="rando13/index.php?action=articles&page=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages) : ?>
                <li class="page-item">
                    <a class="page-link" href="rando13/index.php?action=articles&page=<?= $currentPage + 1; ?>">Suivant</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>