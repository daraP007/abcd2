<?php
$status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();
}

include('header.php');
$page_title = 'Project ABCD > Help'; 
?>

<html>
    <head>
        <title>ProjectABCD > Help</title>
        <link href="css/help.css" rel="stylesheet">
    </head>
    <style>
    </style>
    <body>
   
<h2 id="title">Welcome to the Project ABCD Website!</strong></h2>
<h5></h5>
<p>Each of the icon on the home page represents a different type of dress. When you mouse over any of the icons, the names of the dresses will be shown. Click on any of them to learn more about the dress.</p>
<p>Users have to be logged in as a admin to  <button><a class="btn btn-sm" href=  >Create a Dress</a></button> , 
<td><a class="btn btn-warning btn-sm" href >Modify</a></td>
, and 
<td><a class="btn btn-danger btn-sm" href= >Delete</a></td>
 
a dress which are all in "List" page.
 Also while logged in as an Admin, users will be able to see the button <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Modify Preferences</button>
 next to 
 <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Set Cookie</button>. </p>
<p>You can set up your favorite dress by going to "Preferences" and typing in your favorite dress of your choice and by clicking  
<button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Set Cookie</button>
 you have your favorite dress all set up in "My favorite".</p>
<br>
<p>The number of Dress icons per row and the number of dresses to display on the home page can be changed by the admin in "Preferences".</p>
<br>
<p>You can always click on the "A Bite Of Culture In Dresses" icon to go back to the home page.            
<a href title="SILC Project ABCD"><img id="silc" src="images/about_images/abcd_logo.png"></a> 

<br>
<br>
<p>This site was updated to PHP format by the students of SILC CS320 (PHP) class.</p>

</html>