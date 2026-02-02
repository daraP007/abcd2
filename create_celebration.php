<?php
// require_once 'bin/debug_config.php'; //uncomment if debugging is needed

session_start();

// admin check and redirect to loginForm.php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>
            window.location.href = 'loginForm.php';
          </script>";
    exit;
}
// set page title before including header
$page_title = 'Project ABCD > Create Celebration';
include('header.php');
?>

<head>
    <link rel="stylesheet" type="text/css" href="css/list_celebrations.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
</head>

<br><br>
<div class="container-fluid">
    <h2 id="title">Create a Celebration</h2><br>
</div>

<form action="create_the_celebration.php" method="POST" class="form-horizontal" style="width:80%; margin: 0 auto;" enctyype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title:</label>
    <input class="form-control" type="text" name="title" required>
  </div>
  <div class="form-group">
    <label for="description">Description:</label>
    <textarea class="form-control" name="description" rows="4" required></textarea>
  </div>
  <div class="form-group">
    <label for="resource_type">Resource Type:</label>
    <input class="form-control" type="text" name="resource_type" required>
  </div>
  <div class="form-group">
    <label for="celebration_type">Celebration Type:</label>
    <select class="form-control" name="celebration_type">
      <option value="Person">Person</option>
      <option value="Event">Event</option>
    </select>
  </div>
  <div class="form-group">
    <label for="celebration_date">Date:</label>
    <input class="form-control" type="date" name="celebration_date" required>
  </div>
  <div class="form-group">
    <label for="tags">Tags:</label>
    <input class="form-control" type="text" name="tags" required>
  </div>
  <div class="form-group">
    <label for="resource_url">Resource Link (URL):</label>
    <input class="form-control" type="url" name="resource_url" required>
  </div>

<!--Changed to type file, added ID -->
  <div class="form-group">
    <label for="image">Image Upload:</label>
    <input class="form-control" type="file" name="image" id="image">
  </div>
  
<!-- Spot for preview -->
  <div style="margin-top: 10px;">
      <img id="imagePreview" src="" style="display:none; max-width:200px; border:1px solid #000000ff; padding:5px;">
  </div>

  <div class="form-group text-center mt-4">
    <input class="btn btn-primary" type="submit" name="submit" value="Create Celebration">
  </div>


  <script>
  document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
    });
</script>


  <footer class="page-footer text-center">
    <br>
    <p>© Summer 2025 Team DOLPHIN 🐬</p>
</footer>
</form>

