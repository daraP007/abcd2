<?php 
session_start();
include 'db_configuration.php';

if (isset($_POST['update_artist'])) {
    $user_id = $_POST['user_id'];
    $description = $_POST['description'];
    $country = $_POST['country'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $twitter = $_POST['twitter'];
    $whatsapp = $_POST['whatsapp'];
    $art_site = $_POST['art_site'];
    $other = $_POST['other'];
    $approval_status = $_POST['approval_status']; // Add this line to retrieve the approval status from the form

    // Check if a new profile picture was uploaded
    if(isset($_FILES['new_profile_picture']) && $_FILES['new_profile_picture']['error'] == 0) {
        $target_dir = "images/profile_images/";
        $target_file = $target_dir . basename($_FILES["new_profile_picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow only certain file formats
        if($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png") {
            // Move the uploaded file to the target directory
            if(move_uploaded_file($_FILES["new_profile_picture"]["tmp_name"], $target_file)) {
                // Update the profile picture in the database
                $profile_picture = basename($_FILES["new_profile_picture"]["name"]);
            } else {
                echo "Error uploading file.";
                exit();
            }
        } else {
            echo "Invalid file format. Please upload a JPG, JPEG, or PNG file.";
            exit();
        }
    } else {
        // If no new profile picture uploaded, retain the existing one
        $query = "SELECT profile_picture FROM artists WHERE user_id = '$user_id'";
        $result = mysqli_query($db, $query);
        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $profile_picture = $row['profile_picture'];
        } else {
            echo "Error retrieving existing profile picture.";
            exit();
        }
    }

    // Update the artist details in the database
    $query = "UPDATE artists
        SET profile_picture = '$profile_picture',
            description = '$description',
            country = '$country',
            facebook = '$facebook',
            instagram = '$instagram',
            twitter = '$twitter',
            whatsapp = '$whatsapp',
            art_site = '$art_site',
            other = '$other',
            approval_status = '$approval_status'
        WHERE user_id = '$user_id'";

    $query_use = mysqli_query($db, $query);

    if ($query_use) {
        header('location: artistEdit.php?Updated=Success');
        exit();
    } else {
        header('location: artistEdit.php?Updated=Failed&id=' . $user_id);
        exit();
    }
}
?>
