<?php 
session_start();

    // Check if the user is logged in and has admin privileges
    

    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    
    ob_end_flush();
?>

<!-- admin check for admin.php -->
<!-- 7-31-2025: moved session_start() to the top of the file to ensure session is started before any output -->
<?php
session_start(); 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>
            alert('Unauthorized access.');
            window.location.href = 'index.php';
          </script>";
    exit;
}
?>

<html>
<head>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f40040d297.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2 id="title">Admin</h2>
    </div>
    <div class="iconsContainer">
    <table class="center">
         <tr>
            <td><a href="users.php" class="adminLinks"><i class="fa fa-user IconUse" id="adIconOne"></i><p class="iconLabel"><strong>users</strong></p></a></td>
            <td><a href="import.php"><i class="fa fa-arrow-down" id="adIconTwo"></i><p class="iconLabel"><strong>import</strong></p></a></td>
            <td><a href="export.php"><i class="fa fa-arrow-up-from-bracket" id="adIconThree"></i><p class="iconLabel"><strong>export</strong></p></a></td>
            <td><a href="exportPDF.php"><i class="fa fa-file-pdf" id="adIconFour"></i><p class="iconLabel"><strong>export pdf</strong></p></a></td>
                        <!-- celebrations and tags icons added FP2 -->
            <td><a href="admin_celebrations.php"><i class="fa fa-calendar-check" id="adIconFour"></i><p class="iconLabel"><strong>celebrations</strong></p></a></td>
            <td><a href="manage_tags.php"><i class="fa fa-tags" id="adIconFour"></i><p class="iconLabel"><strong>tags</strong></p></a></td>
</tr>
<tr>
            <td><a href="export_powerpoint_options.php"><i class="fa fa-file-powerpoint" id="adIconFive"></i><p class="iconLabel"><strong>powerpoint</strong></p></a></td>
            <td><a href="help.php"><i class="fa fa-circle-question" id="adIconSix"></i><p class="iconLabel"><strong>help</strong></p></a></td>
            <td><a href="games.php"><i class="fa fa-dice" id="adIconSeven"></i><p class="iconLabel"><strong>games</strong></p></a></td>
            <td><a href="my_favorite.php"><i class="fa fa-shirt" id="adIconEight"></i><p class="iconLabel"><strong>my favorite</strong></p></a></td>
            <td><a href="manageNominations.php" class="adminLinks"><i class="fa-solid fa-trophy" id="adIconOne"></i><p class="iconLabel"><strong>Nomination</strong></p></a></td>
</tr>
<tr class="lastCol">
            <td><a href="reports_summary.php"><i class="fa fa-file-lines" id="adIconNine"></i><p class="iconLabel"><strong>reports summary</strong></p></a></td>
            <td><a href="preferences.php"><i class="fa fa-gear" id="adIconTen"></i><p class="iconLabel"><strong>preferences</strong></p></a></td>
            <td><a href="artistEdit.php"><i class="fa fa-palette" id="adIconEleven"></i><p class="iconLabel"><strong>artists</strong></p></a></td>
            <td><a href="resources.php"><i class="fa-solid fa-scroll" id="adIconTwelve"></i><p class="iconLabel"><strong>resources</strong></p></a></td>
            <td><a href="admin_query.php" class="adminLinks"><i class="fa fa-user IconUse" id="adIconOne"></i><p class="iconLabel"><strong>advanced query</strong></p></a></td>
        </tr>
    </table>
</div>

<footer class="page-footer text-center">
    <br><p>© Summer 2025 [modified by] Team DOLPHIN 🐬</p><br>
</footer>
     
</body>
</html>
 