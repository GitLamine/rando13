<?php

$titre = "Add Article";
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/src/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/src/processes/add_article_process.php';


?>

<div class="container">
    <h1 class="my-4">Ajouter un article </h1>

    <?php
    $errors = $_SESSION['errors'] ?? []; // Getting the session errors
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Titre:</label>
            <input type="text" class="form-control" name="title" id="title">
            <?php if (isset($errors['title'])) : ?>
                <div class="alert alert-danger"><?= $errors['title'] ?></div> <!-- Displaying the title error -->
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenu:</label>
            <textarea class="form-control" name="content" id="content"></textarea>
            <?php if (isset($errors['content'])) : ?>
                <div class="alert alert-danger"><?= $errors['content'] ?></div> <!-- Displaying the content error -->
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input class="form-control" type="file" name="image" id="image">
            <?php if (isset($errors['image'])) : ?>
                <div class="alert alert-danger"><?= $errors['image'] ?></div> <!-- Displaying the image error -->
            <?php endif; ?>
        </div>

        <button class="btn btn-primary" type="submit">Ajouter</button>
    </form>
</div>