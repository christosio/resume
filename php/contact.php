<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));
    $honeypot = trim($_POST["website"]); // Spam trap

    // Basic validation
    if (!$name || !$email || !$message) {
        echo "All fields are required.";
        exit;
    }

    // Honeypot: if filled, it's a bot
    if (!empty($honeypot)) {
        echo "Spam detected (honeypot filled).";
        exit;
    }

    // Message length check
    if (strlen($message) > 1000) {
        echo "Message is too long.";
        exit;
    }

    // Spam word filter
    $blacklist = ["viagra", "cialis", "porn", "sex", "http", "https", "url=", "[url"];
    foreach ($blacklist as $word) {
        if (stripos($message, $word) !== false) {
            echo "Spam content detected.";
            exit;
        }
    }

    // Send email
    $to = "christosiwannides@christosio.uka"; // <-- change this
    $subject = "Contact Form Message";
    $headers = "From: $email\r\nReply-To: $email\r\n";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent successfully.";
    } else {
        echo "Failed to send message.";
    }
} else {
    echo "Invalid request.";
}
?>
