<?php

use PhpOffice\PhpPresentation\Shape\Chart\Type\Bar;

ob_start();
session_start();

if ($_SESSION['role'] != 'admin'){
    header('Location: index.php');
    exit;
}

// import the required files
require 'bin/functions.php';
require 'db_configuration.php';
require 'api/objects/dress.php';
include('header.php');

ob_end_flush();

$query = "SELECT key_words FROM dresses";
$result = mysqli_query($db, $query);
$all_keywords = $result->fetch_all(MYSQLI_ASSOC);

$query = "SELECT category FROM dresses";
$result = mysqli_query($db, $query);
$all_categories = $result->fetch_all(MYSQLI_ASSOC);


$keywords = [];
foreach ($all_keywords as $row) {
    $keywords = array_merge($keywords, explode(',', $row['key_words']));
}

$categories = [];
foreach ($all_categories as $row) {
    $categories = array_merge($categories, explode(',', $row['category']));
}

$keywords = array_unique($keywords);
$categories = array_unique($categories);

$result = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = (isset($_POST['category'])) ? implode(',', $_POST['category']) : "";
    $type = (isset($_POST['type'])) ? $_POST['type'] : "";
    $keywords = (isset($_POST['key_words'])) ? implode(',', $_POST['key_words']) : "";

    $params = [
        'category' => $category,
        'type' => $type,
        'key_words' => $keywords,

    ];

    
    
    $result = Dress::getByParams($params);
}
?>

<html>
<head>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f40040d297.js" crossorigin="anonymous"></script>
    <style>
        #resbox {
            resize: both;
            overflow: auto;
        }
    </style>
</head>
<body>
    <div style="padding: 50px;">
    <form method="POST" action="admin_query.php">
        <label for="category">Category:</label>
        <select multiple name="category[]">
            <?php foreach($categories as $category): ?>
            <option value="<?= htmlspecialchars($category) ?>"><?= htmlspecialchars($category) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="type">Type:</label>
        <select name="type">
            <option value="boy">boy</option>
            <option value="girl">girl</option>
            <option value="other">other</option>
        </select>

        <label for="key_words">Keywords:</label>
        <select multiple name="key_words[]">
            <?php foreach($keywords as $keyword): ?>
            <option value="<?= htmlspecialchars($keyword) ?>"><?= htmlspecialchars($keyword) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Search</button>
    </form>
    </div>

    <div style="padding: 50px;">
        <textarea readonly id="resbox">
            <?php 
                if (!empty($result)) { 
                    echo implode(", ", $result);
                } 
            ?>

        </textarea>
    </div>
</body>
</html>
