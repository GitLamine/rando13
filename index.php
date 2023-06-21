<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/Views/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/Views/includes/navbar.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/database.php';

$action = $_GET['action'] ?? 'default';
switch ($action) {
    case '':
    case 'home':
        require 'Views/home.php';
        break;
    case 'add_article':
        require 'Views/add_article.php';
        break;
    case 'login':
        require 'Views/login.php';
        break;
    case 'register':
        require 'Views/register.php';
        break;
    case 'profile':
        require 'Views/profile.php';
        break;
    case 'articles':
        require 'Views/articles.php';
        break;
    case 'forgot_password':
        require 'Views/forgot_password.php';
        break;
    case 'logout':
        require 'Views/logout.php';
        break;
    case 'new_password':
        require 'Views/new_password.php';
        break;
    default:
        require 'Views/404.php';
        break;
}
include_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/Views//includes/footer.php';
