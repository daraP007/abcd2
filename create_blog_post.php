<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

if (isset($_POST['create_post'])) {
  $title = mysqli_real_escape_string($db,$_POST['title']);
  $author = mysqli_real_escape_string($db,$_POST['author']);
  $description = mysqli_real_escape_string($db,$_POST['description']);
  $video_link = mysqli_real_escape_string($db,$_POST['video_link']);
  $video_link2 = mysqli_real_escape_string($db,$_POST['video_link2']);
  $video_link3 = mysqli_real_escape_string($db,$_POST['video_link3']);
  $timestamp = mysqli_real_escape_string($db,date("Y-m-d H:i:s"));
  $fileNameArray = [];
  for($i = 0; $i < count($_FILES['file']['name']); $i++) {
    $fileName = $_FILES['file']['name'][$i];
    $fileTMP = $_FILES['file']['tmp_name'][$i];
    $fileError = $_FILES['file']['error'][$i];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    if ($fileError === 0) {
      $fileNewName = uniqid('', true).".".$fileActualExt;
      $fileDestination = 'images/blog_pictures/'.$fileNewName;
      move_uploaded_file($fileTMP, $fileDestination);
      array_push($fileNameArray, $fileDestination);
    } else if($fileError === 4) {
      //do nothing. No file was uploaded
    }else {
      echo "There was an error uploading your file.";
    }
  }

  $sql = "INSERT INTO blogs VALUES (
		NULL,
		'$title',
    '$author',
    '$description',
    '$video_link',
    '$video_link2',
    '$video_link3',
    '$timestamp',
    '$timestamp');";

  if (!mysqli_query($db, $sql)) {
    echo("Error description: " . mysqli_error($db));
  } else {
    $last_id = mysqli_insert_id($db);
    foreach($fileNameArray as $location){
      $sql = "INSERT INTO blog_pictures VALUES (
        NULL,
        '$last_id',
        '$location');";

      if (!mysqli_query($db, $sql)) {
        echo("Error description: " . mysqli_error($db));
      }
    }
  }
}

header('Location: blogs.php');
?>