<?php
ob_start();
$status = session_status();
if($status == PHP_SESSION_NONE){
    session_start();
}

/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$pass = $db->escape_string($_POST['password']);
$email = $db->escape_string($_POST['email']);
$result = $db->query("SELECT * FROM users WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
    exit();
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['hash']) ) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['active'] = $user['active'];
        
        // (SU23-30) (Feature) user email validation
        if(strcmp($_SESSION['active'], "yes") != 0) {
            // email validation was not completed
            header("location: validation.php");
            exit();
        }
        else {
            // email validation already completed
            $_SESSION['id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;
            if ($_SESSION['role'] == "admin"){
                header("location: admin.php");
            }
            else {
                header("location: index.php");
                exit();
            }
        }
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
        exit();
    }
}
?>