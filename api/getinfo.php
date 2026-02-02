<?php
require 'objects/dress.php';
require 'api_tools.php';

// initialize
$id = intval($_GET['id']);
$dress = Dress::getById($id);

// prepare results
if(!is_null($dress)) {
    response(200, "Dress found", $dress);
}
else {
    invalidResponse("No dress found for id " . $id);
}
?>