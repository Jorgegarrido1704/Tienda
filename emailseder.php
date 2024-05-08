<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Rest of your code...


error_reporting(E_ALL);
ini_set('display_errors', '1');

// Recipient email address
$to = 'garridofth1@outlook.com';

// Subject of the email
$subject = 'Your Subject Here';

// Sender's email address
$from = 'garridofth1@outlook.com';

// Message body
$message = 'Please find the attached SQL or Excel document.';

// Path to the file you want to attach
//$file_path = '/path/to/your/file.sql'; // Change this to the actual path of your SQL or Excel file

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.outlook.com'; // Replace with your SMTP server address
    $mail->SMTPAuth   = true;
    $mail->Username   = 'garridofth1@outlook.com'; // Replace with your SMTP username
    $mail->Password   = 'Garridom.13'; // Replace with your SMTP password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom($from);
    $mail->addAddress($to);

    // Attach file
//    $mail->addAttachment($file_path);
    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    // Send the email
    $mail->send();
    echo 'Email sent successfully.';
} catch (Exception $e) {
    echo 'Error sending email: ', $mail->ErrorInfo;
}
?>
