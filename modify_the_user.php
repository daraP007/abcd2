<?php
session_start();
include 'db_configuration.php';

if (isset($_POST['update_user'])){

    $id = mysqli_real_escape_string($db, $_POST['id']);
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $role = mysqli_real_escape_string($db, $_POST['role']);

               
        $sql = "UPDATE users
        SET first_name = '$first_name',
            last_name = '$last_name',
             email = '$email',
             role = '$role'
        where id = '$id'";
        
    $query_use = mysqli_query($db,$sql);


if ($query_use){
    header('location: users.php?userUpdated=Success');
    }
    else{
    header('location: users.php?userUpdated=Error');

     }
}
?>;
