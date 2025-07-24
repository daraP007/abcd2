<!DOCTYPE HTML>
<html>  

<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

#column1 {
    padding-left: 50px;
}

#title {
    color: darkgoldenrod;
}

</style>

<link rel="stylesheet" type="text/css">

<body>

<?php include('header.php'); ?> 

<br>
<br>
<div id="column1"> <h1 id="title">Bingo!</h1> </div>

<div class="row">

<form action="bingo_code.php"  method="post"> 
<div class="column" id="column1">
Title: <br> <input type="text" name="title" value="SILC"><br><br>
Number of rows: <br> <input type="text" name="rows"><br><br>
Number of columns: <br> <input type="text" name="cols"><br><br>
Number of cards to generate: <br> <input type="number" min="1" max="25" value="10"name="cards"><br><br>
</div>
<div class="column">
List (separate with commas): <br> <textarea name="list" rows="8" cols="50"></textarea><br>
Randomize List <input type="checkbox" name="randomize"> &nbsp; &nbsp; &nbsp; 

</div>
<div id="column1">
<input type="submit" value="Generate Bingo Cards" name="generate_bingo_cards"/>
<input type="submit" value="Generate Bingo List" name="generate_bingo_list"/>
</div>
</form>

</div>


</body>

</html>
