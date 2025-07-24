<!-- <?php
    if(!isset($_SESSION)) 
    { 
        session_start();
    } 
?> -->

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f40040d297.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/chatbot.css">
</head>

<body>


<script src ="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Function to open the chat form
    function openForm() {
        $("#myForm").show();
    }

    // Function to close the chat form
    function closeForm() {
        $("#myForm").hide();
    }

    // Event listener for the "Chat" button
    $(".open-button").click(openForm);

    // Event listener for the "Close" button
    $(".cancel").click(closeForm);

    // Event listener for form submission
    $('#chat-form').submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        var message = $('textarea[name="input"]').val(); // Get the message from the textarea
        if (message.trim() !== '') { // Check if the message is not empty
            appendUserMessage(message); // Append the user's message to the chat box with label
            sendMessageToChatbot(message); // Send the user's message to the chatbot
        }
        // Clear the textarea after submission
        $('textarea[name="input"]').val('');
    });

    function appendUserMessage(message) {
        $('#chat-messages').append('<div class="message-label">You:</div>'); // add user label
        $('#chat-messages').append('<div class="user-message">' + message + '</div>');
        $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
    }

    function sendMessageToChatbot(message) {
        // Disable form submission while the AJAX request is in progress
        $('#chat-submit').prop('disabled', true);

        $.ajax({
            type: 'POST',
            url: '',
            data: { input: JSON.stringify(message) }, // stringify to sanitize newline characters for json
            success: function (response) {
                $('#chat-messages').append('<div class="message-label">Chatbot:</div>'); // add chatbot label
                $('#chat-messages').append('<div class="message">' + response + '</div>');
                $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#chat-messages').append('<div class="error-message">Error: ' + errorThrown + '</div>');
                $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
            },
            complete: function() {
                // Re-enable form submission after the request is completed
                $('#chat-submit').prop('disabled', false);
            }
        });
    }
});
</script>


<?php 
/*********************************************************************************/
//Code for getting info from OpenAI API
$message = null;
$result = null;
$_SESSION['chat_history'] = null; // resetting history for now. third message in chat breaks the json messaging format for some reason.

if (isset($_POST['input'])) {
    // Interaction with the OpenAI API
    $message = '{"role": "user", "content": "' . addslashes($_POST['input']) . '"}'; // escape newline characters to prevent json error

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer APIKEYHERE'
    ];
    
    $ch = curl_init('https://api.openai.com/v1/chat/completions');
    $json_data = '{"model":"gpt-3.5-turbo",
        "messages": [{"role": "system", "content": "You are a chatbot for assisting users on an educational website about Indian heroes and sheroes. The content includes history about traditional dresses and outfits worn by historical figures. Please assist them with questions related to this context."}, 
        ' . $message . ']}';

    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => 2,
        CURLOPT_POSTFIELDS => $json_data
    ]);
    
    $response = curl_exec($ch);
    if ($response === false) {
        echo "Request error: " . curl_error($ch);
    } else {
        $decoded_response = json_decode($response, true);
        if (isset($decoded_response['error'])) {
            // If an error occurred, echo the error message
            echo $decoded_response['error']['message'];
        } else {
            // Echo only the response message
            echo $decoded_response['choices'][0]['message']['content'];
        }
    }
    curl_close($ch);
    exit(); // Stop further execution after sending the response
}
?>

 <!-- DEBUG OUTPUTS -->
<!-- <?php 
    // echo $result;
    // echo $_SESSION['chat_history'];
    // echo $json_data;
    // echo $response;
?> -->


<!-- CHAT BOX -->

<div class="chat-box-container">

<button class="open-button">Chat  <i class="fa-regular fa-comment"></i></button>
    <div class="chat-popup" id="myForm">
    <form id="chat-form" class="form-container">
        <div class="d-flex justify-content-between">
            <h2>Chat</h2>
            <h2><i class="fa-regular fa-comments"></i></h2>
        </div>

        <div class="chat-messages" id="chat-messages"></div>
        
        <label id="message-input" for="msg"><b>Message</b></label>
        <textarea placeholder="Type your message..." name="input" class="chatbox-text-area" required></textarea>

        <button id="chat-submit" type="submit" class="btn">Send <i class="fa-regular fa-paper-plane"></i></button>
        <button type="button" class="btn cancel">Close <i class="fa-regular fa-rectangle-xmark"></i></button>
    </form>
    </div> 
</div>



</body>
</html>
