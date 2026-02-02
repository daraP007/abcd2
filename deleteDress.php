<?php 
//edited by Ria
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    include_once 'db_configuration.php';
    $page_title = 'Project ABCD > Delete Dress';
    $page="deleteDress.php";
    verifyLogin($page);

?>

<head>
<link href="css/deleteDress.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
  
</head>

<div class="container">
<?php
if (isset($_GET['id'])){

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM dresses
            WHERE id = '$id'";

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
    }//end if
}//end if

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<form action="delete_the_dress.php" method="POST">
    <br>
    <h3 id="title">Delete Dress?</h3><br>
    <h2 id="description">'.$row["name"].' - '.$row["description"].'   </h2> <br>

    <div class="imgCont">
    <img class="thumbnailSize" src="' . "images/dress_images/" .$row["image_url"]. '" alt="'.$row["image_url"].'">
    </div>
    <br>
    <br>

    
    <div class="form-group col-md-4">
      <label for="id">Id</label>
      <input type="text" class="form-control" name="id" value="'.$row["id"].'"  maxlength="5" readonly>
    </div>
    
    <div class="form-group col-md-8">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" value="'.$row["name"].'"  maxlength="255" readonly>
    </div>
    
    <div class="form-group col-md-4">
      <label for="description">Description</label>
      <input type="text" class="form-control" name="description" value="'.$row["description"].'"  maxlength="255" readonly>
    </div>
        
    <div class="form-group col-md-4">
      <label for="did_you_know">Did you know?</label>
      <input type="text" class="form-control" name="did_you_know" value="'.$row["did_you_know"].'"  maxlength="255" readonly>
    </div>
        
    <div class="form-group col-md-4">
      <label for="category">Category</label>
      <input type="text" class="form-control" name="category" value="'.$row["category"].'"  maxlength="255" readonly>
    </div>

    <div class="form-group col-md-12">
      <label for="description">Type</label>
      <input type="text" class="form-control" name="type" value="'.$row["type"].'"  maxlength="255" readonly>
    </div>

    <div class="form-group col-md-6">
      <label for="state_name">State name</label>
      <input type="text" class="form-control" name="state_name" value="'.$row["state_name"].'"  maxlength="255" readonly>
    </div>
    
    <div class="form-group col-md-6">
      <label for="optional">Key words</label>
      <input type="text" class="form-control" name="key_words" value="'.$row["key_words"].'"  maxlength="255" readonly>
    </div>
           
    <br>
    <div class="btnContainer">
        <button type="submit" name="submit" class="btn btn-danger btn-md align-items-center">Delete</button>
    </div>
    <br> <br>
    
    </form>';

    }//end while
}//end if
else {
    echo "0 results";
}//end else

?>

</div>


