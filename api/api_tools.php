<?php
function invalidResponse($message) {
    response(400, $message, NULL);
}

function response($responseCode, $message, $data) {
    // Locally cache results for two hours
    header('Cache-Control: max-age=7200');

    // JSON Header which we will be sending with every request
    header('Content-type:application/json;charset=utf-8');

    http_response_code($responseCode);
    $response = array("response_code" => $responseCode, "message" => $message, "data" => $data);
    $json = json_encode($response);
    echo $json;
}
?>
