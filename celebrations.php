<?php

    // ICS 325 (summer 2025)
    // Final Project
    // Team DOLPHIN  🐬

ini_set('display_errors', 1);
error_reporting(E_ALL);

$page_title = 'Project ABCD > Celebrations';

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

// Fetch celebrations data
$sql = "SELECT * FROM celebrations_tbl ORDER BY celebration_date";
$result = $conn->query($sql);

?>

<?php include('header.php'); ?>

<head>
    <link rel="stylesheet" type="text/css" href="css/list_celebrations.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

</head>
<br><br>
<div class="container-fluid">
    <br>
    <h2 id="title">Today's Celebrations</h2><br>
<!-- This portion will display the celebration of the day depending on the machine's time or selected time -->


        <form method="GET" class="text-center">

            <label for="Calendar" style="font-weight: bold;">Select a Date:</label>
            <input type="date" id="Calendar" name="selected_date" value="<?php echo $today; ?>">
            <button type="submit" class="btn btn-primary">View</button>

        </form>

        <div class="row justify-content-center">

            <?php
                //$date = new DateTime(); Previous Code!
                //$today = $date->format('Y-m-d'); Previous Code!

                if (isset($_GET['selected_date']) && !empty($_GET['selected_date'])) {
                    $today = $_GET['selected_date'];
                } else {
                    $today = (new DateTime())->format('Y-m-d');
                }

                $hasTodayCelebration = false;

if ($result->num_rows > 0) {
    // Loop through once for today's celebrations
    foreach ($result as $row) {
        $rowDate = date('Y-m-d', strtotime($row['celebration_date']));

        if ($rowDate === $today) {
            $hasTodayCelebration = true;

            $imagePath = "images/celebrations/" . ($row['image_name'] ?? 'celebrations_default.png');
            $title = htmlspecialchars($row['title']);
            $description = htmlspecialchars($row['description']);
            $id = $row['id'];

            echo <<<HTML
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card h-100 shadow">
                    <img src="$imagePath" class="card-img-top img-fluid" alt="$title">
                    <div class="card-body">
                        <h5 class="card-title">$title</h5>
                        <p class="card-text">$description</p>
                        <a href="display_celebration.php?id=$id" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            HTML;
        }
    }

    if (!$hasTodayCelebration) {
        echo "<p id='todayFont'>No celebrations for today ($today).</p>";
    }

    // Resetting the result pointer so we can loop for all celebrations
    $result->data_seek(0);
}
            ?>
        </div>

    <h2 id="title">Celebrations</h2><br>

    <div class="row justify-content-center">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                /* pulls image name from DB
                    make sure to have correct directory structure!
                    'celebrations_default.png' is whatever the default image you want to use
                */
                $imagePath = "images/celebrations/" . ($row['image_name'] ?? 'celebrations_default.png'); // in DB, if 'image_name' is NULL, then will use 'celebrations_default.png' as default image
                $title = htmlspecialchars($row['title']);
                $description = htmlspecialchars($row['description']);
                $id = $row['id'];
                echo <<<HTML
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100 shadow">
                        <img src="$imagePath" class="card-img-top img-fluid" alt="$title">
                        <div class="card-body">
                            <h5 class="card-title">$title</h5>
                            <p class="card-text">$description</p>
                            <a href="display_celebration.php?id=$id" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
                HTML;
            }
        } else {
            echo "<p>No celebrations found.</p>";
        }
        ?>
    </div>
</div>
<footer class="page-footer text-center">
    <br>
    <p>© Summer 2025 Team DOLPHIN 🐬</p>
</footer>