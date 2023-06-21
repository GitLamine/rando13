<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/src/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/src/processes/profile_process.php';

$titre = "Profile";
$curent_user = $_SESSION['user'];
echo "<br";
?>
<div class="container mt-3">
    <h2>Vos informations</h2>
    <ul class="list-group">
        <li class="list-group-item">
            <strong>Prénom utilisateur:</strong> <?= $curent_user['first_name']; ?>
        </li>
        <li class="list-group-item">
            <strong>Nom utilisateur:</strong> <?= $curent_user['last_name']; ?>
        </li>
        <li class="list-group-item">
            <strong>Email:</strong> <?= $curent_user['email']; ?>
        </li>
        <li class="list-group-item">
            <strong>Ville:</strong> <?= $curent_user['city']; ?>
        </li>
    </ul>
</div>

<?php
if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === "admin") { ?>

    <!-- send a newsletter -->
    <div class="container mt-3">
        <h2>Ajouter une Newsletter</h2>
        <form action="profile.php" method="POST">
            <div class="form-group">
                <label for="subject">Sujet :</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="body">Contenu :</label>
                <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer la Newsletter</button>
        </form>
    </div>

    <!-- Contenu de la partie admin -->

    <div class="container mt-3">
        <h2>Liste des Utilisateurs</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Prénom utilisateur</th>
                    <th scope="col">Nom utilisateur</th>
                    <th scope="col">Email</th>
                    <th scope="col">City</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($users as $user) : ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']); ?></td>
                        <td><?= htmlspecialchars($user['first_name']); ?></td>
                        <td><?= htmlspecialchars($user['last_name']); ?></td>
                        <td><?= htmlspecialchars($user['email']); ?></td>
                        <td><?= htmlspecialchars($user['city']); ?></td>
                        <td><?= htmlspecialchars($user['role']); ?></td>
                        <td>
                            <?php if ($user['role'] !== 'admin') : ?>
                                <a href="rando13/index.php?action=profile&delete_user=<?= $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php
}
