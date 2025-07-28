<?php
// Anti-spam: honeypot
if (!empty($_POST['website'])) {
    exit("Spam detected.");
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

echo"hi";

?>
