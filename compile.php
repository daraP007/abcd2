<?php include("header.php"); ?>
<link rel="stylesheet" href="css/mainStyleSheet.css" type="text/css">

<style>
.container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

 .image {
    height: 600px;
    padding: 15px 15px 15px 15px;
} 
</style>

<body>
<div class="container">


<?php

require 'db_configuration.php';

$query = "SELECT * FROM dresses";

//list
$GLOBALS['data'] = mysqli_query($db, $query);

if ($data->num_rows > 0)  {  //when search is clicked this code runs  
          while($row = $data->fetch_assoc()) {
            print( '<br><br><br> <h2 class= "head">'.$row["id"] . '. ' .$row["name"]. '</h2>') ; 
            echo("<image class = 'image' src = images/dress_images/" .$row["image_url"] . " align='left' " . "></image>") ;  
            //<img src="images/dress_images/" width="50px" height="100px" /> 
            //echo("<image class = 'image' src = images/dress_images/" .$row["image_url"] . " width='50px' height='100px'" . "></image>") ;  

      print( '<h3 class= "title"> Description: </h3><p class= "words" >'.$row["description"]. '</p> 
              <h3 class= "title"> Did You Know? </h3><p class= "words">' .$row["did_you_know"]. '</p> 
              <h3 class= "title"> Category </h3><p class= "words">' .$row["category"]. '</p>  
              <h3 class= "title"> Type </h3><p class= "words">' .$row["type"]. '</p>  
              <h3 class= "title"> State Name </h3><p class= "words">' .$row["state_name"].   '</p>
              <h3 class= "title"> Key Words </h3><p class= "words">' .$row["key_words"]. '</p>
              <h3 class= "title"> Status </h3><p class= "words">' .$row["status"]. '</p>
              <h3 class= "title"> Notes </h3><p class= "words">' .$row["notes"]. '</p>  
              <p style="page-break-before: always"> <br><br><br>' );
              //style = "position:absolute; left:80px; top:20px;
    }
} else {
  print('no data');
}
          ?>
      

      </body>
</div>
<?php     
//end of search if statement
?>