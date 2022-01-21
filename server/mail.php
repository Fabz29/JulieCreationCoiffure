<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require 'vendor/autoload.php';

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
$sender = 'contact@julie-creation-coiffure.fr';
$senderName = 'Julie Creation Coiffure';

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
$recipient = 'juliezanetti3@gmail.com';

// Replace smtp_username with your Amazon SES SMTP user name.
$usernameSmtp = $_ENV['SMTP_USER'];

// Replace smtp_password with your Amazon SES SMTP password.
$passwordSmtp = $_ENV['SMTP_PASSWORD'];

// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
//$configurationSet = 'ConfigSet';

// If you're using Amazon SES in a region other than US West (Oregon),
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
// endpoint in the appropriate region.
$host = 'email-smtp.eu-west-3.amazonaws.com';
$port = 587;

if(isset($_GET['subject']) && $_GET['subject'] === 'appointment') {
    $subject = 'Demande de rendez-vous';

    if($_POST['dateDesktop'] !== '') {
        $date = \DateTime::createFromFormat('Y-m-d', $_POST['dateDesktop']);
    } elseif ($_POST['dateMobile'] !== ''){
        $date = \DateTime::createFromFormat('Y-m-d', $_POST['dateMobile']);
    }

    $bodyHtml = '<h1>Demande de rendez-vous</h1>
    <ul>
        <li>
        	Nom complet: ' . $_POST['fullName'] . '
		</li>
      	<li>
        	Email: <a href="mailto:' . $_POST['email'] . '">' . $_POST['email'] . '</a>
		</li>
      	<li>
        	Téléphone: <a href="tel:' . $_POST['phone'] . '">' . $_POST['phone'] . '</a> 
		</li>
      	<li>
        	Date: ' . $date->format('d-m-Y') . ' à ' . $_POST['time'] . '
		</li>
      	<li>
        	Description: ' . $_POST['description'] . '
		</li>
    </ul>';
} else {
    $subject = 'Message de contact';

    $bodyHtml = '<h1>Message de contact</h1>
    <ul>
        <li>
        	Prénom: ' . $_POST['fullName'] . '
		</li>
      	<li>
        	Email: <a href="mailto:' . $_POST['email'] . '">' . $_POST['email'] . '</a>
		</li>
      	<li>
        	Téléphone: <a href="tel:' . $_POST['phone'] . '">' . $_POST['phone'] . '</a> 
		</li>
      	<li>
        	Message: ' . $_POST['description'] . '
		</li>
    </ul>';
}


$mail = new PHPMailer(true);

try {
    // Specify the SMTP settings.
    $mail->isSMTP();
    $mail->setFrom($sender, $senderName);
    $mail->Username = $usernameSmtp;
    $mail->Password = $passwordSmtp;
    $mail->Host = $host;
    $mail->Port = $port;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
//    $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

    // Specify the message recipients.
    $mail->addAddress($recipient);
    // You can also add CC, BCC, and additional To recipients here.

    // Specify the content of the message.
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $bodyHtml;
    $mail->Send();
    echo "1", PHP_EOL;
} catch (phpmailerException $e) {
    echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
} catch (Exception $e) {
    echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
}

?>