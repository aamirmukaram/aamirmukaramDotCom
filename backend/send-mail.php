<?php

// site owner infos
$email_to = 'aamir@aamirmukaram.com';
$success_message = "Your message has been successfully sent.";
$site_name = 'aamirmukaram.com';

// contact form fields
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$message = trim($_POST['message']);
$submitted = $_POST['submitted'];

// contact form submitted
if (isset($submitted)) {
    // check for error
    if ($name === '') {
        $name_empty = true;
        $error = true;
    } elseif ($email === '') {
        $email_empty = true;
        $error = true;
    } elseif ($message === '') {
        $message_empty = true;
        $error = true;
    }
    // end check for error

    // error
    if (isset($error)) {
        echo '<div class="alert alert-error contact-alert"><strong>UNSUCCESS! </strong><ul>';

        if ($name_empty) {
            echo '<li>Required</li>';
        } elseif ($email_empty) {
            echo '<li>Required</li>';
        } elseif ($email_unvalid) {
            echo '<li>Please enter a valid email address</li>';
        } elseif ($message_empty) {
            echo '<li>Required</li>';
        } else {
            echo '<li>An error has occurred while sending your message. Please try again later.</li>';
        }

        echo "</ul></div>";
    }
    // end error

    // no error send mail
    if (!isset($error)) {
        $subject = 'Contact form message from your ' . $site_name . ' site';

        $body = "Name: $name \n\nEmail: $email \n\nMessage: $message";

        $headers = 'From: ' . $name . ' <' . $email . '> ' . "\r\n" . 'Reply-To: ' . $email;

        ///
        //SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
        date_default_timezone_set('Etc/UTC');

        require './vnedor/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = 'mail.aamirmukaram.com';
$mail->Port = 26;
$mail->SMTPSecure = false;
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = $email_to;

//Password to use for SMTP authentication
        $mail->Password = "++++Arbisoft@123";

//Set who the message is to be sent from
        $mail->setFrom($email, $name);


        $mail->addReplyTo($email, $name);


//Set who the message is to be sent to
        $mail->addAddress($email_to, 'Aamir Mukaram');

//Set the subject line
        $mail->Subject = $subject;

        $mail->Body = $body;

//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo '<div class="alert alert-success contact-alert"><strong>SUCCESS! </strong>' . $success_message . '</div>';
        }

        ///


    }
    // end no error send mail

}
// end contact form submitted

?>