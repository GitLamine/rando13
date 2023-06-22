<?php

if (!empty($_POST)) {
    $title = htmlspecialchars(strip_tags($_POST["title"]));
    $content = htmlspecialchars(strip_tags($_POST["content"]));
    $image = $_FILES['image'];
    $user_id = isset($_SESSION['user']);

    $validationErrors = validateArticleForm($title, $content, $image);

    if (empty($validationErrors)) {

        // Set the destination location for the file
        $uploadResult = uploadImage($image, $destination);
        if ($uploadResult['success']) {
            // requête d'ajout d'article
            $query = "INSERT INTO `articles`(`title`,`content`,`image`, user_id) VALUES (?,?,?,?)";
            $values = [$title, $content, $uploadResult['imageUrl'], $user_id];
            $result = execute_query($pdo, $query, 'insert', $values);
            header("location: /rando13/articles");
            exit();
        } else {
            $validationErrors['image'] = implode(', ', $uploadResult['errors']);
        }
    }
    $_SESSION['errors'] = $validationErrors;
}
