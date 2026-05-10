<?php
// session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/database.php';
// CSRF protection
function generate_csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token(): void
{
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        http_response_code(403);
        die("Requête invalide.");
    }
}

// Function for executing a database query
function execute_query($pdo, string $query, string $fetchMode, $values = [])
{
    $stmt = $pdo->prepare($query);
    if (!$stmt->execute($values)) {
        throw new Exception("Query failed: " . $stmt->errorInfo()[2]);
    }
    return match ($fetchMode) {
        'fetch'    => $stmt->fetch(),
        'fetchAll' => $stmt->fetchAll(),
        default    => $stmt->rowCount(), // 'rowCount' pour INSERT, UPDATE, DELETE
    };
}


// login user
function login_user($pdo, $email, $password)
{
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Adresse e-mail invalide.";
        return $errors;
    }

    $query = "SELECT `id`, `first_name`, `last_name`, `email`, `password`, `role`, `city` FROM `users` WHERE `email` = ?";
    $values = [$email];
    $user = execute_query($pdo, $query, 'fetch', $values);

    if (!$user) {
        $errors['email'] = "L'adresse e-mail n'existe pas.";
        return $errors;
    } elseif (!password_verify($password, $user['password'])) {
        $errors['password'] = "Le mot de passe est incorrect.";
        return $errors;
    } else {
        // Stocker les informations de l'utilisateur dans la session
        $_SESSION['user'] = $user;
        $_SESSION['logged_in'] = true;

        return [];
    }
}

// Suppression d'un article
function deleteArticle($pdo, $id)
{
    // Récupération du nom de l'image associée à l'article
    $query = "SELECT `image` FROM `articles` WHERE `id` = ?";
    $values = [$id];
    $result = execute_query($pdo, $query, 'fetch', $values);

    if ($result && !empty($result['image'])) {
        // Chemin complet de l'image
        $imagePath = '/Rando13/uploads/' . $result['image'];

        // Suppression de l'article de la base de données
        $query = "DELETE FROM `articles` WHERE `id` = ?";
        $values = [$id];
        execute_query($pdo, $query, 'rowCount', $values);

        // Suppression de l'image du dossier "uploads"
        if (file_exists($imagePath)) {
            if (!unlink($imagePath)) {
                echo 'Erreur : impossible de supprimer l\'image ' . $imagePath;
            }
        }

        return true;
    }

    return false;
}

// validate article form data
function validateArticleForm($title, $content, $image)
{
    $errors = [];

    if (empty($title)) {
        $errors['title'] = "Le tire est requis";
    }

    if (empty($content)) {
        $errors['content'] = "Le contenu est requis";
    }

    if ($image['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['image'] = "L'image est requise";
    }

    return $errors;
}

// upload an image
function uploadImage($image)
{
    // Retrieve the temporary file and filename
    $tmpName = $image['tmp_name'];
    $filename = $image['name'];

    // Get the file extension
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Generate a unique filename
    $filename = uniqid() . '.' . $extension;

    // Set the destination location for the file
    $destination = $_SERVER['DOCUMENT_ROOT'] . '/Rando13/uploads/' . $filename;

    // Define allowed file extensions and MIME types
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    $allowedMimeTypes = array('image/jpeg', 'image/png', 'image/gif');

    // Define maximum file size (4MB)
    $maxFileSize = 4 * 1024 * 1024;

    // Array to store potential errors
    $errors = [];

    // Validate extension
    if (!in_array($extension, $allowedExtensions)) {
        $errors[] = "Type de fichier invalide.";
    }

    // Validate real MIME type (not just extension)
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $realMimeType = finfo_file($finfo, $tmpName);
    finfo_close($finfo);
    if (!in_array($realMimeType, $allowedMimeTypes)) {
        $errors[] = "Type de fichier non autorisé.";
    }

    // Validate the file size
    if ($image['size'] > $maxFileSize) {
        $errors[] = "Le fichier est trop volumineu.";
    }

    // Variable to indicate if the upload was successful
    $success = false;

    // Variable to store the image URL
    $imageUrl = null;

    // If no errors have occurred so far
    if (empty($errors)) {
        // Attempt to move the file to the destination location
        $success = move_uploaded_file($tmpName, $destination);

        // If the upload is successful
        if ($success) {
            // Construct the image URL
            $imageUrl = '/uploads/' . $filename;
        } else {
            // Add an error in case of upload failure
            $errors[] = "Erreur lors de l'upload de l'image.";
        }
    }

    // Return an array containing the success status, image URL, and any errors
    return [
        'success' => $success,
        'imageUrl' => $imageUrl,
        'errors' => $errors,
    ];
}

// validate names
function verify_name($name, $label)
{
    $errors = [];
    if (mb_strlen($name) == 0) {
        $errors[] = "Le nom " . $label . " n'éxiste pas";
    }
    // Remove HTML tags
    $name = htmlspecialchars($name);

    // Check the length
    if (mb_strlen($name) > 50) {
        $errors[] = "Le $label est trop long.";
    }
    // Check for special characters
    $pattern = '/^[\p{L}\s]+$/u';
    if (!preg_match($pattern, $name)) {
        $errors[] = "le $label doit contenir seulement des lettres et des espaces";
    }
    return $errors;
}

// validate a password
function verify_password($password)
{
    $errors = [];

    // Check the length
    if (strlen($password) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }
    // Check for characters
    if (!preg_match("#[0-9]+#", $password)) {
        $errors[] = "Le mot de passe doit contenir au moins un chiffre";
    }
    if (!preg_match("#[a-zA-Z]+#", $password)) {
        $errors[] = "Le mot de passe doit contenir au moins une lettre";
    }
    $special_chars = '!@#\$%^&*()\-=+{};:,<.>/?';
    if (strpbrk($password, $special_chars) === false) {
        $errors[] = "le mot de passe doit contenir au moins un caractère sépcial ";
    }
    if (empty($errors)) {
        return [password_hash($password, PASSWORD_ARGON2ID), $errors];
    } else {
        return [null, $errors];
    }
}



// centralized auth guard
function require_login(string $redirect = '/rando13/login'): void
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . $redirect);
        exit();
    }
}

// delete user
function delete_user($pdo, $userId)
{
    $query = "DELETE FROM `users` WHERE `id` = ?";
    $values = [$userId];
    execute_query($pdo, $query, 'rowCount', $values);
}

// get the list of users
function get_users($pdo)
{
    $query = "SELECT `id`, `first_name`, `last_name`, `email`, `role`, `city`, `created_at` FROM `users` ORDER BY `id` DESC";
    return execute_query($pdo, $query, 'fetchAll');
}

// get information about a specific user and the number of published articles
function get_user($pdo, $userId)
{
    $query = "SELECT users.id, users.first_name, users.last_name, users.email, users.role, users.city, users.created_at,
                     COUNT(articles.id) AS article_count
              FROM users
              LEFT JOIN articles ON users.id = articles.user_id
              WHERE users.id = ?
              GROUP BY users.id";
    $values = [$userId];
    return execute_query($pdo, $query, 'fetch', $values);
}

// validate a city name
function validate_city($cityName)
{
    $errors = [];
    if (empty($cityName)) {
        $errors[] = "City name is required.";
        // To be completed (retrieve the list of cities displayed via JavaScript and use them in PHP)
    }
    return $errors;
}


function get_subsribers($pdo)
{
    $subscribers = [];
    $query = "SELECT `email` FROM `newsletter_subscribers`";
    $subscribers = execute_query($pdo, $query, 'fetchAll');

    return $subscribers;
}