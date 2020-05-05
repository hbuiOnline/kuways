<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../PHPMailer/vendor/autoload.php';

$subject = $_POST['Subject'];
$name = $_POST['Name'];
$message = $_POST['Message'];
$userEmail = $_POST['email'];



$toEmail = 'kuwayatx@gmail.com'; // Grab email from the website

$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'bugtracker2020@gmail.com';                     // SMTP username
  $mail->Password   = 'Hviponlin3';                               // SMTP password
  $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  //Recipients
  $mail->setFrom('kuwayatx@gmail.com', 'Kuwayatx');
  $mail->addAddress($toEmail);     // Add a recipient, which is ourselve

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Kuwayatx - Contact Form submitted from ' . $name;
  $mail->Body    = '<b>Name:</b>';
  $mail->Body    .= '<p>'.$name.' </p><br>';
  $mail->Body    .= '<b>Email: </b>';
  $mail->Body    .= '<a href="mailto:'.$userEmail.'">'.$userEmail.'</a><br>';
  $mail->Body    .= '<br><b>Subject:</b>';
  $mail->Body    .= '<p>'.$subject.'</p></br>';
  $mail->Body    .= '<br><b>Message:</b>';
  $mail->Body    .= '<p>'.$message.'</p>';


  if($mail->send()){
    echo 'Message has been sent';
  }
  else {
    echo 'ERROR sending email';
  }
  $mail->smtpClose();

  header("Location: ../thankyou.html");

} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
