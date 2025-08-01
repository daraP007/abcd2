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
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// fetch celebrations data
$sql = "SELECT * FROM celebrations_tbl ORDER BY celebration_date";
$result = $conn->query($sql);

// check if user is admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // redirect unauthorized access
    header("Location: list_dresses.php");
    echo "<script>alert('Unauthorized access.'); window.location.href='list_dresses.php';</script>";
    exit;
}

// check connection
if ($conn->connect_error) {
    echo "<script>alert('Database connection failed.'); window.location.href='list_dresses.php';</script>";
    exit;
}

// file upload handler
if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['csvFile']['tmp_name'];
    $file = fopen($tmpName, 'r');

    if ($file !== false) {
        $headers = fgetcsv($file);
        $idIndex = array_search('ID', $headers);
        $keywordsIndex = array_search('Key Words', $headers);

        if ($idIndex === false || $keywordsIndex === false) {
            fclose($file);
            echo "<script>alert('CSV file must contain ID and Key Words columns.'); window.location.href='list_dresses.php';</script>";
            exit;
        }

        $updated = 0;

        while (($row = fgetcsv($file)) !== false) {
            $id = trim($row[$idIndex]);
            $keywords = trim($row[$keywordsIndex]);

            if (!empty($id)) {
                $stmt = $conn->prepare("UPDATE dresses SET key_words = ? WHERE id = ?");
                $stmt->bind_param("si", $keywords, $id);
                if ($stmt->execute()) {
                    $updated++;
                }
                $stmt->close();
            }
        }

        fclose($file);
        echo "<script>alert('Upload successful. $updated entries updated.'); window.location.href='list_dresses.php';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to read the uploaded file.'); window.location.href='list_dresses.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('No valid file uploaded.'); window.location.href='list_dresses.php';</script>";
    exit;
}
?>
