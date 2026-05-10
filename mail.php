<!-- mail.php -->
<?php
// Inclusion des fichiers nécessaires de PHPMailer
require_once "Views/includes/phpmailer/Exception.php";
require_once "Views/includes/phpmailer/PHPMailer.php";
require_once "Views/includes/phpmailer/SMTP.php";

// Importation des classes de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// send mails to seubscribers
// Modification de la fonction send_newsletter pour ajouter une vérification de l'adresse e-mail
if (!function_exists('send_newsletter')) {
    function send_newsletter($subscribers, $subject, $body)
    {
        // Création d'une nouvelle instance de PHPMailer avec les exceptions activées
        $mail = new PHPMailer(true);

        try {
            // Paramétrage de PHPMailer pour utiliser SMTP
            $mail->isSMTP();
            $mail->Host = "localhost";
            $mail->Port = 1025;
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->CharSet = "UTF-8";

            // Désactivation de la sécurité SMTP
            $mail->SMTPSecure = '';
            $mail->SMTPAuth = false;

            // Paramétrage de l'e-mail pour utiliser le format HTML
            $mail->isHTML(true);

            // Paramétrage de l'adresse de l'expéditeur
            $mail->setFrom("no-reply@gmail.com");

            // Paramétrage du sujet de l'e-mail
            $mail->Subject = $subject;

            // Paramétrage du corps de l'e-mail
            $mail->Body = $body;

            // Vérification de l'adresse e-mail de chaque abonné
            foreach ($subscribers as $subscriber) {
                if (filter_var($subscriber['email'], FILTER_VALIDATE_EMAIL)) {
                    $mail->addAddress($subscriber['email']);
                    $mail->send();
                    $mail->clearAddresses();
                } else {
                    echo "Adresse e-mail non valide : " . $subscriber['email'];
                }
            }
        } catch (Exception $e) {
            // Affichage d'une erreur si l'e-mail échoue à l'envoi
            echo "Message non envoyé. Erreur: " . $mail->ErrorInfo;
        }
    }
}

if (!function_exists('send_confirmation_code')) {
    function send_confirmation_code($email, $code)
    {
        // Création d'une nouvelle instance de PHPMailer avec les exceptions activées
        $mail = new PHPMailer(true);

        try {
            // Paramétrage de PHPMailer pour utiliser SMTP
            $mail->isSMTP();
            $mail->Host = "localhost";
            $mail->Port = 1025;
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->CharSet = "UTF-8";

            // Désactivation de la sécurité SMTP
            $mail->SMTPSecure = '';
            $mail->SMTPAuth = false;

            // Paramétrage de l'e-mail pour utiliser le format HTML
            $mail->isHTML(true);

            // Ajout du destinataire de l'e-mail
            $mail->addAddress($email);

            // Paramétrage de l'adresse de l'expéditeur
            $mail->setFrom("no-reply@gmail.com");

            // Paramétrage du sujet de l'e-mail
            $mail->Subject = "Validation de la connexion";

            // Paramétrage du corps de l'e-mail
            $mail->Body = "Veuillez insérer ce code de validation : <b>" . $code . "</b><br>Attention, il n'est valable que 10 minutes.";
            $mail->AltBody = "Code de validation : " . $code . ". Attention, il n'est valable que 10 minutes.";

            // Envoi de l'e-mail
            $mail->send();
        } catch (Exception $e) {
            // Affichage d'une erreur si l'e-mail échoue à l'envoi
            echo "Message non envoyé. Erreur: " . $mail->ErrorInfo;
        }
    }
}
if (!function_exists('send_token_mail')) {
    function send_token_mail($email, $body)
    {
        // Création d'une nouvelle instance de PHPMailer
        $mail = new PHPMailer();

        try {
            // Paramétrage de PHPMailer pour utiliser SMTP
            $mail->isSMTP();
            $mail->Host = "localhost";
            $mail->Port = 1025;
            $mail->CharSet = "UTF-8";

            // Désactivation de la sécurité SMTP
            $mail->SMTPSecure = '';
            $mail->SMTPAuth = false;

            // Paramétrage de l'e-mail pour utiliser le format HTML
            $mail->isHTML(true);

            // Paramétrage de l'adresse de l'expéditeur
            $mail->setFrom("no-reply@gmail.com");

            // Ajout du destinataire de l'e-mail
            $mail->addAddress($email);

            // Paramétrage du sujet de l'e-mail
            $mail->Subject = "Réinitialisation du mot de passe";

            // Paramétrage du corps de l'e-mail
            $mail->Body = $body;

            // Envoi de l'e-mail
            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception  $e) {
            return false;
        }
    }
}
