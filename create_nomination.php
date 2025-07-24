<?php
session_start();


include_once 'db_configuration.php';

 
    $category = mysqli_real_escape_string($db,$_POST['category']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db,$_POST['description']);
    $nominator = mysqli_real_escape_string($db,$_POST['nominator']);
   
    $sql = "INSERT INTO `nominations` (`category`, `name`, `description`, `nominator`)
            VALUES ('$category', '$name', '$description', '$nominator')";
             
    mysqli_query($db, $sql);
    #placeholder redirect until we figure out if we want to show user confirmation
    if($_SESSION['role'] == 'admin') {
        header('Location: manageNominations.php');
    } else {
        header('Location: index.php');
    }

?>