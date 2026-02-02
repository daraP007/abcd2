<?php
include('header.php');
include_once 'db_configuration.php';
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./css/display_the_dress.css">
<link rel="stylesheet" href="./css/responsive_style.css">

<?php
if (isset($_GET['fav_status'])) {

  $fav_status = mysqli_real_escape_string($db, $_GET['fav_status']);
  if ($fav_status == "COOKIE_NOT_FOUND")
  {
    echo "Cookie Not Found. Using the system's default";
  }
  if ($fav_status == "DRESS_NOT_FOUND")
  {
    echo "Dress Not Found. Using the system's default";
  }
}

$id = false;

if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($db, $_GET['id']);
} else if(isset($_GET['name'])) {
  $name = mysqli_real_escape_string($db, $_GET['name']);
  $sql = "SELECT * FROM `dresses` WHERE name = '" . $name ."'";
  $result = mysqli_query($db, $sql);
  if ($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $id = $row["id"];
  }
}

if ($id){
  $minMaxSql = "SELECT MIN(id) as min_id, MAX(id) as max_id FROM `dresses`";
  $minMaxResult = mysqli_query($db, $minMaxSql);
  $minMaxRow = $minMaxResult->fetch_assoc();
  $min_id = $minMaxRow["min_id"];
  $max_id = $minMaxRow["max_id"];

  $prevSql = "SELECT id FROM `dresses` WHERE id < $id ORDER BY id DESC LIMIT 1";
  $nextSql = "SELECT id FROM `dresses` WHERE id > $id ORDER BY id ASC LIMIT 1";

  $prevResult = mysqli_query($db, $prevSql);
  $nextResult = mysqli_query($db, $nextSql);

  $prev_id = ($prevResult->num_rows > 0) ? $prevResult->fetch_assoc()["id"] : $max_id;
  $next_id = ($nextResult->num_rows > 0) ? $nextResult->fetch_assoc()["id"] : $min_id;

  $sql = "SELECT * FROM `dresses` WHERE id = " . $id;
  $row_data = mysqli_query($db, $sql);

  if ($row_data->num_rows > 0) {
      // fetch row_data from $_Globals
      while($row = $row_data->fetch_assoc()) { ?>
        <div class ="containerTitle"><h2 class= "headTwo"><?php echo $row["name"]; ?></h2></div>
          <div class="pageNavContainer">
            <tr class="pageNav">
              <td> <a class="pageLink pageButton" href="display_the_dress.php?id=<?php echo $min_id; ?>"><< First</a></td>
              <td> <a class="pageLink pageButton" href="display_the_dress.php?id=<?php echo $prev_id; ?>">Prev</a></td>
              <td> <a class="pageLink pageButton" href="display_the_dress.php?id=<?php echo $next_id; ?>">Next</a></td>
              <td> <a class="pageLink pageButton" href="display_the_dress.php?id=<?php echo $max_id; ?>">Last >></a></td>
            </tr>
          </div>
          <div class ="container">
            <div class='containerImage'><image class = 'image' src = images/dress_images/<?php echo $row["image_url"]; ?>></image></div>
            <div class="containerText">
              <h3 class= "title"><strong> Description: </strong></h3><p class= "words" ><?php echo $row["description"]; ?></p>
              <h3 class= "title"><strong> Did You Know? </strong></h3><p class= "words"><?php echo $row["did_you_know"]; ?></p>
              <h3 class= "title"><strong> Category </strong></h3><p class= "words"><?php echo $row["category"]; ?></p>
              <h3 class= "title"><strong> Type </strong></h3><p class= "words"><?php echo $row["type"] ?></p>
              <h3 class= "title"><strong> State Name </strong></h3><p class= "words"><?php echo $row["state_name"]; ?></p>
              <h3 class= "title"><strong> Key Words </strong></h3><p class= "words"><?php echo $row["key_words"]; ?></p>
              <h3 class= "title"><strong> Status </strong></h3><p class= "words"><?php echo $row["status"]; ?></p>
              <h3 class= "title"><strong> Notes </strong></h3><p class= "words"><?php echo $row["notes"]; ?></p>
            </div>
        </div>
      <?php }
  } else {
    print('no data');
  }

} else {
  print('no data');
}

?>
</body>
</html>
