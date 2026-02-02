<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}

require 'bin/functions.php';
require 'db_configuration.php';
include('header.php');

$page_title = 'Nomination > Create A Nomination';
$page = "nomination.php";
//Check if user is login
verifyLogin($page);
?>

<!-- css styling link -->
<link href="css/nominationForm.css" rel="stylesheet">

<div class="container" id="nomination-form-container">
    
    <form action="create_nomination.php" method="POST" enctype="multipart/form-data">
        <br>

        <h2 id="title">Create Your Nomination!</h2> 
        <h5 id="subtitle">Please submit this form if you would like to make a nomination.</h5>
        <br>

        <label style="font-weight: bold;">Please select the nomination type:</label>

        <div class="form-group">
            <div class="form-check form-check-inline">
                <div class="form-check-input">
                    <input type="radio" id="hero" name="category" value="Hero" required>
                    <label class="form-check-label" for="hero">Hero</label>
                </div>
            </div>
            <div class="form-check form-check-inline">
                <div class="form-check-input">
                    <input type="radio" id="shero" name="category" value="Shero" required>
                    <label class="form-check-label" for="shero">Shero</label>
                </div>
            </div>
            <div class="form-check form-check-inline">
                <div class="form-check-input">
                    <input type="radio" id="other" name="category" value="Other" required>
                    <label class="form-check-label" for="other">Other</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="name" style="font-weight: bold;">Name</label> <br>
            <input class="form-control" name="name" placeholder="Please enter a Name." required></input>
        </div>
        <div class="form-group">
            <label style="font-weight: bold;">Description</label> <br>
            <textarea class="form-control" name="description" cols="55" rows="5" placeholder="Please enter a Description." required></textarea>
        </div>

        <div class="form-group">
            <!-- automatically include user's email in the nominator field (read only) -->
            <label style="font-weight: bold;">Email</label> <br>
            <input id="email" name ="nominator" value= <?php echo $_SESSION['email'] ?> readonly> 
        </div>

        <div class="form-group text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md">Submit Nomination</button>
        </div>

    </form>
</div>

</body>
</html>