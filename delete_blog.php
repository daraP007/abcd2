<?php

include_once 'db_configuration.php';

if (isset($_GET['id'])){

    $id = mysqli_real_escape_string($db, $_GET['id']);
    //deleting post
    $sql = "DELETE FROM blogs
            WHERE Blog_Id = '$id'";

    mysqli_query($db, $sql);
    //deleting any uploaded images associated with post
    $sql2 = "DELETE FROM blog_pictures
            WHERE Blog_Id = '$id'";
    
    mysqli_query($db, $sql2);
    header('location: blogs.php');
} else {
    echo '<h1>Nothing in id</h1>';
}
//end if
?>