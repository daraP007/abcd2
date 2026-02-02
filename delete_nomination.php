
<?php $page_title = 'Project ABCD > Delete Nomination'; ?>
<?php 
    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    $page="resources.php";
    //verifyLogin($page);

?>

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
    
    $sql = "SELECT * FROM nominations
            WHERE id = '$id'";

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
    }//end if
}//end if

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<form action="delete_the_nomination.php" method="POST">
    <br>
    <h3 id="title" style= "margin-top: 20px;">Delete Nomination?</h3><br>
    <h2>'.$row["name"].' </h2> <br>

    
    <div class="form-group col-md-4">
      <label for="id">Id</label>
      <input type="text" class="form-control" name="id" value="'.$row["id"].'"  maxlength="5" readonly>
    </div>
    
    <div class="form-group col-md-8">
      <label for="name">Category</label>
      <input type="text" class="form-control" name="name" value="'.$row["category"].'"  maxlength="255" readonly>
    </div>
    
    <div class="form-group col-md-4">
      <label for="url">Name</label>
      <input type="text" class="form-control" name="url" value="'.$row["name"].'"  maxlength="255" readonly>
    </div>
        

    <div class="form-group col-md-12">
      <label for="description">Description</label>
      <input type="text" class="form-control" name="type" value="'.$row["description"].'"  maxlength="255" readonly>
    </div>

           
    <br>
    <div class="text-left">
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


