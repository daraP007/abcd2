<?php

include_once 'db_configuration.php';

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $url = mysqli_real_escape_string($db,$_POST['url']);
    $type = mysqli_real_escape_string($db,$_POST['type']);
    $notes = mysqli_real_escape_string($db,$_POST['notes']);
    $validate = true;
    

    if($validate){   
        $sql = "INSERT INTO `resources` (`name`, `url`, `type`, `notes`)
                VALUES ('$name', '$url', '$type', '$notes')";
             
        mysqli_query($db, $sql);
        header('location: resources.php?create_resource=success');
    } 
?>
