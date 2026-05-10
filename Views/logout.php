<?php
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    // Détruire la session et les données de l'utilisateur
    unset($_SESSION['user']);
    // Rediriger l'utilisateur vers la page de connexion ou la page d'accueil
    header("Location: /rando13/home");
    exit;
}
