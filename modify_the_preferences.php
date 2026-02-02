<?php
//edited by Vishnu
include_once 'db_configuration.php';

if (isset($_POST['row_count'])){
    $rows = mysqli_real_escape_string($db, $_POST['row_count']);
}

if (isset($_POST['dresses_count'])){
    $dress_count = mysqli_real_escape_string($db, $_POST['dresses_count']);
}

if (isset($_POST['fav_dress'])){
    $dress = mysqli_real_escape_string($db, $_POST['fav_dress']);
}
 
if (isset($_POST['image_height'])){
    $height = mysqli_real_escape_string($db, $_POST['image_height']);
}

if (isset($_POST['image_width'])){
    $width = mysqli_real_escape_string($db, $_POST['image_width']);
}
 
    $sql1 = "UPDATE `preferences` SET `value`= $rows WHERE `name` = 'NO_OF_DRESSES_PER_ROW'";

    $sql2 = "UPDATE `preferences` SET `value`= $dress_count WHERE `name` = 'NO_OF_DRESSES_TO_DISPLAY'";

    $sq13 = "UPDATE `preferences` SET `value`= $dress WHERE `comments` = 'NAME_OF_FAVORITE_DRESS'";

    $sql4 = "UPDATE `preferences` SET `value`= $height WHERE `name` = 'IMAGE_HEIGHT'";

    $sq15 = "UPDATE `preferences` SET `value`= $width WHERE `comments` = 'IMAGE_WIDTH'";

    mysqli_query($db, $sql1);
    mysqli_query($db, $sql2);
    mysqli_query($db, $sql3);
    mysqli_query($db, $sql4);
    mysqli_query($db, $sql5);
    header('location: index.php?preferencesUpdated=Success');

?>
