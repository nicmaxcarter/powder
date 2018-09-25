<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// EDIT THE 4 LINES BELOW AS REQUIRED
$email_to = "codobitdev@gmail.com";
$email_display = "forms@codobit.com";
$email_subject = "New Form Submission!";
// $email_bcc = "codobit@gmail.com";

// Form components
$full_name = $_POST['full-name-input']; // required
$email = $_POST['email-input ']; // required
$subject = $_POST['subject-input'];
$message = $_POST['message-area']; // required

$error_message = "";
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

// if (!preg_match($email_exp, $email_from)) {
//     $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
// }

// This is the formatting for the message sent via email

$email_message = "Form details below.\n\n";

function clean_string($string)
{
    $bad = array("content-type", "bcc:", "to:", "cc:", "href");
    return str_replace($bad, "", $string);
}

$email_message .= "Name: " . clean_string($full_name) . "\n";
$email_message .= "Email: " . clean_string($email) . "\n";
$email_message .= "Subject: " . clean_string($subject) . "\n";
$email_message .= "Message: " . clean_string($message) . "\n";

// Set content-type header for sending HTML email
// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// $email_message = "<html><body>
//       <h1>
//         HEADING
//       </h1>
//     <p>
//           est paragraph
//         </p>
//       </body></html>";

// create email headers
$headers = 'From: ' . $email_display . "\r\n" .
'Reply-To: ' . $email_from . "\r\n" .
'BCC: ' . $email_bcc . "\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);

// Redirect to a thank you page
header('Location: ./thank-you.html');
