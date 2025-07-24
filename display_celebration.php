<!-- 
    ICS 325 (summer 2025)
    Final Project
    Team DOLPHIN  🐬
-->

<?php
include('header.php');
include_once 'db_configuration.php';
$page_title = 'Project ABCD > Display Celebration';
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./css/display_celebration.css">
<link rel="stylesheet" href="./css/responsive_style.css">

<?php
if (isset($_GET['fav_status'])) {

  $fav_status = mysqli_real_escape_string($db, $_GET['fav_status']);
  if ($fav_status == "COOKIE_NOT_FOUND")
  {
    echo "Cookie Not Found. Using the system's default";
  }
  if ($fav_status == "CELEBRATION_NOT_FOUND")
  {
    echo "CELEBRATION Not Found. Using the system's default";
  }
}

$id = false;

if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($db, $_GET['id']);
} else if (isset($_GET['title'])) {
  $title = mysqli_real_escape_string($db, $_GET['title']);
  $sql = "SELECT * FROM `celebrations_tbl` WHERE title = '" . $title . "'";
  $result = mysqli_query($db, $sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row["id"];
  }
}
if ($id) {
  $minMaxSql = "SELECT MIN(id) as min_id, MAX(id) as max_id FROM `celebrations_tbl`";
  $minMaxResult = mysqli_query($db, $minMaxSql);
  $minMaxRow = $minMaxResult->fetch_assoc();
  $min_id = $minMaxRow["min_id"];
  $max_id = $minMaxRow["max_id"];

  $prevSql = "SELECT id FROM `celebrations_tbl` WHERE id < $id ORDER BY id DESC LIMIT 1";
  $nextSql = "SELECT id FROM `celebrations_tbl` WHERE id > $id ORDER BY id ASC LIMIT 1";

  $prevResult = mysqli_query($db, $prevSql);
  $nextResult = mysqli_query($db, $nextSql);

  $prev_id = ($prevResult->num_rows > 0) ? $prevResult->fetch_assoc()["id"] : $max_id;
  $next_id = ($nextResult->num_rows > 0) ? $nextResult->fetch_assoc()["id"] : $min_id;

  $sql = "SELECT * FROM `celebrations_tbl` WHERE id = " . $id;
  $row_data = mysqli_query($db, $sql);
}

if ($row_data->num_rows > 0) {
    // fetch row_data from celebrations_tbl
    while ($row = $row_data->fetch_assoc()) { ?>
        <div class="containerTitle"><h2 class="headTwo"><?php echo $row["title"]; ?></h2></div>
        <div class="pageNavContainer">
          <tr class="pageNav">
            <td> <a class="pageLink pageButton" href="display_celebration.php?id=<?php echo $min_id; ?>"><< First</a></td>
            <td> <a class="pageLink pageButton" href="display_celebration.php?id=<?php echo $prev_id; ?>">Prev</a></td>
            <td> <a class="pageLink pageButton" href="display_celebration.php?id=<?php echo $next_id; ?>">Next</a></td>
            <td> <a class="pageLink pageButton" href="display_celebration.php?id=<?php echo $max_id; ?>">Last >></a></td>
          </tr>
        </div>

        <div class="container">
          <div class="containerImage">
            <img class="image_name" src="images/celebrations/<?php echo $row["image_name"]; ?>" alt="Celebration Image">
          </div>
          <div class="containerText">
            <h3 class="title"><strong>Description:</strong></h3><p class="words"><?php echo $row["description"]; ?></p>
            <h3 class="title"><strong>Resource Type:</strong></h3><p class="words"><?php echo $row["resource_type"]; ?></p>
            <h3 class="title"><strong>Celebration Type:</strong></h3><p class="words"><?php echo $row["celebration_type"]; ?></p>
            <h3 class="title"><strong>Date:</strong></h3><p class="words"><?php echo $row["celebration_date"]; ?></p>
            <h3 class="title"><strong>Tags:</strong></h3><p class="words"><?php echo $row["tags"]; ?></p>
            <h3 class="title"><strong>Resource Link:</strong></h3>
            <p class="words">
              <a href="<?php echo $row["resource_url"]; ?>" target="_blank">View Resource</a>
            </p>
          </div>
        </div>
    <?php }
} else {
    echo "<div class='container mt-5'><div class='alert alert-warning'>No celebration data found.</div></div>";
}

?>
</body>
</html>