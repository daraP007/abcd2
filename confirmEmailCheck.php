<?php
//Load Composer's autoloader
require_once 'vendor/autoload.php';
require_once 'db_configuration.php';
$email = $db->escape_string($_POST['email']);
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($db, $sql);
if ($result !== false && $result->num_rows == 0 ){ // User doesn't exist   
   header("Location: confirmEmail.php?status=error");
   exit();
}else{
   $baseURL = "https://abcd2.projectabcd.com/confirmPassword.php"; // Replace with your actual domain and resetpassword.php path
   $token = bin2hex(random_bytes(32)); // Generate a random token for the link
   $hashToken = password_hash($token, PASSWORD_DEFAULT);
   $link = $baseURL . "?token=" . $hashToken."&email=".$email; // Append the token as a query parameter to the link
   sendResetPasswordEmail($db,$email, $link,$hashToken); // You need to implement this function to send the reset password email
   header("Location: confirmEmail.php?status=success");
   exit();
   //ob_flush();
}
// Function to send the reset password email
function sendResetPasswordEmail($db,$email, $resetPasswordLink,$hashToken)
{
   try{
      $email_settings = parse_ini_file("config.ini");
      ini_set('SMTP', $email_settings["SMTP"]);
      ini_set('smtp_port', $email_settings["smtp_port"]);
      ini_set('sendmail_from', $email_settings["sendmail_from"]);
      $message = "Dear user,\n\n";
      $message .= "Click on the link below to reset your password:\n";
      $message .= $resetPasswordLink;
      $message .= "\n\nIf you did not request a password reset, please ignore this email.";
      //$mail->isSMTP();                                      // Set mailer to use SMTP
      //$mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
      //$mail->SMTPAuth = true;                               // Enable SMTP authentication
      //$mail->Username = 'ics_abcd@projectabcd.com';                 // SMTP username
      //$mail->Password = 'iLoveMetro';                           // SMTP password
      //$mail->SMTPSecure = 'tls';                              
      //$mail->setFrom('email@projectabcd.com', 'Mailer');
      //$mail->addAddress($email, 'You');     // Add a recipient
      //$mail->Subject = "Reset Your Password";
      //$mail->Body    = $message; 
      //$mail->send();
      $email_subject = "Password Reset Link";
      $email_headers = 'From:noreply@projectabcd.com'."\r\n";
      mail($email, $email_subject, $message, $email_headers);
      $expFormat = mktime(
         date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
         );
      $expDate = date("Y-m-d H:i:s",$expFormat);
      $sql = "INSERT INTO `password_reset_temp` (`email`, `token`, `expDate`) VALUES ('".$email."', '".$hashToken."', '".$expDate."');";
      $result = mysqli_query($db, $sql);
   }catch (Exception $e) {
      //echo var_dump($mail->ErrorInfo);
  }
}?>