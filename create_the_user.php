<?php

include_once 'db_configuration.php';

 
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db,$_POST['last_name']);
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $role = mysqli_real_escape_string($db,$_POST['role']);
    $validate = true;

//don't need below code because no image is included in users
   // if($validate){
        

      //  $target_dir = "images/dress_images/";

       // $target_file = $target_dir . basename($_FILES["fileToUpload"]["first_name"]);
       // $uploadOk = 1;
        //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
       // if(isset($_POST["submit"])) {
           // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            //if($check !== false) {
              //  $uploadOk = 1;
          //  } else {
              //  header('location: create_user.php?create_user=fileRealFailed');
              //  $uploadOk = 0;
          //  }
       // }
        // Check if $uploadOk is set to 0 by an error
        //if ($uploadOk == 0) {
            
        // if everything is ok, try to upload file
        //else {
           // if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                
                $sql = "INSERT INTO `users` ( `first_name`, `last_name`, `email`, `role` )
                VALUES ('$first_name', '$last_name', '$email', '$role')";
    
                mysqli_query($db, $sql);
                header('location: users.php?create_user=Success');
            
         




?>
