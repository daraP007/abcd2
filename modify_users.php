
<?php $page_title = 'Modify Users'; ?>
<?php $page_title = 'Project ABCD > Modify Users'; ?>
<?php 
    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    $page="users.php";
    //verifyLogin($page);
 
?>
<html>
<head>
<link href="css/modify_users.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
  
</head>

<div class="container">


<?php
include_once 'db_configuration.php';

if (isset($_GET['id'])){

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM users
            WHERE id = '$id'";
    //echo $sql;
    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
    }//end if
}//end if

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      ?>

      <h2 id ='title'>Modify User</h2><br>
      <form action = "modify_the_user.php" method = "POST" enctype = "multipart/form-data" >
        <br>
        <h3 id = "userName"><?php echo $row["first_name"] ?></h3> <br>

        <div>
          <label for="id">Id</label>
          <input type="text" class="form-control" name="id" value= <?php echo $row["id"] ?> maxlength="5" style=width:400px readonly><br>
        </div>
      
        <div>
          <label for="name">First Name</label>
         <input type="text" class="form-control" name="first_name" value=<?php echo $row["first_name"] ?> maxlength="255" style=width:400px required><br>
        </div>
      
        <div>
          <label for="name">Last Name</label>
          <input type="text" class="form-control" name="last_name" value=<?php echo $row["last_name"] ?>  maxlength="255" style=width:400px required><br>
        </div>
      
        <div>
          <label for="description">Email</label>
          <textarea style=width:400px class="form-control" name= "email" cols="55" rows="6" required><?php echo $row["email"] ?></textarea>
        </div>

        <div>
          <label for="name">Role</label>
          <input type="text" class="form-control" name="role" value="<?php echo $row["role"] ?>"  maxlength="255" style=width:400px required><br>
        </div>
       
        <div class="btnContainer">
          <button type="submit" name="update_user" class="btn btn-primary btn-md align-items-center">Modify User</button>
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

