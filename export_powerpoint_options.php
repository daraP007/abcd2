<?php
session_start();
include('header.php'); 
?>
<html>
  <head>
    <title>PowerPoint Options</title>
    <link href="css/export_powerpoint_options.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="testbox">
    <form class="form form2" method="POST" action="export_powerpoint.php">  
        <div class="banner">
          <h1 id="pptTitle">PowerPoint Options</h1>
        </div>
        <div class = "dialog"><b id="queryTitle">Query Dialog: </b></div>
        <div class="quantity">
          <label>Number of Pages to Export (1 - 100)</label>
          <div class="numPages">
            <div>
            <input type="number" id="quantity" name="quantity" value="1" min="1" max="100">
            </div>
          </div>
        </div>

        <div class = "dialog"><b id="displayTitle">Display Options: </b></div>

        <div class="question">
          <label id="labelText"><b id="formatTitle">Page Format Option</b></label>
          <div class="question-answer">
            <div>
              <input type="radio" value="1" id="radio_1" name="option2"/ checked>
              <label for="radio_1" class="radio"><span>Images on odd pages, Text on even pages</span></label>
            </div>
            <div>
              <input type="radio" value="2" id="radio_2" name="option2"/>
              <label for="radio_2" class="radio"><span>Images on even pages, Text on odd pages</span></label>
            </div>
            <br>
            <div>
              <input type="checkbox" value="sort" id="check1" name="sort"/>
              <label for="sort" class="check"><span>Sort by Dress Name</span></label>
            </div>
            <br>
            <div>
              <input type="radio" value="state_name" id="radio_3" name="option3"/>
              <label for="radio_1" class="radio"><span>Sort by State</span></label>
            </div>
            <div>
              <input type="radio" value="type" id="radio_4" name="option3"/>
              <label for="radio_2" class="radio"><span>Sort by Type</span></label>
            </div>
            <br>
            <select name="category" id="category">
              <option value=''>--</option>
              <option value="All">All</option>
              <option value="Casual">Casual</option>
              <option value="Casual Wear">Casual Wear</option>
              <option value="Dance">Dance</option>
              <option value="Dances">Dances</option>
              <option value="Doctor">Doctor</option>
              <option value="Dresses">Dresses</option>
              <option value="Fancy Dress">Fancy Dress</option>
              <option value="Folk Arts">Folk Arts</option>
              <option value="Historical">Historical</option>
              <option value="Movies">Movies</option>
              <option value="North India">North India</option>
              <option value="Occassional">Occassional</option>
              <option value="Occupational">Occupational</option>
              <option value="Other">Other</option>
              <option value="Other">Other</option>
              <option value="Other (religious)">Other (religious)</option>
              <option value="People">People</option>
              <option value="Police">Police</option>
              <option value="Profession">Profession</option>
              <option value="Professions">Professions</option>
              <option value="Punjab">Punjab</option>
              <option value="Regional">Regional</option>
              <option value="Religious">Religious</option>
              <option value="Sample">Sample</option>
              <option value="Seasonal">Seasonal</option>
              <option value="Southern India">Southern India</option>
              <option value="Special Occasion">Special Occasion</option>
              <option value="Tribal">Tribal</option>
              <option value="TBD">TBD/option>
            </select>
            <br>
            <?php
              require 'db_configuration.php';
              $keySql = "SELECT DISTINCT key_words from `dresses`";
              $categorySql = "SELECT DISTINCT category FROM dresses";
              $typeSql = "SELECT DISTINCT type FROM dresses";

            ?>
          </div>
        </div>
        <div class="btn-block">
          <button class="pptBtn" type="submit" href="export_powerpoint.php">Export</button>
        </div>
      </form>
    </div>
  </body>
</html>