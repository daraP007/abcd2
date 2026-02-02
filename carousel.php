<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
require 'bin/functions.php';
require 'db_configuration.php';
include('header.php');

?>

<html>

<head>
    <title>ABCD</title>
</head>
<style>
    .image {
        /* width: 125px;
        height: 175px; */
        width: 250px;
        height: 350px;
        padding: 8px 8px 8px 8px;
        transition: transform .2s;
    }

    .image:hover {
        abc transform: scale(1.2)
    }

    #table_1 {
        border-spacing: 300px 0px;
    }

    #table_2 {
        margin-left: auto;
        margin-right: auto;
    }

    #silc {
        width: 300;
        height: 85;
    }

    #welcome {
        text-align: center;
    }

    #directions {
        text-align: center;
    }

    #title {
        color: black;
        text-align: center;
    }

    a:visited,
    a:link,
    a:active {
        text-decoration: none;
    }

    #title2 {
        text-align: center;
        color: darkgoldenrod;
    }

    #navbarSupportedContent {
        display: flex !important;
        align-items: center;
        padding: 0;
    }

    .navbar {
        border: none !important;
    }

    .search-container{
        padding-top: 0;
    }

    .navbar_right {
        width: fit-content;
        justify-content: end;
        gap: 6.4px;
        align-items: center;
    }

    body {
        padding-top: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol" !important;
        font-size: initial !important;
    }

    .search-container input {
        color: black;
    }
</style>

<body>
    <?php
    if (isset($_GET['preferencesUpdated'])) {
        if ($_GET["preferencesUpdated"] == "Success") {
            echo "<br><h3 align=center style='color:green'>Success! The Preferences have been updated!</h3>";
        }
    }
    ?>
    <h1 id="title2">Welcome to Project ABCD (A Bite of Culture in Dresses)</h1>
    <h2 id="directions">Select a dress to know more about it</h2><br>

    <?php

    //=============================================================================
    // Step 1: Get the row_count and dresses_count from COOKIE or from defaults
    //=============================================================================
    // Hard code these defaults for now; Ideally, we can get these from the database.
    
    $row_count = 5;
    $dresses_count = 200;
    $fav_dress = "Saree";
    //variables for carousel
    $carousel_pic_count = 10;
    // cookie name
    $row_count_cookie_name = "row_count";
    $dresses_count_cookie_name = "dresses_count";
    $favorite_dress_cookie_name = "favorite_dress";
    $carousel_pic_count_cookie_name = "carousel_pic_count";

    // if cookie is present, then use those values
    // if cookie is NOT present, then the defaults we set earlier will come into play
    if (isset($_COOKIE[$favorite_dress_cookie_name])) {
        $fav_dress = $_COOKIE[$favorite_dress_cookie_name];
    }

    if (isset($_COOKIE[$row_count_cookie_name])) {
        $row_count = $_COOKIE[$row_count_cookie_name];
    }

    if (isset($_COOKIE[$dresses_count_cookie_name])) {
        $dresses_count = $_COOKIE[$dresses_count_cookie_name];
    }

    if (isset($_COOKIE[$carousel_pic_count_cookie_name])) {
        $carousel_pic_count = $_COOKIE[$carousel_pic_count_cookie_name];
    }


    //=============================================================================
    // Step 2: Get the $pic and $name for each of the dresses from the database
    // Refrence: https://www.php.net/manual/en/mysqli-result.fetch-assoc.php
    //=============================================================================
    
    $name_sql = "SELECT `name` FROM `dresses`";
    $pic_sql = "SELECT `image_url` FROM `dresses`";


    $name_results = mysqli_query($db, $name_sql);
    $pic_results = mysqli_query($db, $pic_sql);

    if (mysqli_num_rows($name_results) > 0) {
        while ($row = mysqli_fetch_assoc($name_results)) {
            $dress_names[] = $row;
        }
    }

    if (mysqli_num_rows($pic_results) > 0) {
        while ($row = mysqli_fetch_assoc($pic_results)) {
            $dress_pics[] = $row;
        }
    }


    // === ignore: further optimizations are possible =========
