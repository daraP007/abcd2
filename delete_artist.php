<?php 
$page_title = 'Modify Artist';
require 'bin/functions.php';
require 'db_configuration.php';
include('header.php'); 
$page = "artistEdit.php";
//verifyLogin($page);
?>

<html>
<head>
    <link href="css/deleteNomination.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
</head>

<div class="container">
<?php
include_once 'db_configuration.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];
    //$sql = "SELECT id, CONCAT(first_name,' ',last_name) AS name, profile_picture, description, country, facebook, instagram, twitter, whatsapp, art_site, other FROM artists LEFT JOIN users ON id = $id";
    $sql = "Select * FROM artists
            Where user_id = '$id'";
    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error. ']');
    }
}

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<form action="delete_the_artist.php" method="POST">
        <br>
        <h3 id="title" style= "margin-top: 20px;">Delete Artist?</h3><br>
    
        <div class="form-group col-md-4">
          <label for="id">Id</label>
          <input type="text" class="form-control" name="id" value="'.$row["user_id"].'"  maxlength="5" readonly>
        </div>
        
        <div class="form-group col-md-4">
          <label for="description">Description</label>
          <input type="text" class="form-control" name="url" value="'.$row["description"].'"  maxlength="255" readonly>
        </div>
            
    
        <div class="form-group col-md-12">
          <label for="country">Country</label>
          <input type="text" class="form-control" name="type" value="'.$row["country"].'"  maxlength="5" readonly>
        </div>

        <div class="form-group col-md-12">
            <label for="facebook">Facebook</label>
            <input type="text" class="form-control" name="type" value="'.$row["facebook"].'"  maxlength="5" readonly>
        </div>

        <div class="form-group col-md-12">
            <label for="instagram">Instagram</label>
            <input type="text" class="form-control" name="type" value="'.$row["instagram"].'"  maxlength="5" readonly>
        </div>
        <div class="form-group col-md-12">
            <label for="twitter">Twitter</label>
            <input type="text" class="form-control" name="type" value="'.$row["twitter"].'"  maxlength="5" readonly>
        </div>
        <div class="form-group col-md-12">
            <label for="whatsapp">Whatsapp</label>
            <input type="text" class="form-control" name="type" value="'.$row["whatsapp"].'"  maxlength="5" readonly>
        </div>
        <div class="form-group col-md-12">
            <label for="artsite">Artsite</label>
            <input type="text" class="form-control" name="type" value="'.$row["art_site"].'"  maxlength="5" readonly>
        </div>
        <div class="form-group col-md-12">
            <label for="other">Other</label>
            <input type="text" class="form-control" name="type" value="'.$row["other"].'"  maxlength="5" readonly>
        </div>
        <div class="form-group col-md-12">
            <label for="profile_pic">Profile Picture</label>
            <img src="images/profile_images/'.$row["profile_picture"].'" style="width:100px;height:120px;"readonly>
        </div>
        <br>
        <div class="text-left">
            <button type="submit" name="submit" class="btn btn-danger btn-md align-items-center">Delete</button>
        </div>
        <br> <br>
        
        </form>';
    }
} else {
    echo "0 results";
}
?>
</div>
</html>
