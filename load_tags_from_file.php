<?php
session_start();

require 'bin/functions.php';
require_once 'db_configuration.php';

// Database connection info
$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

    // ICS 325 (summer 2025)
    // Final Project
    // Team DOLPHIN  🐬

// error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ensure the target file and backup file paths are correct
$target_file = __DIR__ . '/reports/abcd_tags.txt';
$backup_file = __DIR__ . '/reports/previous_tags_list.txt';

if (isset($_FILES['tag_file']) && $_FILES['tag_file']['error'] == UPLOAD_ERR_OK) {
    // backup the existing file if it exists
    if (file_exists($target_file)) {
        rename($target_file, $backup_file);
    }

    // move the uploaded file to the target location
    if (move_uploaded_file($_FILES['tag_file']['tmp_name'], $target_file)) {
        // read the file and update the database
        $tags = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // clear existing tags in the database
        $clear_sql = "TRUNCATE TABLE dresses_tags_tbl";
        mysqli_query($conn, $clear_sql);

        // insert new tags into the database
        $stmt = $conn->prepare("INSERT INTO dresses_tags_tbl (tag_name, last_updated) VALUES (?, NOW())");
        foreach ($tags as $tag) {
            $trimmed = trim($tag);
            if (!empty($trimmed)) {
                $stmt->bind_param("s", $trimmed);
                $stmt->execute();
            }
        }

        // add 'Custom' tag if not already present
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
