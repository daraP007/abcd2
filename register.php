<?php
session_start();

//Enable mySQL error messages
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

require 'db_configuration.php';

/* User registers as a new user, (checks if user exists and password is correct) */
if (isset($_POST['password']) && isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['last_name'])) {
    //escape email to protect against SQL injections
    $pass = $db->escape_string($_POST['password']);

    //hash password to store in DB
    $hashPass = password_hash($pass, PASSWORD_DEFAULT);

    $email = $db->escape_string($_POST['email']);
    $first_name = $db->escape_string($_POST['first_name']);
    $last_name = $db->escape_string($_POST['last_name']);

    // (SU23-30) (Feature) create an email validation token
    // reference https://code.tutsplus.com/how-to-implement-email-verification-for-new-members--net-3824t
    $email_validation = md5(rand(0, 1000));
    $email_validation = substr($email_validation, 0, 10); // chop validation to 10 digits since database field only holds 10

    //insert user info into DB
    $sql = "INSERT INTO users (first_name, last_name, email, hash, active, role, modified_time, created_time)
            VALUES ('$first_name', '$last_name', '$email', '$hashPass', '$email_validation', 'user', '0000-00-00', '0000-00-00')";

    if (mysqli_query($db, $sql)) {
        // read config.ini
        $email_settings = parse_ini_file("config.ini");
        // case where unable to read config file
        if(!$email_settings) echo "failed to read config.ini";
        else {
            // SMTP server
            // reference https://stackoverflow.com/questions/25909348/how-to-send-email-with-smtp-in-php
            ini_set('SMTP', $email_settings["SMTP"]);
            ini_set('smtp_port', $email_settings["smtp_port"]);
            ini_set('sendmail_from', $email_settings["sendmail_from"]);

            // send validation email
            $email_subject = 'Signup | Validation';
            $email_message = '

            Your account has been created. Please click this link to activate your account:
            '.$email_settings["URL"].'/validation.php?email='.$email.'&email_validation='.$email_validation.'
            
            ';
            $email_headers = 'From:noreply@projectabcd.com'."\r\n";
            
            if(mail($email, $email_subject, $email_message, $email_headers)){
                $_SESSION['status'] = "Sucess";
                $_SESSION['email'] = $email;
                header("location: validation.php");
            }
            else {
                echo "email failed";
            }
        }
    }
    // case where the sql insert failed
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}
?>