<!-- 
    ICS 325 (summer 2025)
    Final Project
    Team DOLPHIN  🐬
-->

<?php
// create_the_celebration.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('db_configuration.php');

// Database connection info
$host = "localhost";
$user = "root";
$pass = "";
$db = "abcd_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $resource_type = $_POST['resource_type'];
    $celebration_type = $_POST['celebration_type'];
    $celebration_date = $_POST['celebration_date'];
    $tags = $_POST['tags'];
    $resource_url = $_POST['resource_url'];
    $image = !empty($_POST['image']) ? $_POST['image'] : 'celebrations_default.png';

    $sql = "INSERT INTO celebrations_tbl (title, description, resource_type, celebration_type, celebration_date, tags, resource_url, image_name)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $title, $description, $resource_type, $celebration_type, $celebration_date, $tags, $resource_url, $image);

    if ($stmt->execute()) {
        echo "<div style='text-align:center; margin-top: 20px; color: green; font-weight: bold;'>Celebration created successfully!</div>";
        echo "<script>
                setTimeout(function() {
                    let referrer = document.referrer;
                    if (referrer.includes('admin_celebrations.php')) {
                        window.location.href = 'admin_celebrations.php';
                    } else {
                        window.location.href = 'create_celebration.php';
                    }
                }, 2000);
              </script>";
    } else {
        echo "<div style='text-align:center; margin-top: 20px; color: red; font-weight: bold;'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: create_celebration.php");
    exit();
}
?>

