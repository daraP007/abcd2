<?php 
session_start();
include 'db_configuration.php';

if (isset($_POST['update_blog'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $video_link = $_POST['video_link'];
    $video_link2 = $_POST['video_link2'];
    $video_link3 = $_POST['video_link3'];


    $query = "UPDATE blogs
    SET Title = '$title',
        Author = '$author',
        Description = '$description',
        Video_Link = '$video_link',
        Video_Link2 = '$video_link2',
        Video_Link3 = '$video_link3'
    WHERE Blog_Id ='$id'";

    $query_use = mysqli_query($db, $query);

    if ($query_use) {
        header('location:blogs.php?Updated=Success');

    } else {
        header('location:blogs.php?Updated=Failed&id='.$id);
    }

}

?>;