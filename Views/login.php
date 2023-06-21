<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando133/src/processes/login_process.php';


$title = "Connexion";
?>

<div class="container my-5">
    <h1 class="text-center mb-5">Connexion</h1>
    <section class="login">
        <div class="col-md-6">
            <form action="" method="post" id="login-form">
                <?php
                $fields = ['email' => 'Email', 'password' => 'Mot de passe'];
                foreach ($fields as $field => $label) :
                ?>
                    <div class="form-group">
                        <label for="<?= $field ?>"><?= $label ?></label>
                        <input type="<?= $field == 'email' ? 'email' : 'password' ?>" class="form-control" name="<?= $field ?>" id="<?= $field ?>" value="<?= isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : ''; ?>">
                        <?php if (isset($_SESSION['login_errors'][$field])) : ?>
                            <span class="text-danger"><?= $_SESSION['login_errors'][$field]; ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>

            <!-- Ajout du lien vers la page "Mot de passe oublié" -->
            <div class="mt-3">
                <a href="index.php?action=forgot_password">Mot de passe oublié?</a>
            </div>
        </div>
    </section>
</div>