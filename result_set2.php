<?php
// This file is a test file to illustrate the concept of "Result Set"
// and it can be mapped to PHP data and then to HTML data.
//  MySQL --> PHP --> HTML

$status = session_status();
if($status == PHP_SESSION_NONE){
    session_start();
}
require 'bin/functions.php';
require 'db_configuration.php';
$page_title = ' Project ABCD > Summary';
include('header.php');

// ==================== Fetching the data from mysqli_result object =============
// please see result_set1.php to explore different return types (result_object, TRUE, or FALSE)
// This file assumes the SQL query is correct; and a proper mysqli_result object is returned
// We will focus on how to bind that data to PHP variables and collections
 //====================================================================================
// In all the 10 SELECT we identified, $mysqli_result will be on object
// We can find out the number of rows returned 


// Test Case ID.Rows. Columns
// SELECT statement


// 1.ONE.ONE
$sql_query = "SELECT `name` FROM `dresses` WHERE `id`=100;";
$mysqli_result = mysqli_query($db, $sql_query);

if ($mysqli_result) {
  $num_rows = mysqli_num_rows($mysqli_result);
  $num_cols = mysqli_field_count($db);
  echo "<br> 1. Number of rows --> $num_rows";
  echo "<br> 1. Number of cols --> $num_cols<br>";
}
else {
   echo '<br> $mysqli_result is FALSE. SELECT failed';
}

// 2.ONE.ALL
$sql_query = "SELECT * FROM `dresses` WHERE `id`=100"; 
$mysqli_result = mysqli_query($db, $sql_query);

if ($mysqli_result) {
    $num_rows = mysqli_num_rows($mysqli_result);
    $num_cols = mysqli_field_count($db);
    echo "<br> 2. Number of rows --> $num_rows";
    echo "<br> 2. Number of cols --> $num_cols<br>";
  }
  else {
     echo '<br> $mysqli_result is FALSE. SELECT failed';
  }

// 3.ONE.SOME
$sql_query = "SELECT `id`,  `name`, `description` FROM `dresses` WHERE `id`=100";
$mysqli_result = mysqli_query($db, $sql_query);

if ($mysqli_result) {
  $num_rows = mysqli_num_rows($mysqli_result);
  $num_cols = mysqli_field_count($db);
  echo "<br> 3. Number of rows --> $num_rows";
  echo "<br> 3. Number of cols --> $num_cols<br>";
}
else {
   echo '<br> $mysqli_result is FALSE. SELECT failed';
}



// 4.ALL.ONE
$sql_query = "SELECT `name` FROM `dresses`";
$mysqli_result = mysqli_query($db, $sql_query);

if ($mysqli_result) {
    $num_rows = mysqli_num_rows($mysqli_result);
    $num_cols = mysqli_field_count($db);
    echo "<br> 4. Number of rows --> $num_rows";
    echo "<br> 4. Number of cols --> $num_cols<br>";
  }
  else {
     echo '<br> $mysqli_result is FALSE. SELECT failed';
  }

// 5.SOME.ONE
$sql_query = "SELECT `name` FROM `dresses` WHERE `id` BETWEEN 51 AND 100";
$mysqli_result = mysqli_query($db, $sql_query);

if ($mysqli_result) {
  $num_rows = mysqli_num_rows($mysqli_result);
  $num_cols = mysqli_field_count($db);
  echo "<br> 5. Number of rows --> $num_rows";
  echo "<br> 5. Number of cols --> $num_cols<br>";
}
else {
   echo '<br> $mysqli_result is FALSE. SELECT failed';
}

// 6.SOME.ALL
$sql_query = "SELECT * FROM `dresses` WHERE `id`=100 OR `id`=200 OR `id`>220";
$mysqli_result = mysqli_query($db, $sql_query);

if ($mysqli_result) {
    $num_rows = mysqli_num_rows($mysqli_result);
    $num_cols = mysqli_field_count($db);
    echo "<br> 6. Number of rows --> $num_rows";
    echo "<br> 6. Number of cols --> $num_cols<br>";
  }
  else {
     echo '<br> $mysqli_result is FALSE. SELECT failed';
  }

// 7.SOME.SOME
$sql_query = "SELECT  `id`,  `name`  FROM `dresses` WHERE `name` LIKE '%Saree%'";
$mysqli_result = mysqli_query($db, $sql_query);

if ($mysqli_result) {
    $num_rows = mysqli_num_rows($mysqli_result);
    $num_cols = mysqli_field_count($db);
    echo "<br> 7. Number of rows --> $num_rows";
    echo "<br> 7. Number of cols --> $num_cols<br>";
  }
  else {
     echo '<br> $mysqli_result is FALSE. SELECT failed';
  }

// 8.ALL.SOME
$sql_query = "SELECT `id`,  `name`, `description` FROM `dresses`"; 
$mysqli_result = mysqli_query($db, $sql_query);

if ($mysqli_result) {
    $num_rows = mysqli_num_rows($mysqli_result);
    $num_cols = mysqli_field_count($db);
    echo "<br> 8. Number of rows --> $num_rows";
    echo "<br> 8. Number of cols --> $num_cols<br>";
  }
  else {
     echo '<br> $mysqli_result is FALSE. SELECT failed';
  }

// 9.SOME.SOME
$sql_query = "SELECT `id`,  `name`, `type` FROM `dresses` WHERE `type`LIKE '%women%'";
$mysqli_result = mysqli_query($db, $sql_query);

if ($mysqli_result) {
    $num_rows = mysqli_num_rows($mysqli_result);
    $num_cols = mysqli_field_count($db);
    echo "<br> 9. Number of rows --> $num_rows";
    echo "<br> 9. Number of cols --> $num_cols<br>";
  }
  else {
     echo '<br> $mysqli_result is FALSE. SELECT failed';
  }

// 10.ALL.ALL
$sql_query = "SELECT * FROM `dresses`";
$mysqli_result = mysqli_query($db, $sql_query);

if ($mysqli_result) {
  $num_rows = mysqli_num_rows($mysqli_result);
  $num_cols = mysqli_field_count($db);
  echo "<br> 10. Number of rows --> $num_rows";
  echo "<br> 10. Number of cols --> $num_cols<br>";
}
else {
   echo '<br> $mysqli_result is FALSE. SELECT failed';
}

?>
