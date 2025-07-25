<!-- 
    ICS 325 (summer 2025)
    Final Project
    Team DOLPHIN  🐬
-->

<!-- 
    ICS 325 (summer 2025)
    Final Project
    Team DOLPHIN  🐬
-->

<?php
$page_title = 'Project ABCD > Manage Tags';
include('header.php');

$tags_file = 'abcd_tags.txt';
$backup_file = 'previous_abcd_tags.txt';
$tags = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tags'])) {
        if (file_exists($tags_file)) {
            copy($tags_file, $backup_file); // Make a backup
        }

        file_put_contents($tags_file, $_POST['tags']);
        $tags = $_POST['tags'];
        $message = "Tag list updated successfully.";
    }
} else {
    if (file_exists($tags_file)) {
        $tags = file_get_contents($tags_file);
    }
}
?>

<head>
    <link rel="stylesheet" href="css/tags.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f40040d297.js" crossorigin="anonymous"></script>
</head>

<div class="container mt-4">
    <h2 id="title">Manage Tags</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>

    <div class="button-group">
        <a href="edit_tag_list.php" class="btn">Modify Tag List</a>
        <a href="generate_tag_report.php" class="btn">Run Tag Report</a>
    </div>

    <!-- Load tags from file section -->
<form method="POST" action="load_tags_from_file.php" enctype="multipart/form-data">
    <br>
    <h1 id="section-heading">Load Tags from File</h1>
    <p class="instruction" style="font-size: 20px;">Upload a .txt file to load tags into the system. One tag/term per line.</p>
    <div style="text-align: center; margin-top: 20px; font-size: 18px;">
        <label for="tag_file" class="instruction" style="font-size: 18px;">Choose a .txt file:</label><br>
        <input type="file" name="tag_file" id="tag_file" accept=".txt" required><br><br>
        <button type="submit" class="btn btn-secondary">Load Tags from File</button>
    </div>
</form>
</div>

<footer class="page-footer text-center">
    <br>
    <p>© Summer 2025 Team DOLPHIN 🐬</p>
</footer>