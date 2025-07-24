<?php 
$page_title = 'Modify Artist';
require 'bin/functions.php';
require 'db_configuration.php';
include('header.php'); 
$page = "modify_artist.php";
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

if (isset($_GET['user_id'])){
    $id = $_GET['user_id'];
    $sql = "SELECT artists.*, CONCAT(users.first_name, ' ', users.last_name) AS name 
        FROM artists 
        LEFT JOIN users ON artists.user_id = users.id
        WHERE artists.user_id = $id";
    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error. ']');
    }
}

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?>
        <h2 id="title">Modify Artist</h2><br>
        <form action="modify_the_artist.php" method="POST" enctype="multipart/form-data">
            <br>
		
			

            <div class="form-group col-md-4">
				<label for="profile_picture">Profile Picture:</label>
				<div>
					<?php echo '<img src="images/profile_images/'.$row["profile_picture"].'" id="preview_image" style="width:300px;height:300px;">'; ?>
				</div>
				<input style="width:400px" type="file" name="new_profile_picture" id="fileToUpload" accept="image/jpg, image/jpeg, image/png" title="Please select an image file" onchange="previewImage(event)">
				<br>
				<img id="output" width="300" />
			</div>
	
			<div>
				<label for="name">Artist Name</label>
				<input type="text" class="form-control" name="name" value="<?php echo $row["name"]; ?>" maxlength="255" style="width:400px" required readonly><br>            
			</div>
				
			<div>
				<label for="user_id">User ID</label>
				<input type="text" class="form-control" name="user_id" value="<?php echo $row["user_id"]; ?>" maxlength="255" style="width:400px" required readonly><br>            
			</div>

			<div>
				<label for="approval_status">Approval Status</label>
				<select name="approval_status" class="form-control" style="width:400px" required>
					<option value="pending" <?php if($row["approval_status"] == 'pending') echo 'selected'; ?>>Pending</option>
					<option value="approved" <?php if($row["approval_status"] == 'approved') echo 'selected'; ?>>Approved</option>
					<option value="rejected" <?php if($row["approval_status"] == 'rejected') echo 'selected'; ?>>Rejected</option>
				</select>
				<br>            
			</div>
		
			<div>
				<label for="description">Description</label>
				<input type="text" class="form-control" name="description" value="<?php echo $row["description"]; ?>" maxlength="255" style="width:400px" required><br>            
			</div>
		
			<div>
				<label for="country">Country</label>
				<input type="text" class="form-control" name="country" value="<?php echo $row["country"]; ?>" maxlength="255" style="width:400px" required><br>            
			</div>
			
			<div>
				<label for="art_site">Personal Site</label>
				<input type="text" class="form-control" name="art_site" value="<?php echo $row["art_site"]; ?>" maxlength="255" style="width:400px" required><br>            
			</div>
			
			<div>
				<label for="facebook">Facebook</label>
				<input type="text" class="form-control" name="facebook" value="<?php echo $row["facebook"]; ?>" maxlength="255" style="width:400px" required><br>            
			</div>
			
			<div>
				<label for="instagram">Instagram</label>
				<input type="text" class="form-control" name="instagram" value="<?php echo $row["instagram"]; ?>" maxlength="255" style="width:400px" required><br>            
			</div>
			
			<div>
				<label for="twitter">Twitter</label>
				<input type="text" class="form-control" name="twitter" value="<?php echo $row["twitter"]; ?>" maxlength="255" style="width:400px" required><br>            
			</div>
			
			<div>
				<label for="whatsapp">WhatsApp</label>
				<input type="text" class="form-control" name="whatsapp" value="<?php echo $row["whatsapp"]; ?>" maxlength="255" style="width:400px" required><br>            
			</div>
			
			<div>
				<label for="other">Other</label>
				<input type="text" class="form-control" name="other" value="<?php echo $row["other"]; ?>" maxlength="255" style="width:400px" required><br>            
			</div>
					           			
            <div class="btnContainer">
                <button type="submit" name="update_artist" class="btn btn-primary btn-md align-items-center">Modify Artist</button>
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

<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>


</html>
