<!-- 
    ICS 325 (summer 2025)
    Final Project
    Team DOLPHIN  🐬
-->

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
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

// Ensure the uploads directory exists and is writable
$target_file = 'abcd_tags.txt';
$backup_file = 'previous_tags_list.txt';

if (isset($_FILES['tag_file']) && $_FILES['tag_file']['error'] == UPLOAD_ERR_OK) {
    // Step 1: Backup existing file if it exists
    if (file_exists($target_file)) {
        rename($target_file, $backup_file);
    }

    // Step 2: Move new file to destination
    if (move_uploaded_file($_FILES['tag_file']['tmp_name'], $target_file)) {
        // Step 3: Open file and update database
        $tags = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // Step 4: Clear existing table
        $clear_sql = "TRUNCATE TABLE dresses_tags_tbl";
        mysqli_query($conn, $clear_sql);

        // Step 5: Insert tags from file
        $stmt = $conn->prepare("INSERT INTO dresses_tags_tbl (tag_name, last_updated) VALUES (?, NOW())");
        foreach ($tags as $tag) {
            $trimmed = trim($tag);
            if (!empty($trimmed)) {
                $stmt->bind_param("s", $trimmed);
                $stmt->execute();
            }
        }

        /*
        $stmt = $conn->prepare("INSERT INTO dresses_tags_tbl (tag_name) VALUES (?)");
        foreach ($tags as $tag) {
            $trimmed = trim($tag);
            if (!empty($trimmed)) {
                $stmt->bind_param("s", $trimmed);
                $stmt->execute();
            }
        }
            */

        // Step 6: Add 'Custom' tag if not already in file
        if (!in_array('Custom', $tags)) {
            $custom = 'Custom';
            $stmt->bind_param("s", $custom);
            $stmt->execute();
        }

        $stmt->close();
        $conn->close();

        echo "<script>alert('Tags loaded and database updated successfully.'); window.location.href='manage_tags.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to save uploaded tag file.'); window.location.href='manage_tags.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No file selected or file upload error.'); window.location.href='manage_tags.php';</script>";
    exit();
}
?>
