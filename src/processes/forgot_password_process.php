<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/src/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/mail.php';


$errors = [];
$email_sent = "";
if (isset($_POST['email'])) {

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Adresse e-mail invalide.";
    } else {
        $email_post = $_POST['email'];
        $query = "SELECT `id`, `email` FROM `users` WHERE `email` = ?";
        $values = [$email_post];
        $user = execute_query($pdo, $query, 'fetch', $values);

        if (!$user) {
            $errors['email'] = "L'adresse e-mail n'existe pas.";
        } else {
            $token = bin2hex(random_bytes(32));
            $url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/rando13/index.php?action=new_password&token=' . $token;
            $body = "Veuillez vous connecter à ce lien : <a href=" . $url . "> $url </a>";

            if (send_token_mail($_POST['email'], $body)) {
                $query = "UPDATE `users` SET token = ? WHERE `email` = ?";
                $values = [$token, $email_post];
                execute_query($pdo, $query, 'rowCount', $values);
                $email_sent = "Email envoyé, vérifiez votre boite mail.";
            } else {
                $errors['email'] = "Une erreur est survenue, réessayez plus tard.";
            }
        }
    }
}
