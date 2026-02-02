<?php
require 'db_configuration.php';

// $mysqli = mysqli_connect('localhost', 'root', '', 'abcd_db');
$TableName = "dresses";
$strSQL = "SELECT * FROM $TableName";
$sql = mysqli_query($db, $strSQL);

if (mysqli_error($db)) {
    echo mysqli_error($db);
} else {
    if($sql->num_rows > 0) {
        $delimiter = ",";
        $filename = "dress-data_" . date('Y-m-d') . ".csv";
        
        $f = fopen('php://memory', 'w');
        $fields = array('id', 'name', 'description', 'did_you_know', 'category', 'type', 'state_name', 'key_words', 'image_url', 'status', 'notes');
        fputcsv($f, $fields, $delimiter);
        
        while($row = $sql->fetch_assoc()) {
            $lineData = array($row['id'],$row['name'],$row['description'],$row['did_you_know'],$row['category'],$row['type'],$row['state_name'],$row['key_words'],$row['image_url'],$row['status'],$row['notes']);
            fputcsv($f,$lineData,$delimiter);
        }
        fseek($f, 0);
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        
        fpassthru($f);
    }
}
exit;
?>