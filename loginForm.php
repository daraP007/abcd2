<?php
ob_start();

/* Main page with two forms: sign up and log in */
require 'db_configuration.php';
include('header.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST')

{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
}

    elseif (isset($_POST['register'])) { //user registering

        require 'register.php';

    }
}
ob_flush();
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

          <form action="loginForm.php" method="post" autocomplete="off">

            <div class="field-wrap">
            <label>
              Email Address
              <span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name="email"/>
          </div>

          <div class="field-wrap">
            <label>
              Password <span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>
<div class="btnContainer">
          <button class="button button-block" name="login" />Log In</button>
          <a href="confirmEmail.php">Forgot password</a>
</div>
          </form>

        </div>

        <div id="register">
          <h1 id="newUser">Register as a new user</h1>

          <form action="register.php" method="post" autocomplete="off">

          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name <span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='first_name' />
            </div>

            <div class="field-wrap">
              <label>
                Last Name <span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name='last_name' />
            </div>
           </div>

          <div class="field-wrap">
            <label>
              Email Address <span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name='email' />
          </div>

          <div class="field-wrap">
            <label>
              Set A Password <span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name='password'/>
          </div>

          <button class="button button-block" name="register">Register</button> 

          </form>

        </div>

      </div><!-- tab-content -->

</div> <!-- /form -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/loginForm.js"></script>
</body>
</html>
