<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/src/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Rando13/src/processes/forgot_password_process.php';


?>

<div class="container my-5">
    <h1 class="text-center mb-5">Forgot Password</h1>
    <section class="row justify-content-center">
        <div class="col-md-6">
            <form action="" method="post" id="password-reset-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                    <span class="text-danger"><?= isset($errors['email']) ? $errors['email'] : ""; ?></span>
                </div>
                <input type="submit" value="Confirm">
            </form>
            <h5><?= $email_sent ?></h5>
        </div>
    </section>
</div>
>