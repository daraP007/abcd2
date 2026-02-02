
<?php $page_title = 'Project ABCD > Delete User'; ?>
<?php 
//edited by Ria
    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    $page="users.php";
    //verifyLogin($page);

?>
<div class="container">
<style>#title {text-align: center; color: darkgoldenrod;}
.thumbnailSize{
        height: 100px;
        width: 100px;
        transition:transform 0.25s ease;
    }
    .thumbnailSize:hover {
        -webkit-transform:scale(3.5);
        transform:scale(3.5);
    }
</style>
<?php
include_once 'db_configuration.php';

if (isset($_GET['id'])){

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM users
            WHERE id = '$id'";

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
    }//end if
}//end if

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<form action="delete_the_user.php" method="POST">
    <br>
    <h3 id="title">Delete User?</h3><br>

    <div class="form-group col-md-4">
      <label for="id">Id</label>
      <input type="text" class="form-control" name="id" value="'.$row["id"].'"  maxlength="5" readonly>
    </div>
    
    <div class="form-group col-md-8">
      <label for="first_name">First Name</label>
      <input type="text" class="form-control" name="first_name" value="'.$row["first_name"].'"  maxlength="255" readonly>
    </div>

    <div class="form-group col-md-8">
      <label for="last_name">Last Name</label>
      <input type="text" class="form-control" name="last_name" value="'.$row["last_name"].'"  maxlength="255" readonly>
    </div>
    
    <div class="form-group col-md-4">
      <label for="email">Email</label>
      <input type="text" class="form-control" name="email" value="'.$row["email"].'"  maxlength="255" readonly>
    </div>
        
    <div class="form-group col-md-4">
      <label for="role">Role</label>
      <input type="text" class="form-control" name="role" value="'.$row["role"].'"  maxlength="255" readonly>
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


