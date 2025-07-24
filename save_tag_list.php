<!-- 
    ICS 325 (summer 2025)
    Final Project
    Team DOLPHIN  🐬
-->

<?php
include('db_configuration.php');

// Database connection info
$host = "localhost";
$user = "root";
$pass = "";
$db = "abcd_db";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$old_file = 'abcd_tags.txt';
$backup_file = 'previous_abcd_tags.txt';

// Get submitted tags and split into lines
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tag_list'])) {
    $new_tags = trim($_POST['tag_list']);
    $tag_array = array_filter(array_map('trim', explode("\n", $new_tags)));

    // Ensure 'Custom' is always present
    if (!in_array('Custom', $tag_array)) {
        $tag_array[] = 'Custom';
    }

    $final_tags = implode("\n", $tag_array);

    // Backup old file if exists
    if (file_exists($old_file)) {
        copy($old_file, $backup_file);
    }

    // Write new tag list to file
    if (file_put_contents($old_file, $final_tags) === false) {
        echo "<script>alert('Failed to save new tag list.'); window.location='manage_tags.php';</script>";
        exit;
    }

    // Update database
    $conn->query("DELETE FROM dresses_tags_tbl");
    $stmt = $conn->prepare("INSERT INTO dresses_tags_tbl (tag_name) VALUES (?)");
    foreach ($tag_array as $tag) {
        $stmt->bind_param("s", $tag);
        $stmt->execute();
    }

    echo "<script>alert('Tag list updated successfully!'); window.location='manage_tags.php';</script>";
} else {
    echo "<script>alert('Invalid request.'); window.location='manage_tags.php';</script>";
}
?>
