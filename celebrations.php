<?php
// require_once 'bin/debug_config.php'; //uncomment if debugging is needed

session_start(); // unnecessary in this context, but included for consistency

require 'bin/functions.php';
require_once 'db_configuration.php';

// Database connection info
$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

// set page title before including header
$page_title = 'Project ABCD > Today\'s Celebrations';
include('header.php');

// Check connection
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

/*  SELECTED DATE LOGIC */
if (isset($_GET['selected_date']) && !empty($_GET['selected_date'])) {
    $today = $_GET['selected_date'];
} else {
    $today = (new DateTime())->format('Y-m-d');
}

$sqlToday = "SELECT * FROM celebrations_tbl WHERE celebration_date = '$today'";
$resultToday = $conn->query($sqlToday);
$celebration_count = $resultToday->num_rows;

/*  MONTHLY CALENDAR LOGIC */
$month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
$year  = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

$sqlCounts = "
    SELECT celebration_date, COUNT(*) AS total 
    FROM celebrations_tbl 
    WHERE MONTH(celebration_date) = $month AND YEAR(celebration_date) = $year
    GROUP BY celebration_date
";
$resultCounts = $conn->query($sqlCounts);

$celebrationsByDate = [];
while ($row = $resultCounts->fetch_assoc()) {
    $celebrationsByDate[$row['celebration_date']] = $row['total'];
}

$prevMonth = $month - 1; $prevYear = $year;
if ($prevMonth < 1) { $prevMonth = 12; $prevYear--; }
$nextMonth = $month + 1; $nextYear = $year;
if ($nextMonth > 12) { $nextMonth = 1; $nextYear++; }

/* ALL CELEBRATIONS */
$sql = "SELECT * FROM celebrations_tbl ORDER BY celebration_date";
$result = $conn->query($sql);
?>

<head>
    <title>Project ABCD > Today's Celebrations</title>
    <link rel="stylesheet" type="text/css" href="css/list_celebrations.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/responsive_style.css">
    <style>
        table.calendar { border-collapse: collapse; margin: 0 auto 20px auto; }
        table.calendar th, table.calendar td { border: 1px solid #ccc; width: 100px; height: 80px; text-align: center; vertical-align: top; }
        table.calendar th { background-color: #f0f0f0; }
        table.calendar td a { display: block; text-decoration: none; color: black; }
    </style>
</head>

<br><br>
<div class="container-fluid">
    <br>
    <h2 id="title">TODAY'S CELEBRATIONS</h2><br>

    <h1 id ="section-heading">Celebrations for <?= date('F j, Y', strtotime($today)) ?> (🎉 <?= $celebration_count ?>)</h1>

    <div class="row justify-content-center">
        <?php
        if ($celebration_count > 0) {
            while ($row = $resultToday->fetch_assoc()) {
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
        } else {
            echo "<p style='text-align:center; font-weight:bold;'>No celebrations for this date.</p>";
        }
        ?>
    </div>

    <!--  Month Navigation -->
    <div style="text-align:center; margin-bottom:10px; margin-top:40px;">
        <a href="?month=<?=$prevMonth?>&year=<?=$prevYear?>">⬅ Prev</a>
        <strong><?=date('F Y', strtotime("$year-$month-01"))?></strong>
        <a href="?month=<?=$nextMonth?>&year=<?=$nextYear?>">Next ➡</a>
    </div>

    <!--  Calendar Grid -->
    <table class="calendar">
        <tr>
            <th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th>
            <th>Thu</th><th>Fri</th><th>Sat</th>
        </tr>
        <tr>
        <?php
        $firstDay = strtotime("$year-$month-01");
        $daysInMonth = date('t', $firstDay);
        $startDay = date('w', $firstDay);

        for ($i = 0; $i < $startDay; $i++) echo "<td></td>";

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = date('Y-m-d', strtotime("$year-$month-$day"));
            $count = isset($celebrationsByDate[$date]) ? "🎉 x".$celebrationsByDate[$date] : "";

            echo "<td><a href='?month=$month&year=$year&selected_date=$date'>$day<br>$count</a></td>";

            if ((($day + $startDay) % 7) == 0) echo "</tr><tr>";
        }

        $endCells = (7 - (($daysInMonth + $startDay) % 7)) % 7;
        for ($i = 0; $i < $endCells; $i++) echo "<td></td>";
        ?>
        </tr>
    </table>

    <div class="row justify-content-center">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
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
