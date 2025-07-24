<?php 
    $status = session_status();
    if ($status == PHP_SESSION_NONE) {
        session_start();
    }
    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    $page_title = 'Project ABCD > Modify Dresses';
    $page="modify_dress.php";
    verifyLogin($page);
 
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
    
    $sql = "SELECT * FROM dresses
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
      // Obtain status value from DB and set as selected for drop down
      $status_array=['proposed', 'approved', 'writeup_done' , 'art_work_done' , 'designed', 'completed'];
      $res = $db->query($sql);
        $r = $res->fetch_assoc();
      
        $num = count($status_array);

        for ($i=0 ; $i < $num ; $i++) {

          if ($status_array[$i] == $r["status"]){
            $status_array[$i] = "$status_array[$i]" .'"'. ' selected = "selected" ' ;
            }
        else $status_array[$i] = "$status_array[$i]";
        }
    



      echo '<h2 id="title">Modify Dress</h2><br>';
      echo '<form action="modify_the_dress.php" method="POST" enctype="multipart/form-data">
      <br>
      <h3>'.$row["name"].' </h3> <br>
      
      <div>
        <label for="id">Id</label>
        <input type="text" class="form-control" name="id" value="'.$row["id"].'"  maxlength="5" style=width:400px readonly><br>
      </div>
      
      <div>
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" value="'.$row["name"].'"  maxlength="255" style=width:400px required><br>
      </div>
      
      <div>
      
        <label for="description">Description</label>
        <textarea style=width:400px class="form-control" name= "description" cols="55" rows="6" required>'.$row["description"].'</textarea>
        </div>
          
      <div>
        <label for="did_you_know">Did you know? </label>
        <textarea style=width:400px class="form-control" name= "did_you_know" cols="55" rows="2" required>'.$row["did_you_know"].'</textarea>
      </div>
          
      <div>
        <label for="category">Category</label> <label id="guidance"> (regional, religious, people, dresses, festivals, other)</label><br>
        <input type="text" class="form-control" name="category" value="'.$row["category"].'"  maxlength="255" style=width:400px ><br>
      </div>

      <div>
        <label for="type">Type</label> <label id="guidance"> (boys, girls, men, women, other)</label> <br>
        <input type="text" class="form-control" name="type" value="'.$row["type"].'"  maxlength="255" style=width:400px required><br>
      </div>

      <div>
        <label for="state_name">State name</label>
        <input type="text" class="form-control" name="state_name" value="'.$row["state_name"].'"  maxlength="255" style=width:400px ><br>
      </div>

      <div>
      <label for="key_words">Key words</label>
      <input type="text" class="form-control" name="key_words" value="'.$row["key_words"].'"  maxlength="255" style=width:400px ><br>
    </div>
    <div>
    <label for="tag_line">Tag Line</label>
    <input type="text" class="form-control" name="tag_line" value="'.$row["tag_line"].'"  maxlength="255" style=width:400px ><br>
  </div>

      <div>
            <label>Status</label> <br>
            <select style=width:400px class="form-control" id="status" name="status" >
                <option value="'.$status_array[0].'">Proposed</option>
                <option value="'.$status_array[1].'">Approved</option>
                <option value="'.$status_array[2].'">Write-up Done</option>
                <option value="'.$status_array[3].'">Art Work Done</option>
                <option value="'.$status_array[4].'">Design Done</option>
                <option value="'.$status_array[5].'">Completed</option>
            </select>
        </div>

        <div>
        <label for="notes">Notes</label>
        <input type="text" class="form-control" name="notes" value="'.$row["notes"].'"  maxlength="255" style=width:400px><br>
      </div>

      
      <img  src="' . "images/dress_images/" .$row["image_url"].  '" width= "100" height= "100" alt="'.$row["image_url"].'">
      <div class="form-group col-md-4">
        <label for="cadence"> Choose a file to change above image (Optional)</label>
        <input type="file" name="fileToUpload" id="fileToUpload" maxlength="255">
      </div>
      <input type="hidden" class="form-control" name="oldimage" value="'.$row["image_url"].'" maxlength="255" required>
      <br>
      <div class="text-left">
          <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Modify Dress</button>
      </div>
      <br>

      <br> <br>
      
      </form>';
    
    }//end while
}//end if
else {
    echo "0 results";
}//end else

?>

</div>
</html>