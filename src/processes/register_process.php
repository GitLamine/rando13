<?php

// conditionner l'inscription
if (!empty($_POST)) {
    $email_errors = [];

    // vérification
    if (
        isset($_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["password"], $_POST["city"])
        && !empty($_POST["first_name"]) && !empty($_POST["last_name"]) && !empty($_POST['email']) && !empty($_POST["password"]) && !empty($_POST['city'])
    ) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $first_name_errors = verify_name($first_name, "Prénom");
        $last_name_errors = verify_name($last_name, "Nom");

        // email
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $email_errors[] = "Adresse email incorrecte.";
        } else {
            $email = $_POST["email"];
            // vérification de l'existance de l'email
            $email_check_query = "SELECT * FROM `users` WHERE `email` = ?";
            $email_check_values = [$email];
            $email_check_result = execute_query($pdo, $email_check_query, 'fetch', $email_check_values);
            if (!empty($email_check_result)) {
                $email_errors[] = "Cet email est deja utilisé.";
            }
        }
        // mot de pass
        $password = $_POST['password'];
        // Vérification et hachage du mot de passe
        list($hashed_password, $password_errors) = verify_password($password);

        // code postale 
        $city = $_POST['city'];
        $city_errors = validate_city($city);

        // Ajout des erreurs à la variable de session
        $_SESSION['errors'] = [];

        // Ajouter les erreurs par champ
        if (!empty($first_name_errors)) {
            $_SESSION['errors']['first_name'] = $first_name_errors;
        }
        if (!empty($last_name_errors)) {
            $_SESSION['errors']['last_name'] = $last_name_errors;
        }
        if (!empty($email_errors)) {
            $_SESSION['errors']['email'] = $email_errors;
        }
        if (!empty($password_errors)) {
            $_SESSION['errors']['password'] = $password_errors;
        }
        if (!empty($city_errors)) {
            $_SESSION['errors']['city'] = $city_errors;
        }
        if (empty($_SESSION['errors'])) {
            $role_user = 'user';
            $role_admin = 'admin';

            // set user
            $query = "INSERT INTO `users`(`first_name`,`last_name`,`email`,`password`,`role`,city) VALUES (?,?,?,?,?,?)";
            $values = [
                $first_name, $last_name, $email, $hashed_password, $role_user, $city
            ];
            $result = execute_query($pdo, $query, 'insert', $values);

            // get ID user
            $user_id = $pdo->lastInsertId();

            // add subscribers
            if (isset($_POST['newsletter'])) {
                // Insérer l'ID de l'utilisateur dans la table newsletter_subscribers
                $newsletter_query = "INSERT INTO newsletter_subscribers (user_id, email) VALUES (?,?)";
                $newsletter_values = [$user_id, $email];
                execute_query($pdo, $newsletter_query, 'insert', $newsletter_values);
            }


            // Redirection vers la même page ou une autre page après l'insertion réussie
            header("location: /rando13/login");
            exit;
        }
    } else {
        // Si l'un des champs n'est pas défini ou est vide, ajoutez une erreur correspondante
        $fields = [
            "first_name" => "Le prénom est requis",
            "last_name" => "Le nom est requis",
            "email" => "Adresse email manquante",
            "password" => "Le mot de passe est requis",
            "city" => "Le code postal est requise"
        ];

        foreach ($fields as $field => $error_message) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                $_SESSION['errors'][$field] = [$error_message];
            }
        }
    }
}
