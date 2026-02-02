<?php
   
   error_reporting(E_ALL);
   ini_set('display_errors', 1);

   require_once "db_configuration.php";
if (isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){
   $error="";
   $pass1 = $db->escape_string($_POST['pass']);
   $pass2 = $db->escape_string($_POST['cpass']);
   $email = $_POST["email"];
   if ($pass1 === $pass2) {
      // Hash the new password, not the token
      $hashedPassword = password_hash($pass1, PASSWORD_DEFAULT);
   
      // Prepare the SQL statement to prevent SQL injection
      $updateQuery = $db->prepare("UPDATE `users` SET `hash`=? WHERE `email`=?");
      $updateQuery->bind_param("ss", $hashedPassword, $email);
      $updateQuery->execute();
   
      // Potentially check if the update was successful
      if ($updateQuery->affected_rows === 1) {
          // Redirect to login with success message
          header("Location: loginForm.php?reset=success");
      } else {
          // Redirect to an error page or display an error
          header("Location: confirmEmail.php?status=errorUpdate");
      }
   } else {
      // Redirect with an error message if passwords do not match
      header("Location: confirmEmail.php?status=errorPassword");
   }
   exit();
   
}
?>
<?php
   include_once "header.php"; 
   if (isset($_GET["token"])){
      $token = $_GET["token"];
      $email = $_GET["email"];
      $curDate = date("Y-m-d H:i:s");
      $sql = "SELECT * FROM `users` WHERE `hash`='".$token."' and `email`='".$email."';";
      $result = mysqli_query($db, $sql);

?>
<!DOCTYPE html>
<html>
   <head>
      <title>Register/Login Form</title>
      <link href="css/loginForm.css" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
   </head>
   <body>
      <div class="form">
         <ul class="tab-group">
            <li class= "tab active align = right"><a href="#register">New User</a></li>
         </ul>
         <div class="tab-content">
            <div id="login">
               <h1 id="welcomeText">Welcome Back!</h1>
               <form action="confirmPassword.php" method="post" autocomplete="off">
                  <div class="field-wrap">
                     <label>
                     Password
                     <span class="req">*</span>
                     </label>
                     <input type="password" required autocomplete="off" name="pass"/>
                     <label>
                     Confirm Password
                     <span class="req">*</span>
                     </label>
                     <input type="password" required autocomplete="off" name="cpass"/>
                     <input type="hidden" name="email" value="<?php echo $email;?>"/>
                     <input type="hidden" name="action" value="update"/>
                  </div>
                  <div class="btnContainer">
                     <button class="button button-block" name="change_password" />Confirm Password</button>
                  </div>
               </form>
            </div>
         </div>
         <!-- tab-content -->
      </div>
      <!-- /form -->
      <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="js/loginForm.js"></script>
   </body>
</html>
<?php 
   }
?>
