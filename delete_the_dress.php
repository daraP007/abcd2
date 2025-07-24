<?php
ob_start();

include_once 'db_configuration.php';

if (isset($_POST['id'])){

    $id = mysqli_real_escape_string($db, $_POST['id']);
    $file = mysqli_real_escape_string($db, $_POST['image_url']);

    unlink($file);

    $sql = "DELETE FROM dresses
            WHERE id = '$id'";

    mysqli_query($db, $sql);
    echo"Success!!";
    header('location: list_dresses.php?dressDeleted=Success');
}//end if
?>

