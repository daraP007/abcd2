<?php
include_once 'db_configuration.php';



    $value = $_POST['value'];
    $column = $_POST['column'];
    $id = $_POST['id'];
    echo "$value - $column - $id";

    $sql="UPDATE dresses SET $column = '$value' WHERE id = '$id'";
    mysqli_query($db, $sql);
    
    
?>
