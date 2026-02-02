<?php 
    ob_start();
    session_start();
    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    ob_end_flush();
    //verifyLogin($page);
?>

<html>
    <head>
        <link href="css/games.css" rel="stylesheet">
    <head>

<body>
    <h2 id="title">Games</h2>
    <br>
    <table class="center">
        <tr>
            <td><a href="bingo.php"><img src="https://cdn.onlinewebfonts.com/svg/img_562572.png" id="img"></th></a>
            <td><a href="quiz.php"><img src="https://cdn3.iconfinder.com/data/icons/brain-games/1042/Quiz-Games-grey.png" id="img"></td></a>
        </tr>
    </table>



</body>
</html>

