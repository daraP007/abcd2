<?php 
session_start();
include 'db_configuration.php';

if (isset($_POST['update_nomination'])){
    $id =  $_POST['id'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $description =$_POST['description'];


    $query = "UPDATE nominations
    SET category = '$category',
        name = '$name',
        description = '$description'
    Where id ='$id'";

   $query_use = mysqli_query($db, $query);

if ($query_use) {
    header('location:manageNominations.php?Updated=Success');

}else{
    header('location:manageNominations.php?Updated=Failed&id='.$id);
}

}

?>;