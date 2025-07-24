<?php

include_once 'db_configuration.php';

if (isset($_POST['id'])){

    $id = mysqli_real_escape_string($db, $_POST['id']);

    $sql = "DELETE FROM resources
            WHERE id = '$id'";

    mysqli_query($db, $sql);
    echo"Success!!";
    header('location: resources.php?ResourceDeleted=Success');
}//end if
?>

