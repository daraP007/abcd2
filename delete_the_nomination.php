<?php

include_once 'db_configuration.php';

if (isset($_POST['id'])){

    $id = mysqli_real_escape_string($db, $_POST['id']);

    $sql = "DELETE FROM nominations
            WHERE id = '$id'";

    mysqli_query($db, $sql);
    echo"Success!!";
    header('location: manageNominations.php');
}//end if
?>