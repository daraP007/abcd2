<?php
session_start();
include'db_configuration.php';

if (isset($_POST['id'])){

    $id = mysqli_real_escape_string($db, $_POST['id']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $type = mysqli_real_escape_string($db, $_POST['type']);
    $notes = mysqli_real_escape_string($db, $_POST['notes']);
    $url = mysqli_real_escape_string($db, $_POST['url']);
  
        $sql = "UPDATE resources
        SET name = '$name',
                notes = '$notes',
                type = '$type',
                url = '$url'           
        WHERE id = '$id'";

    $query_use = mysqli_query($db, $sql);

    if ($query_use){
        header('location: resources.php?dressUpdated=Success');
    }else{
        header('location: modify_dress.php?modify_dress=answerFailed&id='.$id);
    }
}//end if
?>