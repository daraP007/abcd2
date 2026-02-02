<html>

<style>
.head {
  font-family: "Times New Roman";
  color: darkgoldenrod;
  text-align: center;
}

.body {
  text-align: center;
}

.title {
  font-family: "Times New Roman";
  color: rgb(0,200,55);
  font-size: 1.5rem;
}

.words{
  font-family: "Times New Roman";
}

.container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

.image {
    height: 300px;
    padding: 8px 8px 8px 8px;
}
</style>

<body class= "body">

<?php
include('header.php');
include_once 'db_configuration.php';

if (isset($_GET['fav_status'])) {

  $fav_status = mysqli_real_escape_string($db, $_GET['fav_status']);
  if ($fav_status == "COOKIE_NOT_FOUND")
  {
    echo "Cookie Not Found. Using the system's default";
  }
}

if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($db, $_GET['id']);
    $sql = "SELECT id, CONCAT(first_name,' ',last_name) AS name, profile_picture, description, country, facebook, instagram, twitter, whatsapp, art_site, other FROM artists LEFT JOIN users ON id = user_id WHERE id =" . $id;
    $GLOBALS['row_data'] = mysqli_query($db, $sql);
} 
else if(isset($_GET['name'])) {

    $name = mysqli_real_escape_string($db, $_GET['name']);
    $sql = "SELECT id, CONCAT(first_name,' ',last_name) AS name, profile_picture, description, country, facebook, instagram, twitter, whatsapp, art_site, other FROM artists LEFT JOIN users ON id = user_id where name =" . $name ."'";
    $GLOBALS['row_data'] = mysqli_query($db, $sql);
}

if ($row_data->num_rows > 0) {
    // fetch row_data from $_Globals
    while($row = $row_data->fetch_assoc()) {
      print( '<div class ="container"><div class="row"><div class="col"><h2 class= "head">'.$row["name"]. '</h2></div></div></div>');
      echo("<div class='container'><div class='row'><div class='col'><image class = 'image' src = images/profile_images/".$row["profile_picture"]. "></image></div></div></div>");    
      print( '<div class="container"><div class="row"><div class="col"><h3 class= "title"> Description: </h3><p class= "words" >'.$row["description"]. '</p></div></div>
      <div class="row"><div class="col"><h3 class= "title"> Country </h3><p class= "words">' .$row["country"]. '</p></div></div>
      <div class="row"><div class="col"><h3 class= "title"> Facebook </h3><p class= "words">' .$row["facebook"]. '</p></div></div>
      <div class="row"><div class="col"><h3 class= "title"> Instagram </h3><p class= "words">' .$row["instagram"]. '</p></div></div>
      <div class="row"><div class="col"><h3 class= "title"> Twitter </h3><p class= "words">' .$row["twitter"]. '</p></div></div>
      <div class="row"><div class="col"><h3 class= "title"> WhatsApp </h3><p class= "words">' .$row["whatsapp"]. '</p></div></div>
      <div class="row"><div class="col"><h3 class= "title"> Art Site </h3><p class= "words">' .$row["art_site"]. '</p></div></div>
      <div class="row"><div class="col"><h3 class= "title"> Other </h3><p class= "words">' .$row["other"]. '</p></div></div></div>' );
    }
} else {
  print('no data');
}

?>
</body>
</html>
