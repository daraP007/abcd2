<!-- 
    ICS 325 (summer 2025)
    Final Project
    Team DOLPHIN  🐬
-->

<?php
$page_title = 'Project ABCD > Tag Report';
include('header.php');
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

// Load allowed tags list
$allowed_tags_file = __DIR__ . '/reports/abcd_tags.txt';
$allowed_tags = [];

if (file_exists($allowed_tags_file)) {
    $allowed_tags = array_map('trim', file($allowed_tags_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
}

$allowed_tags = array_map('strtolower', $allowed_tags); // convert to lowercase
$allowed_tags[] = 'custom'; // add 'Custom' tag

// initialize tag counts
$tag_counts = array_fill_keys($allowed_tags, 0);

// query dresses table
$sql = "SELECT key_words FROM dresses";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $keywords = explode(',', strtolower($row['key_words']));
        foreach ($keywords as $word) {
            $word = trim($word);
            if ($word === '') continue;
            if (in_array($word, $allowed_tags)) {
                $tag_counts[$word]++;
            } else {
                $tag_counts['custom']++;
            }
        }
    }
} else {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Failed to query database: " . mysqli_error($conn) . "</div></div>";
    include('footer.php');
    exit();
}

// write to CSV
$csv_path = __DIR__ . '/reports/tag_report.csv';
$csv_file = fopen($csv_path, 'w');
fputcsv($csv_file, ['Tag', 'Count']);

foreach ($tag_counts as $tag => $count) {
    fputcsv($csv_file, [$tag, $count]);
}
fclose($csv_file);
?>

<head>
    <link rel="stylesheet" href="css/tags.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f40040d297.js" crossorigin="anonymous"></script>
</head>

<div class="container mt-5">
    <br><br>
    <h2 id="title">Tag Usage Report</h2>
    <table class="table table-striped table-bordered mt-4">
        <thead>
            <tr><th>Tag</th><th>Count</th></tr>
        </thead>
        <tbody>
            <?php foreach ($tag_counts as $tag => $count): ?>
                <tr>
                    <td><?php echo htmlspecialchars($tag); ?></td>
                    <td><?php echo $count; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="manage_tags.php" class="btn btn-secondary">← Back to Manage Tags</a>
        <a href="reports/tag_report.csv" class="btn btn-primary" download>Download CSV Report</a>
    </div>
</div>

<footer class="page-footer text-center">
    <br>
    <p>© Summer 2025 Team DOLPHIN 🐬</p>
</footer>
