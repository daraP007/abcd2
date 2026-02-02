
<?php $page_title = 'Modify Resource'; ?>
<?php $page_title = 'Project ABCD > Modify Resource'; ?>
<?php 
    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    $page="list_dresses.php";
    //verifyLogin($page);
 
?>
<html>

<style>
.head {
  text-align: center;
  font-family: "Times New Roman";
  color: rgb(200,55,0);
}

.title {
  text-align: center;
  font-family: "Times New Roman";
  color: rgb(0,200,55);
}

.words{
  text-align: center;
  font-family: "Times New Roman";
}

#guidance {
        color: grey;
        font-size: 10px;
}
</style>
<div class="container">
<style>#title {text-align: center; color: darkgoldenrod;}</style>

<?php
include_once 'db_configuration.php';

if (isset($_GET['id'])){

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM resources
            WHERE id = '$id'";

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
    }//end if
}//end if

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      if(isset($_GET['modifyDress'])){
        if($_GET["modifyDress"] == "fileRealFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not real, Please Try Again!</h3>';
        }
      }
      if(isset($_GET['modifyDress'])){
        if($_GET["modifyDress"] == "answerFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your answer was not one of the choices, Please Try Again!</h3>';
        }
      }
      if(isset($_GET['modifyDress'])){
        if($_GET["modifyDress"] == "fileTypeFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not a valid image type (jpg,jpeg,png,gif), Please Try Again!</h3>';
        }
      }
      if(isset($_GET['modifyDress'])){
        if($_GET["modifyDress"] == "fileExistFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image does not exist, Please Try Again!</h3>';
        }
      }
      
?>


      <h2 id="title">Modify Resource</h2><br>;
      <form action="modify_the_resource.php" method="POST" enctype="multipart/form-data">
      <br>
      <h3><?php echo $row["first_name"] ?> </h3> <br>
      
      <div>
        <label for="id">Id</label>
        <input type="text" class="form-control" name="id" value=<?php echo $row["id"] ?>  maxlength="5" style=width:400px readonly><br>
      </div>
      
      <div>
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" value=<?php echo $row["name"] ?>  maxlength="255" style=width:400px readonly><br>
      </div>
      
      <div>
      
        <label for="url">url</label>
        <textarea style=width:400px class="form-control" name= "url" cols="55" rows="6" required><?php echo $row["url"] ?></textarea>
        </div>
          

      <div>
        <label for="type">Type</label> <label id="guidance"> (image, video, wiki, pdf, doc, audio, other)</label> <br>
        <input type="text" class="form-control" name="type" value=<?php echo $row["type"] ?>  maxlength="255" style=width:400px required><br>
      </div>
      
      <div>
        <label for="notes">Notes</label>
        <input type="text" class="form-control" name="notes" value=<?php echo $row["notes"] ?> maxlength="255" style=width:400px><br>
      </div>

      <br>
      <div class="text-left">
          <button type="submit" name="update_resource" class="btn btn-primary btn-md align-items-center">Modify Resource</button>
      </div>
      <br>

      <br> <br>
      
      </form>

<?php
}
}else {
    echo "0 results";
}//end else

?>

</div>
</html>


