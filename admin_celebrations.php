<!-- 
    ICS 325 (summer 2025)
    Final Project
    Team DOLPHIN  🐬
-->

<?php

if(!isset($_SESSION)) {
    session_start();
}

require 'db_configuration.php';
$page_title = 'Project ABCD > Admin-Celebrations';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$query = "SELECT * FROM celebrations_tbl";
$GLOBALS['data'] = mysqli_query($db, $query);

$query = "SELECT id, title, description, resource_type, celebration_type, celebration_date, tags, image_name, resource_url FROM celebrations_tbl";

$GLOBALS['data'] = mysqli_query($db, $query);
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
    <h2 id="title">Today's Celebrations</h2><br>

    <div id="buttonContainer" style="margin-bottom: 20px;">
        <button><a class="btn btn-sm" href="create_celebration.php">Add a Celebration</a></button>
    </div>
    
    <div id="customerTableView">
        <table class="display" id="celebrationsTable" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Display</th>
                    <th>Image</th>
                    <th>Resource Type</th>
                    <th>Celebration Type</th>
                    <th>Tags</th>
                    <th>Resource Link</th>
                    <th>Modify</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($GLOBALS['data'])) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['celebration_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <!-- FIX THIS 'display_celebration.php' does not exist yet. -->
                        <td>
                            <a class="btn btn-success btn-sm" href="display_celebration.php?id=<?php echo $row['id']; ?>">Display</a>
                        </td>
                        <td><img src="images/celebrations/<?php echo htmlspecialchars($row['image_name'] ?: 'celebrations_default.png'); ?>" width="60px"></td>
                        <td><?php echo htmlspecialchars($row['resource_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['celebration_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['tags']); ?></td>
                        <td>
                            <?php if (!empty($row['resource_url'])): ?>
                                <a href="<?php echo htmlspecialchars($row['resource_url']); ?>" target="_blank">View</a>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><a class='btn btn-warning btn-sm' href='modify_celebration.php?id=<?php echo $row["id"]; ?>'>Modify</a></td>
                        <td><a class='btn btn-danger btn-sm' href='delete_celebration.php?id=<?php echo $row["id"]; ?>' onclick="return confirm('Are you sure you want to delete this celebration?');">Delete</a></td>
                </tr>
                <?php 
            } ?>
            </tbody>
            <!-- toggle buttons -->
            <div class="toggles">
                <strong> Toggle column: </strong>
                <a id="toggle" class="toggle-vis" data-column="0"></a>
                <a id="toggle" class="toggle-vis" data-column="1">Title</a> - 
                <a id="toggle" class="toggle-vis" data-column="2">Description</a> - 
                <a id="toggle" class="toggle-vis" data-column="3">Resource Type</a> - 
                <a id="toggle" class="toggle-vis" data-column="4">Celebration Type</a> - 
                <a id="toggle" class="toggle-vis" data-column="5">Date</a> - 
                <a id="toggle" class="toggle-vis" data-column="6">Tags</a> - 
                <a id="toggle" class="toggle-vis" data-column="7">Image</a> - 
                <a id="toggle" class="toggle-vis" data-column="8">Resource URL</a> - 
                <a id="toggle" class="toggle-vis" data-column="9">Display</a>
            </div>
        </table>
    </div>
</div>

<!-- DataTables and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#celebrationsTable').DataTable();
    });
</script>
<!-- script for toggles to function -->
<script>
$(document).ready(function () {
  var table = $('#celebrationsTable').DataTable();

  $('a.toggle-vis').on('click', function (e) {
    e.preventDefault();

    var column = table.column($(this).attr('data-column'));
    column.visible(!column.visible());
  });
});
</script>

