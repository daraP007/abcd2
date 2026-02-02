<?php 
$page_title = 'Modify Nomination';
require 'bin/functions.php';
require 'db_configuration.php';
include('header.php'); 
$page = "blogs.php";
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
    $sql = "SELECT * FROM blogs WHERE Blog_Id = '$id'";
    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error. ']');
    }
}

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?>
        <h2 id="title">Modify Blog Post</h2><br>
        <form action="modify_the_blog.php" method="POST" enctype="multipart/form-data">
            <br>
            <div>
                <label for="id">Id</label>
                <input type="text" class="form-control" name="id" value="<?php echo $row["Blog_Id"]; ?>" style="width:400px" readonly><br>
            </div>
            <div>
                <label for="title">Title</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="<?php echo $row["Title"]; ?>" style="width:400px"><br>
                </div>
            </div>

            <div>
                <label for="author">Author</label>
                <input type="text" class="form-control" name="author" value="<?php echo $row["Author"]; ?>" style="width:400px" required><br>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea style="width:400px" class="form-control" name="description" cols="55" rows="6" required><?php echo $row["Description"]; ?></textarea>
            </div>

            <div>
                <label for="video_link">Video Links</label>
                <input style="width:400px" class="form-control" name="video_link" value="<?php echo $row["Video_Link"]; ?>"> </input>
            </div>

            <div>
                <label for="video_link"></label>
                <input style="width:400px" class="form-control" name="video_link2" value="<?php echo $row["Video_Link2"]; ?>"> </input>
            </div>

            <div>
                <label for="video_link"></label>
                <input style="width:400px" class="form-control" name="video_link3" value="<?php echo $row["Video_Link3"]; ?>"> </input>
            </div>

            <div class="btnContainer">
                <button type="submit" name="update_blog" class="btn btn-primary btn-md align-items-center">Modify Blog</button>
            </div>
            <br>
            <br>
        </form>
<?php
    }
} else {
    echo "0 results";
}
?>
</div>
</html>
