<html>
<style>

table {
  margin-left: 50px;
}

td {
    padding: 10px 10px 10px 10px;
    font-size: 20px;
}

table, td, th {
  border: 1px solid black;
}

#title {
  margin-left: 50px;
}
</style>


<body>

<?php include('header.php'); ?> 

<?php

function Bingo() {


    if (!isset($_POST['submit'])){

      if ($_POST['cols'] == "" || $_POST['rows'] == "" || $_POST['cards'] == "" || $_POST['title'] == "") {
        echo 'Please be sure to fill out every field of the form! <br> <br> If you are still having issues, check that you entered a numerical value for the number of columns and rows.';
      } else {
        $title = $_POST['title'];
        $words = array();
        $cols = $_POST['cols'];
        $cards = $_POST['cards'];
        $rows = $_POST['rows'];
        $total = $cols * $rows;
        $added = explode(',',$_POST['list']);
        $words = array_merge($words, $added);
        $config = 1.4;
        if ($cards * $rows * $cols * $config < sizeof($words)) {

        if(array_key_exists('generate_bingo_cards', $_POST)) {

       echo "<h1 id='title'>$title</h1>\n<ul>\n";


      for($i = 0; $i < $cards; $i++) {
      shuffle($words);


      $bingocard = "<table id='bingo'>";
      $bingocard .= "<thead><tr>";
      $bingocard .= "</tr></thead>";
      $bingocard .= "<tbody>";
      $bingocard .= "<tr>";
  
      for($cell=0; $cell<$total; $cell++)
      {
        $rowend = ($cell + 1) % $cols;
        $bingocard .= "<td>"  . $words[$cell] . "</td>";
        if($rowend == 0) {
          $bingocard .= "</tr><tr>";
        }
      }
  
      $bingocard .= "</tr>";
      $bingocard .= "</tbody>";
      $bingocard .= "</table>";
  
      echo $bingocard . "<br>";
    }
    } 
    
    else if(array_key_exists('generate_bingo_list', $_POST)) {

 
      if(isset($_POST['randomize']) )
   {
       shuffle($words);
       echo "<h1>$title</h1>\n<ul>\n";
      foreach($words as $t){
      echo "<li>".trim($t)."</li>\n";  
      } echo"</ul>"; 
   }
   else
   {
    echo "<h1>$title</h1>\n<ul>\n";
    foreach($words as $t){
    echo "<li>".trim($t)."</li>\n";  
    } echo"</ul>"; 
   }
  }

    }
    else {
      echo "Please enter more words in the list! ";
    }
  }

    }
  }
  


?>
<?php Bingo(); ?>
</body>
</html>