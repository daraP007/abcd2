<html>

<head>
<link href="css/display_the_user.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
  
</head>

<body>

<?php
include('header.php');
include_once 'db_configuration.php';
?>


<div class="userContainer">
<?php
if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($db, $_GET['id']);
    $sql = "SELECT * FROM `users` WHERE id = " . $id;
    $GLOBALS['row_data'] = mysqli_query($db, $sql);
} 
else if(isset($_GET['first_name'])) {

    $name = mysqli_real_escape_string($db, $_GET['first_name']);
    $sql = "SELECT * FROM `users` WHERE name = '" . $first_name ."'";
    $GLOBALS['row_data'] = mysqli_query($db, $sql);
}

if ($row_data->num_rows > 0) {
    // fetch row_data from $_Globals
    while($row = $row_data->fetch_assoc()) {
      print( '<h2 class= "head">'.$row["id"]. '</h2>'); 
      print( '<h3 class= "title"> First name: </h3><p class= "words" >'.$row["first_name"]. '</p>
              <h3 class= "title"> Last name: </h3><p class= "words" >'.$row["last_name"]. '</p>
              <h3 class= "title"> Email: </h3><p class= "words">' .$row["email"]. '</p>
              <h3 class= "title"> Role: </h3><p class= "words">' .$row["role"]. '</p>' );
    }
} else {
  print('no data');
}

?>
</div>
</body>
</html>
