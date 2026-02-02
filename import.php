<?php 
session_start();
require 'bin/functions.php';
require 'db_configuration.php';
include('header.php');
?>

<?php
$conn = mysqli_connect("localhost", "root", "", "abcd_db");

if(isset($_POST["upload"])){
    $fileName = $_FILES["file"]["tmp_name"];
    $deleterecords = "TRUNCATE TABLE dresses";
    mysqli_query($conn, $deleterecords);
    $count = 0;
    if($_FILES["file"]["size"] > 0){
        $file = fopen($fileName, "r");
        $field_csv = array();
        
        
        while(($column = fgetcsv($file, 0, ",")) !== FALSE){
            if($count >= 1) {
                $field_csv['id'] = mysqli_real_escape_string($conn,$column[0]);
                $field_csv['name'] = mysqli_real_escape_string($conn,$column[1]);
                $field_csv['description'] = mysqli_real_escape_string($conn,$column[2]);
                $field_csv['did_you_know'] = mysqli_real_escape_string($conn,$column[3]);
                $field_csv['category'] = mysqli_real_escape_string($conn,$column[4]);
                $field_csv['type'] = mysqli_real_escape_string($conn,$column[5]);
                $field_csv['state_name'] = mysqli_real_escape_string($conn,$column[6]);
                $field_csv['key_words'] = mysqli_real_escape_string($conn,$column[7]);
                $field_csv['image_url'] = mysqli_real_escape_string($conn,$column[8]);
                $field_csv['status'] = mysqli_real_escape_string($conn,$column[9]);
                $field_csv['notes'] = mysqli_real_escape_string($conn,$column[10]);
                
                try {
                    $query = "INSERT INTO dresses 
                    (id, name, description, did_you_know, category, type, 
                    state_name, key_words, image_url, status, notes) 
                    VALUES ('" . $field_csv['id'] . "', '" . $field_csv['name'] . "', '" . $field_csv['description'] . "', '" . $field_csv['did_you_know']. "', '" . $field_csv['category']. "', '" . $field_csv['type'] . "', '" . $field_csv['state_name'] . "', '" . $field_csv['key_words'] . "', '" . $field_csv['image_url']. "', '" . $field_csv['status'] . "', '" . $field_csv['notes'] . "')";
                    $result = mysqli_query($conn, $query);
                } catch (mysqli_sql_exception $e) {
                    var_dump($e);
                    exit;
                }
                if(!empty($result)){
                    continue;
                }else{
                    echo "Error occured while importing csv";
                }
            }
            $count = $count + 1;
        }
        fclose($file);
    }
}

?>
<html>
    <head>
    <link rel="stylesheet" href="css/import.css">
    </head>
<body>
<div class="inputContainer">
    <div class="inputBox">
<form class="form-horizontal" action="" method="post" name="uploadCSV" enctype="multipart/form-data">

<label> Import CSV File </label>
<input type="file" name="file" accept=".csv">
<button type="submit" name="upload">Upload</button>


</form>
</div>
</div>
</html>