//     $query = "SELECT * FROM `dresses`";
    
    // if ($result = mysqli_query($db, $query)) {
    
    //     /* fetch associative array */
//     while ($row = mysqli_fetch_assoc($result)) {
//         printf ("%s (%s)\n", $row["name"], $row["image_url"]);
//     }
//     /* free result set */
//     mysqli_free_result($result);
// }
    


    //=============================================================================
    // Step 3: Now, display the dresses in loop 
    //=============================================================================
    
    // echo "row count --> " . $row_count;
    // echo "<br>dresses count --> " . $dresses_count;
    
    $dress1 = $dress_names[0]['name'];
    $pic1 = $dress_pics[0]['image_url'];
    $pic1 = "images/dress_images/" . $pic1;


    $dress2 = $dress_names[2]['name'];
    $pic2 = $dress_pics[2]['image_url'];
    $pic2 = "images/dress_images/" . $pic2;
    $pic2 = $dress_pics[2]['image_url'];
    $pic2 = "images/dress_images/" . $dress_pics[2]['image_url'];

    $dress3 = $dress_names[3]['name'];
    $pic3 = $dress_pics[3]['image_url'];
    $pic3 = "images/dress_images/" . $pic3;

    $dress4 = $dress_names[4]['name'];
    $pic4 = $dress_pics[4]['image_url'];
    $pic4 = "images/dress_images/" . $pic4;

    ?>
    <html lang="en">

    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            .carousel-inner>.item>img,
            .carousel-inner>.item>a>img {
                width: 70%;
                margin: auto;
            }
        </style>
    </head>

    <body>

        <div class="carousel-inner" background-position: center center role="listbox"
            style=" width:100%; height: 800px !important;">
            <h2>Carousel View</h2>
            <div id="myCarousel" class="carousel slide multi-item-carousel" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <?php
                    for ($i = 1; $i < $carousel_pic_count; $i++) {
                        echo '<li data-target="#myCarousel" data-slide-to="' . $i . '"></li>';

                    }
                    //<li data-target="#myCarousel" data-slide-to="1"></li>
                    //<li data-target="#myCarousel" data-slide-to="2"></li>
                    //<li data-target="#myCarousel" data-slide-to="3"></li>
                    echo '</ol>';
                    ?>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">

                            <?php echo '<img src="  ' . $pic1 . '" alt=  "' . $dress1 . ' " style="width:25%;" >'; ?>
                            <div class="carousel-caption">
                                <?php echo '<h3>  ' . $dress1 . ' </h3>'; ?>
                            </div>
                        </div>
                        <?php
                        for ($i = 1; $i < $carousel_pic_count; $i++) {
                            echo '<div class="item">';
                            // echo 'images/dress_images/' .$dress_pics[$i]['image_url'];
                            echo '<img src= images/dress_images/' . $dress_pics[$i]['image_url'] . ' alt=  "' . $dress_names[$i]['name'] . ' " style="width:25%;" >';
                            echo '<div class="carousel-caption">';
                            echo '<h3>  ' . $dress_names[$i]['name'] . ' </h3>';
                            echo ' </div>';
                            echo '</div>';
                        }
                        ?>


                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <!--echo "<table id = 'table_2'> -->
                    <!--Links to each dress can be put inside the href = ";
        echo "<tr>";
        for ($a = 0; $a < $dresses_count; $a) {
            for ($b = 0; $b < $row_count; $b++) {
                if ($b >= $row_count) {
                    break;
                } else {
                    $dress = $dress_names[$a]['name'];
                    $pic = $dress_pics[$a]['image_url'];
                    $pic = "images/dress_images/" . $pic;
                    echo "
                    <td>
                        <a href = 'display_the_dress.php?name=$dress' title = '$dress'>
                            <image class = 'image' src = $pic> </image>
                            <div id = 'title'>$dress </div>
                            
                        </a>
                    </td>
                    ";    
                    $a++;  
                }
            }
            echo "</tr>";
        }
    echo "</table>"; 
    ?> -->

    </body>

    </html>