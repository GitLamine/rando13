<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/src/functions.php';

$title = "Réinitialiser le mot de passe";

if (isset($_GET['token']) && $_GET['token'] != '') {
    $token = $_GET['token'];
    $query = "SELECT `email` FROM `users` WHERE `token` = ?";
    $values = [$token];
    $get_email = execute_query($pdo, $query, 'fetch', $values);
    $email = $get_email['email'];

    if ($email) {
?>

        <div class="container">
            <h2 class="my-4">Veuillez choisir un nouveau mot de passe</h2>
            <form method="post" class="mb-4">
                <div class="mb-3">
                    <label for="new_password" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" name="new_password" id="new_password">
                </div>
                <button class="btn btn-primary" type="submit">Confirmer</button>
            </form>
        </div>

    <?php
    }
}

if (isset($_POST['new_password'])) {
    $hashed_password = password_hash($_POST['new_password'], PASSWORD_ARGON2ID);
    $query = "UPDATE `users` SET `password` = ?, `token` = NULL WHERE `email` = ?";
    $values = [$hashed_password, $email];
    execute_query($pdo, $query, 'fetch', $values);
    ?>

    <div class="container">
        <div class="alert alert-success mt-4">Mot de passe modifié avec succès !</div>
    </div>

<?php
}
