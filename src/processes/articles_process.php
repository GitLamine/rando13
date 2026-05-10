<?php

if (isset($_GET['delete_article'])) {
    $id = $_GET['delete_article'];
    deleteArticle($pdo, $id);
    header("Location: /rando13/articles");
    exit();
}
// Pagination
$articlesPerPage = 3; // Nombre d'articles par page

// Récupération du numéro de page courante
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Calcul de l'index de départ
$startIndex = ($currentPage - 1) * $articlesPerPage;

// Récupération des articles pour la page courante
$query = " SELECT articles.*,
users.first_name, users.last_name
FROM articles
JOIN users ON articles.user_id = users.id
ORDER BY created_at
DESC LIMIT $startIndex, $articlesPerPage";
$datas = execute_query($pdo, $query, 'fetchAll');

// Récupération du nombre total d'articles
$totalArticles = $pdo->query("SELECT COUNT(*) FROM articles")->fetchColumn();

// Calcul du nombre total de pages
$totalPages = ceil($totalArticles / $articlesPerPage);
