<?php
// Function to handle errors and redirect to error page
function handleError() {
    header("Location: /error.html"); // Adjust the path as needed
    exit();
}

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize the input values to prevent XSS attacks
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Set the recipient email address
    $to = "benardodero21@gmail.com";
    $subject = "New Contact Form Submission from $name";

    // Set up the email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Prepare the email body
    $body = "You have received a new message from your website contact form:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Message:\n$message\n";

    // Attempt to send the email
    if (mail($to, $subject, $body, $headers)) {
        // If email sent successfully, redirect to a success page (optional)
        header("Location: /thank-you.html"); // Adjust the path to your success page
        exit();
    } else {
        // If email fails, redirect to the error page
        handleError();
    }
} else {
    // If the form is not submitted via POST, redirect to the error page
    handleError();
}
?>
