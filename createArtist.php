<?php

session_start();

include_once 'db_configuration.php';

// Check if the user already has an artist profile
$id = $_SESSION["id"];
$check_query = "SELECT COUNT(*) AS count FROM artists WHERE user_id = '$id'";
$check_result = mysqli_query($db, $check_query);
$check_row = mysqli_fetch_assoc($check_result);
if ($check_row['count'] > 0) {
    // If the user already has an artist profile, redirect them back with a warning
    header('location: artistShowcase.php?warning=profileExists');
    exit(); // Terminate the script to prevent further execution
}

// If the user doesn't have an artist profile, continue with creating one

$description = mysqli_real_escape_string($db,$_POST['description']);
$country = mysqli_real_escape_string($db,$_POST['country']);
$facebook = mysqli_real_escape_string($db,$_POST['facebook']);
$instagram = mysqli_real_escape_string($db,$_POST['instagram']);
$twitter = mysqli_real_escape_string($db,$_POST['twitter']);
$imageName = basename($_FILES["fileToUpload"]["name"]);
$whatsapp = mysqli_real_escape_string($db,$_POST['whatsapp']);
$art_site = mysqli_real_escape_string($db,$_POST['art_site']);
$other = mysqli_real_escape_string($db,$_POST['other']);
$approval_status = mysqli_real_escape_string($db, 'pending');
        
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
        header('location: createArtist.php?createArtist=fileRealFailed');
        exit(); // Terminate the script
    }
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    // Handle errors if needed
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
        $sql = "INSERT INTO `artists` (`user_id`, `profile_picture`, `description`, `country`, `facebook`, `instagram`, `twitter`, `whatsapp`, `art_site`, `other`, `approval_status`)
        VALUES ('$id', '$imageName', '$description', '$country', '$facebook', '$instagram', '$twitter', '$whatsapp', '$art_site', '$other', '$approval_status')";

        $test = mysqli_query($db, $sql);
        if($test){
            echo "success";
            header('location: artistShowcase.php?registerArtist=success');
        }
        else {
            echo mysqli_error($db);
        }
        
    }
} 

?>
