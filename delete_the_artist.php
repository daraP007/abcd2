<?php

include_once 'db_configuration.php';

if (isset($_POST['id'])){

    $id = mysqli_real_escape_string($db, $_POST['id']);

    $sql = "DELETE FROM artists
            WHERE user_id = '$id'";

    mysqli_query($db, $sql);
    header('location: artistEdit.php');
}//end if
?>