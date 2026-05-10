<!-- register.php -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/src/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/src/processes/register_process.php';

$title = "Inscription";
// var_dump($_SESSION);
?>
<section class="singup">
    <h1>Inscription</h1>
    <form action="" method="POST" class="needs-validation" novalidate>
        <?php
        $fields = [
            'first_name' => ['label' => 'Prénom', 'type' => 'text'],
            'last_name' => ['label' => 'Nom', 'type' => 'text'],
            'email' => ['label' => 'Adresse E-mail', 'type' => 'email'],
            'password' => ['label' => 'Mot de passe', 'type' => 'password'],
            'city' => ['label' => 'Code Postal', 'type' => 'text'],
            'newsletter' => ['label' => '', 'type' => 'checkbox']
        ];

        foreach ($fields as $fieldName => $fieldData) {
        ?>
            <div class="col-md-6">
                <label for="<?= $fieldName; ?>" class="form-label"><?= $fieldData['label']; ?></label>
                <?php if ($fieldData['type'] === 'checkbox') : ?>
                    <div class="form-check">
                        <input type="<?= $fieldData['type']; ?>" name="<?= $fieldName; ?>" id="<?= $fieldName; ?>" class="form-check-input">
                        <label class="form-check-label" for="<?= $fieldName; ?>">S'abonner à la newsletter</label>
                    </div>
                <?php else : ?>
                    <input type="<?= $fieldData['type']; ?>" name="<?= $fieldName; ?>" id="<?= $fieldName; ?>" class="form-control" <?php if ($fieldName !== 'password') : ?> value="<?= $_POST[$fieldName] ?? ''; ?>" <?php endif; ?>>
                <?php endif; ?>
                <!-- Gestion des erreurs -->
                <?php if (isset($_SESSION['errors'][$fieldName]) && !empty($_SESSION['errors'][$fieldName])) {
                    $errors = $_SESSION['errors'][$fieldName];
                    if (is_array($errors)) {
                        foreach ($errors as $error) {
                            echo '<div class="text-danger">' . $error . '</div>';
                        }
                    } else {
                        echo '<div class="text-danger">' . $errors . '</div>';
                    }
                }
                ?>
            </div>
        <?php
        }
        ?>
        <div class="mb-3">
            <div class="city_list"></div>
        </div>
        <?php
        // Supprimez les erreurs de la session une fois qu'elles ont été affichées
        if (isset($_SESSION['errors'])) {
            $_SESSION['errors'] = [];
        }
        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['user'])) {
            // Rediriger l'utilisateur vers une autre page
            header("Location: index.php?action=login.php");
            exit;
        }
        ?>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</section>