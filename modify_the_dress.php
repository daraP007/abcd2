<?php

include_once 'db_configuration.php';

if (isset($_POST['id'])){

    $id = mysqli_real_escape_string($db, $_POST['id']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $did_you_know = mysqli_real_escape_string($db, $_POST['did_you_know']);
    $category = mysqli_real_escape_string($db, $_POST['category']);
    $type = mysqli_real_escape_string($db, $_POST['type']);
    $state_name = mysqli_real_escape_string($db, $_POST['state_name']);
    $key_words = mysqli_real_escape_string($db, $_POST['key_words']);
   $oldimage = mysqli_real_escape_string($db, $_POST['oldimage']);
    $imageName = basename($_FILES["fileToUpload"]["name"]);
    $validate = true;
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $notes = mysqli_real_escape_string($db, $_POST['notes']);
    $tag_line = mysqli_real_escape_string($db, $_POST['tag_line']);
    //$validate = emailValidate($answer);
    

        if($imageName != ""){
            $target_dir = "images/dress_images/";
            $target_file = $target_dir.$imageName;
            $uploadOk = 1;
           unlink($target_dir.$oldimage);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    header('location: modify_dress.php?modify_dress=fileRealFailed');
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                header('location: modify_dress.php?modify_dress=fileExistFailed');
                $uploadOk = 0;
            }
            
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                header('location: modify_dress.php?modify_dress=fileTypeFailed');
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                              
                    $sql = "UPDATE dresses
                    SET name = '$name',
                        description = '$description',
                        did_you_know = '$did_you_know',
                        category = '$category',
                        type = '$type',
                        state_name = '$state_name',
                        key_words = '$key_words',
                        image_url = '$imageName',  
                        status = '$status',
                        notes = '$notes',
                        tag_line = '$tag_line'
 
                           
                    
                    WHERE id = '$id'";

                    mysqli_query($db, $sql);
                  header('location: list_dresses.php?dressUpdated=Success');
                    }
                }
        }
                else{
                    
                //$image = $_SESSION["image"];
            
                $sql = "UPDATE dresses
                SET name = '$name',
                        description = '$description',
                        did_you_know = '$did_you_know',
                        category = '$category',
                        type = '$type',
                        state_name = '$state_name',
                        key_words = '$key_words',
                        status = '$status', 
                        notes = '$notes', 
                        tag_line = '$tag_line'
                
                WHERE id = '$id'";

                mysqli_query($db, $sql);
                
                header('location: list_dresses.php?dressUpdated=Success');
                }
    }else{
        header('location: modify_dress.php?modify_dress=answerFailed&id='.$id);
    }
//end if

/*function emailValidate($answer){
    global $choice1,$choice2,$choice3,$choice4;
    if($answer == $choice1 or $answer == $choice2 or $answer == $choice3 or $answer == $choice4){
        return true;
    }else{
        return false;
    }      
}
*/
?>
