<?php

if (isset($_POST['home_view'])){
    $home_view =  $_POST['home_view'];
}

if (isset($_POST['carousel_pic_count'])){
    $carousel_pic_count =  $_POST['carousel_pic_count'];
}

if (isset($_POST['row_count'])){
    $rows =  $_POST['row_count'];
}

if (isset($_POST['dresses_count'])){
    $dress_count = $_POST['dresses_count'];
}

if (isset($_POST['fav_dress'])){
    $dress = $_POST['fav_dress'];
}

if (isset($_POST['image_height'])){
    $image_height = $_POST['image_height'];
}

if (isset($_POST['image_width'])){
    $image_width = $_POST['image_width'];
}

if (isset($_POST['description_length'])){
    $description_length = $_POST['description_length'];
}

if (isset($_POST['did_you_know_length'])){
    $did_you_know_length = $_POST['did_you_know_length'];
}
$home_view_cookie_name = "home_view";
$row_count_cookie_name = "row_count";
$dresses_count_cookie_name = "dresses_count";
$favorite_dress_cookie_name = "favorite_dress";
$image_height_cookie_name = "img_height";
$image_width_cookie_name = "img_width";
$carousel_pic_count_cookie_name = "carousel_pic_count";
$description_length_cookie_name = "description_length";
$did_you_know_length_cookie_name = "did_you_know_length";


setcookie($home_view_cookie_name, $home_view, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie($carousel_pic_count_cookie_name, $carousel_pic_count, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie($row_count_cookie_name, $rows, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie($dresses_count_cookie_name, $dress_count, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie($favorite_dress_cookie_name, $dress, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie($image_height_cookie_name, $image_height, time() + (86400 * 30), "/"); // 86400 = 1 day 
setcookie($image_width_cookie_name, $image_width, time() + (86400 * 30), "/"); // 86400 = 1 day    
setcookie($description_length_cookie_name, $description_length, time() + (86400 * 30), "/"); // 86400 = 1 day 
setcookie($did_you_know_length_cookie_name, $did_you_know_length, time() + (86400 * 30), "/"); // 86400 = 1 day    

if ($home_view == "Grid") {
    header('location: index.php?');
}
else  {
header('location: carousel.php?');
}

?>
