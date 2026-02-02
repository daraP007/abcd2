<?php
ob_start();
session_start();
require 'bin/functions.php';
require 'db_configuration.php';
include('header.php');

$query = "SELECT id, CONCAT(first_name,' ',last_name) AS name, profile_picture, description, country, facebook, instagram, twitter, whatsapp, art_site, other 
          FROM artists 
          LEFT JOIN users ON id = user_id
          WHERE approval_status = 'approved'";
$GLOBALS['data'] = mysqli_query($db, $query);
ob_end_flush();
?>

<head>
    <title>ABCD</title>

    <link rel="stylesheet" href="css/artistShowcase.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f40040d297.js" crossorigin="anonymous"></script>
    <style>
        .warning-message {
            background-color: #ffe4e1;
            color: #ff0000;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 36;
            font-weight: bold;
            border: 5px solid #ff0000;
            border-radius: 15px;
            text-align: center;
        }
        .artistBtn a {
        font-size: 36px; /* Set font size to 36 pixels */
        padding: 10px 10; /* Add padding */
        border-radius: 10px; /* Rounded corners */
        text-decoration: none; /* Remove underline from link */
        display: inline-block; /* Make the button a block element */
        transition: background-color 0.3s ease; /* Smooth transition */
        }

        .artistBtn a:hover {
            background-color: #green; /* Darker red on hover */
        }
        .profile {
            border: 2px solid #ccc; /* Add border around the profile */
            border-radius: 10px; /* Rounded corners */
            padding: 10px; /* Add padding */
            margin: 10px; /* Add margin */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); /* Add shadow */
            transition: box-shadow 0.3s ease; /* Smooth transition for shadow */
        }
        .profile:hover {
            box-shadow: 0 8px 16px 0 rgba(1,1,1,1); /* Increase shadow on hover */
        }
    </style>
</head>
<body>
    <h2 class="artistTitle">Artist Showcase</h2>
    <?php
        // Display warning message if it exists
        if(isset($_GET['warning']) && $_GET['warning'] == 'profileExists') {
            echo '<div class="warning-message">You already have an artist profile. You can only activate one artist profile.</div>';
        }
    ?>
    <div class="btnContainer">
        <button class="artistBtn"><a class="btn btn-sm" href="artistForm.php">Become an Affiliated Artist</a></button>
    </div>
    <div class="contentContainer">
    
    <?php

    if ($data->num_rows > 0) {
        $counter = 0;
        echo"<table>";
        while($row = $data->fetch_assoc()) {
            $id = $row["id"];
            $name = $row["name"];
            $profile_picture = $row["profile_picture"];
            $description = $row["description"];
            $country = $row["country"];
            $facebook = $row["facebook"];
            $instagram = $row["instagram"];
            $twitter = $row["twitter"];
            $whatsapp = $row["whatsapp"];
            $art_site = $row["art_site"];
            $other = $row["other"];

            
            if($counter == 0 || $counter % 2 == 0)
            {
                echo '<tr>';
            }

            echo"
                <td class='profile' >
                    <img src='images/profile_images/$profile_picture' style='width: 100%; height: 100%;'>
                    <div class='aboutArtist'>
                        <div class='aboutArtistContent'>
                            <p><strong>About Me: </strong>$description</p>
                            <p><strong>My Work: </strong><a href='$art_site'>$art_site</a></p>

                            <span>

                            <a href='$facebook'>
                            <i class='fa-brands fa-facebook'></i>
                            </a>

                            <a href='$instagram'>
                            <i class='fa-brands fa-instagram'></i>
                            </a>

                            <a href='$twitter'>
                            <i class='fa-brands fa-twitter'></i>
                            </a>

                            <a href='$whatsapp'>
                            <i class='fa-brands fa-whatsapp'></i>
                            </a>
                        
                            </span>
                        </div>
                    </div>
                </td>
                ";

            $counter++;

            if($counter % 2 == 0) 
            {
                echo '</tr>';
            }
            
        }

        echo "</table>";
    }

    ?>
    </div>
</body>
