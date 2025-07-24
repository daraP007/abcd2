<?php
require 'db_configuration.php';
include('header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Validation</title>
    <link href="css/loginForm.css" rel="stylesheet">
</head>
<body>
    <div class="tab-content">
        <div id="login">

            <?php
            // (SU23-30) (Feature) user email validation
            // this path is followed when user clicks the link in their validation email
            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['email_validation']) && !empty($_GET['email_validation'])){
                // Verify user submission against database
                $email = $db->escape_string($_GET['email']);
                $email_validation = $db->escape_string($_GET['email_validation']);
                $sql = "SELECT email, active FROM users WHERE email='".$email."' AND active='".$email_validation."'";
                $match = run_sql($sql)->num_rows;

                // valid match
                if($match > 0) {
                    $sql = "UPDATE users SET active='yes' WHERE email='".$email."' AND active='".$email_validation."'";
                    if (mysqli_query($db, $sql)) {
                        // account successfully activated
                        echo "Your account has been activated.</br>
                        Please proceed to the login page.";
                    }
                }
                else {
                    // invalid URL or account already activated
                    echo "This URL is invalid.</br>
                    If you are trying to activate an account, then it may already be active.";
                }

            }
            // this path is followed if the user's account is created but not activated
            else if (isset($_SESSION['email'])){
                // this shows after registration
                echo "A validation link was sent to your email ".$_SESSION['email'].".</br>
                Please click the link to activate your account.";
                // TODO: add a button "click here to send a new validation email"
            }
            else {
                // invalid URL or account already activated
                echo "This URL is invalid.</br>
                If you are trying to activate an account, then it may already be active.";
            }
            ?>
        </div>
    </div>
</body>