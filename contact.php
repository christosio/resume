<?php
// Anti-spam: honeypot
if (!empty($_POST['website'])) {
    exit("Spam detected.");
}

// Google reCAPTCHA verification
$recaptchaSecret = "6LcTiY8rAAAAAOAyPHxUgPNluPRTMAqjxj4HADqC";
$response = $_POST['g-recaptcha-response'];
$verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$response");
$captcha_success = json_decode($verify)->success;

if (!$captcha_success) {
    exit("reCAPTCHA failed. Are you a robot?");
}

// Collect form data
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);

// Email setup
$to = "christosiwannides@christosio.uk"; // YOUR email
$subject = "New Contact Message";
$headers = "From: $email\r\nReply-To: $email";

mail($to, $subject, $message, $headers);

?>
