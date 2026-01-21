<?php

require_once __DIR__ . '/config.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';
require __DIR__ . '/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subjectInput = trim($_POST['sub'] ?? '');
$message = trim($_POST['message'] ?? '');

if (!$name || !$email || !$message) {
    header('Location: /contact.html?status=invalid');
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;
    $mail->Port = SMTP_PORT;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->setFrom(SMTP_USERNAME, 'Blinky Website');
    $mail->addReplyTo($email, $name);
    $mail->addAddress(PARTNER_RECEIVER_EMAIL);

    $mail->Subject = $subjectInput ?: 'New Contact Message';
    $mail->Body =
        "Name: $name\n" .
        "Email: $email\n\n" .
        "Message:\n$message\n";

    $mail->send();

    header('Location: /contact.html?status=success');
    exit;

} catch (Exception $e) {
    error_log('Mail Error: ' . $mail->ErrorInfo);
    header('Location: /contact.html?status=error');
    exit;
}
?>