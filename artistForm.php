<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}

require 'bin/functions.php';
require 'db_configuration.php';
include('header.php');

$page_title = 'Artist Showcase > Artist Form';
$page = "artistForm.php";
verifyLogin($page);

?>

<?php
// here is the information to connect to the database
//$mysqli = new MySQLi('localhost', 'root', '', 'abcd_db');
$mysqli = new MySQLi('localhost', 'root', '', 'abcd_db');
//$resultset = $mysqli->query("SELECT DISTINCT topic FROM topics ORDER BY topic ASC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register/Login Form</title>
  <link href="css/artistForm.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
</head>
<body>
  <div class="form">

      <ul class="tab-group">
        <li class= "tab active align = right"><a href="#registerArtist">New Artist</a></li>
        
      </ul>

      <div class="tab-content">

        <div class="registerArtistContainer">
          <div class="registerText">
          <h1 id="artistHead">Register as an artist affiliate</h1>
          <h2 id="artistDescription">Please submit this form if you would like to be able to use the images on this website to create products to sell! We will create an artist profile on the site and link to your pages for people to view.</h2>
          </div>
<br>
          <div class="artistBoxes">
          <form action="createArtist.php" method="POST" autocomplete="off" enctype="multipart/form-data">

          <div class="field-wrap">
              <label>
                Profile Picture: <span class="req">*</span>
              </label>
              <input style=width:400px type="file" onchange="loadFile(event)" name="fileToUpload" id="fileToUpload" accept="image/jpg, image/jpeg, image/png" required title="Please enter an image file"></input><br>
              <img id="output" width="200" />
            </div>

            <div class="field-wrap">
              <label>
                Artist Description: <span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='description' />
            </div>
          

          <div class="field-wrap">
            <label>
              Country: <span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name='country' />
          </div>
          
          <div class="field-wrap">
            <label>
              Facebook:
            </label>
            <input type="text" autocomplete="off" name='facebook'/>
          </div>
          
          <div class="field-wrap">
            <label>
              Instagram:
            </label>
            <input type="text" autocomplete="off" name='instagram'/>
          </div>
          
          <div class="field-wrap">
            <label>
              Twitter:
            </label>
            <input type="text" autocomplete="off" name='twitter'/>
          </div>
          
          <div class="field-wrap">
            <label>
              WhatsApp:
            </label>
            <input type="text" autocomplete="off" name='whatsapp'/>
          </div>
          
          <div class="field-wrap">
            <label>
              Art Site:
            </label>
            <input type="text" autocomplete="off" name='art_site'/>
          </div>
          
          <div class="field-wrap">
            <label>
              Other:
            </label>
            <input type="text" autocomplete="off" name='other'/>
          </div>
        
          
</div>
          <div class="submitContainer">
                    <input type="submit" name="submit" value="Submit" id="submitBtn"> 
          </div>

          
          </form>

        </div>

      </div><!-- tab-content -->

</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/loginForm.js"></script>
  <script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
</body>
</html>
