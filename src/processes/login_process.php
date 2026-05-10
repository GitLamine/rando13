<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/src/functions.php';
if (!empty($_POST)) {

    $_SESSION['login_errors'] = [];
    $fields = ['email', 'password'];

    foreach ($fields as $field) {
        if (isset($_POST[$field]) && !empty($_POST[$field])) {
            $$field = $_POST[$field] ?? '';

            if ($field == 'email' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['login_errors']['email'] = "Adresse e-mail invalide.";
            }
        } else {
            $_SESSION['login_errors'][$field] = "Le $field est obligatoire";
        }
    }

    if (empty($_SESSION['login_errors'])) {
        $login_errors = login_user($pdo, $email, $password);

        if (is_array($login_errors) && count($login_errors) > 0) {
            $_SESSION['login_errors'] = array_merge($_SESSION['login_errors'], $login_errors);
            header("Location: /rando13/login");
            exit;
        }

        // Dans le cas où la connexion est réussie
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
            header("Location: /rando13/home");
            exit;
        }
    }
}
