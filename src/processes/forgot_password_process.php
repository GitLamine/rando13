<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/src/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/mail.php';


$errors = [];
$email_sent = "";
if (isset($_POST['email'])) {

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $errors['email'] = "Adresse e-mail invalide.";
        // return $errors;
    } else {
        $email_post = $_POST['email'];
        $query = "SELECT * FROM `users` WHERE `email` = ?";
        $values = [$email_post];
        $user = execute_query($pdo, $query, 'fetch', $values);

        if (!$user) {
            $errors['email'] =  "L'adresse e-mail n'existe pas.";
        } else {

            $token = uniqid(); // Generate a unique token
            $url = "http://localhost/rando13/index.php?action=new_password&token=$token";

            $body = "Veuillez vous connecter à ce lien : <a href=" . $url . "> $url </a>";
            $header = 'Content-Type : text/plain; charset="utf8"' . " ";

            if (send_token_mail($_POST['email'], $body)) { // Send email with the token
                $query = "UPDATE `users` SET token = ?  WHERE `email` = ?";
                $values = [$token, $email_post];
                $update_password = execute_query($pdo, $query, 'fetch', $values);
                $email_sent = "Email envoyé vérifiez votre boite email";
            } else {
                $errors['email'] = "An error occurred";
            }
        }
    }
}
