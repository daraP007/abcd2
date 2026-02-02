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

// ==================== Testing the mysqli_result return types =======================
//====================================================================================

// mysqli_query API runs the query on the database
// For successful SELECT, SHOW, DESCRIBE, or EXPLAIN queries it will return a mysqli_result object. 
// For other successful queries it will return TRUE. 
// And if the query fails for any reason, it returns FALSE
// So return type can be 1. mysqli_result object or 2. TRUE or 3. FALSE
// Please see https://www.php.net/manual/en/class.mysqli-result.php
// Please see https://www.w3schools.com/php/func_mysqli_query.asp

// Test Case 1:  SQL Query is WRONG; So $mysqli_result is FALSE
//               We can not call mysqli_num_rows on FALSE
//$mysqli_result = mysqli_query($db, "SELECT ajsdfljalsf FROM `dresses` WHERE status='proposed'");
//$num_rows = mysqli_num_rows($mysqli_result);
//echo $num_rows;
// The above code snippet gives the following warning
//Warning: mysqli_num_rows() expects parameter 1 to be mysqli_result, bool given in C:\xampp7371\htdocs\abcd\result_set.php on line 27

// Test Case 2: SQL Query is worng; So $mysqli_result is FALSE. 
//              We check its status first before calling mysql_num_rows
$sql_query = "SELECT ajsdfljalsf FROM `dresses` WHERE status='proposed'";
$mysqli_result = mysqli_query($db, $sql_query);
if ($mysqli_result != FALSE) {
  $num_rows = mysqli_num_rows($mysqli_result);
  echo $num_rows;
}
else {
   echo '$mysqli_result is false. Please check your query';
}


// Test Case 3: UPDATE, DELETE etc. methods, if successful, return TRUE
//              We will try UPDATE
$sql_query = "UPDATE `dresses` SET `name`='Saree2' WHERE `id`=1";
$mysqli_result = mysqli_query($db, $sql_query);
if ($mysqli_result == TRUE) {
  echo '<br> $mysql_result is TRUE; UPDATE is successful';
}
else {
   echo '<br> $mysqli_result is FALSE. UPDATE failed';
}


// Test Case 4: SELECT returns an object
$sql_query = "SELECT * FROM `dresses`";
$mysqli_result = mysqli_query($db, $sql_query);
if ($mysqli_result == TRUE) {
  echo '<br> $mysql_result is TRUE; SELECT is successful';
}
else {
   echo '<br> $mysqli_result is FALSE. SELECT failed';
}

// Test Case 5: Count the number of rows returned by the mysqli_query
// We can write   ($mysqli_result == TRUE) as ($mysqli_result)
$sql_query = "SELECT * FROM `dresses`";
$mysqli_result = mysqli_query($db, $sql_query);
if ($mysqli_result) {
  $num_rows = mysqli_num_rows($mysqli_result);
  echo "<br> Number of rows --> $num_rows";
}
else {
   echo '<br> $mysqli_result is FALSE. SELECT failed';
}
?>
