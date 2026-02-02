<html>
    <style type="text/css">
        h1 {
            font-size: 10;
            color: black;
        }
    </style>

<?php
    include_once 'db_configuration.php';
    /* User registers as a new artist, need to check if already artist */
     
     $user_id = mysqli_real_escape_string($db,$_SESSION['id']);
     $description = mysqli_real_escape_string($db,$_POST['description']);
     $profile_picture = basename($_FILES['fileToUpload']['name']);
     $country = mysqli_real_escape_string($db,$_POST['country']);
     $facebook = mysqli_real_escape_string($db,$_POST['facebook']);
     $instagram = mysqli_real_escape_string($db,$_POST['instagram']);
     $twitter = mysqli_real_escape_string($db,$_POST['twitter']);
     $whatsapp = mysqli_real_escape_string($db,$_POST['whatsapp']);
     $art_site = mysqli_real_escape_string($db,$_POST['art_site']);
     $other = mysqli_real_escape_string($db,$_POST['other']);
     $approval_status = 'pending';
     
//      if(!empty($_FILES['fileToUpload']['name'])){
//          $target_dir = 'images/profile_images/';
//          $fileName = $target_dir . basename($_FILES['fileToUpload']['name']);
//          $fileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
//      }
//      if(move_uploaded_file($_FILES["fileToUpload"]["name"], $fileName)) {
//         //insert user info into DB
//         $sql = "INSERT INTO `artists` (`user_id`, `profile_picture`, `description`, `country`, `facebook`, `instagram`, `twitter`, `whatsapp`, `art_site`, `other`, `approval_status`)
//         VALUES ('$user_id', '$profile_picture', '$description', '$country', '$facebook', '$instagram', '$twitter', '$whatsapp', '$art_site', '$other', '$approval_status')";

//         if (mysqli_query($db, $sql)) {
//             echo "<h1> Request Successfully Submitted! </h1>";
//         } else {
//             echo "Error: " . $sql . "<br>" . mysqli_error($db);
//         }
//      }
                
     $target_dir = "images/profile_images/";  
     $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
     $uploadOk = 1;
     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
         // Check if image file is a actual image or fake image
     if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            header('location: registerArtist.php?registerArtist=fileRealFailed');
            $uploadOk = 0;
        }
    }
         // Check if $uploadOk is set to 0 by an error
     if ($uploadOk == 0) {
             
             // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                 
        $sql = "INSERT INTO `artists` (`user_id`, `profile_picture`, `description`, `country`, `facebook`, `instagram`, `twitter`, `whatsapp`, `art_site`, `other`, `approval_status`)
            VALUES ('$user_id', '$profile_picture', '$description', '$country', '$facebook', '$instagram', '$twitter', '$whatsapp', '$art_site', '$other', '$approval_status')";
                 
        mysqli_query($db, $sql);
        header('location: artistShowcase.php?registerArtist=success');
        }
    }
    // header("location: index.php");
?>
