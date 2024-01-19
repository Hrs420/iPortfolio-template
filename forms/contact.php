<?php
// Replace 'harsh42026@gmail.com' with your real receiving email address
$receiving_email_address = 'harsh42026@gmail.com';

// Assuming this script is in the same directory as php-email-form.php
$php_email_form = 'php-email-form.php';

// Check if the PHP Email Form library exists
if (file_exists($php_email_form)) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

// Create a new instance of PHP_Email_Form
$contact = new PHP_Email_Form;
$contact->ajax = true;

// Validate and sanitize user inputs
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '';
$message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

// Perform additional form validation if needed

// Set email parameters
$contact->to = $receiving_email_address;
$contact->from_name = $name;
$contact->from_email = $email;
$contact->subject = $subject;

// Uncomment below code if you want to use SMTP to send emails. Enter your correct SMTP credentials.
/*
$contact->smtp = array(
    'host' => 'your_smtp_host',
    'username' => 'your_smtp_username',
    'password' => 'your_smtp_password',
    'port' => '587',
    'encryption' => 'tls', // Adjust encryption type if needed (tls or ssl)
);
*/

// Add message content
$contact->add_message($name, 'From');
$contact->add_message($email, 'Email');
$contact->add_message($message, 'Message', 10);

// Attempt to send the email and provide feedback
$send_result = $contact->send();

if ($send_result) {
    echo 'Success: Email sent successfully.';
} else {
    echo 'Error: Unable to send email. Please try again later.';
    // Optionally, you can log the error for debugging purposes
    // error_log($contact->get_error());
}
?>
