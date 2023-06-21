<?php
if (isset($_GET['delete_user'])) {
    $userId = $_GET['delete_user'];
    delete_user($pdo, $userId);
    // Redirection vers la page de profil après la suppression de l'utilisateur
    header("Location: /rando133/profile");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $subscribers = get_subsribers($pdo);
    send_newsletter($subscribers, $subject, $body);
}
$users = get_users($pdo);
