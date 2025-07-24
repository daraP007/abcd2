<!-- 
    ICS 325 (summer 2025)
    Final Project
    Team DOLPHIN  🐬
-->

<?php
$page_title = 'Edit Tag List';
include('header.php');
?>

<head>
    <link rel="stylesheet" href="css/tags.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f40040d297.js" crossorigin="anonymous"></script>
</head>

<div class="container mt-4">
    <br><br>
    <h2 id="title">Edit Tag List</h2>

    <form action="save_tag_list.php" method="post">
        <div class="form-group">
        <label for="tag_list">Edit Tags (one per line):</label>
        <textarea name="tag_list" id="tag_list" class="form-control" rows="12" required><?php
            $file = 'abcd_tags.txt';
            if (file_exists($file)) {
                echo htmlspecialchars(file_get_contents($file));
            } else {
            echo "Custom";
            }
        ?></textarea>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="manage_tags.php" class="btn btn-secondary">← Back to Manage Tags</a>
            <button type="submit" class="btn btn-primary">Save Tag List</button>
        </div>
    </form>
</div>

<footer class="page-footer text-center">
    <br>
    <p>© Summer 2025 Team DOLPHIN 🐬</p>
</footer>
