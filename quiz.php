<?php
if (isset($_POST["correct"])){
    $answer2 = $_POST["answer"];
    $correctanswer2 = $_POST["correct"];
    $dress_Image = $_POST["dress_Image"];
    if ($answer2 == $correctanswer2){
        header('location: quiz.php?questionAnswered=correct');
     } 
     else {
        header('location: quiz.php?questionAnswered=Incorrect&answer='.$answer2.'&dress_Image3='.$dress_Image.'&correctAnswer='.$correctanswer2);
     }
}

require 'db_configuration.php';
include('header.php');

$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
?>

<style>
.body {
    text-align: center;
}

.isHidden { 
    display: none; 
}

.image {
    height: 300px;
    padding: 8px 8px 8px 8px;
}

.title {
    /* TODO: top padding of 50px is needed because nav bar overlaps some pages */
    padding: 50px 8px 8px 8px;
    text-align: center;
    color: darkgoldenrod;    
}

.question {
    color: rgb(0,200,55);
}

.response {
    color: black;
}

.wrongresponse {
    color: black;
}
</style>

<html>
<body class = "body">
<h3 class = "title" id="title">Dresses Quiz</h3>

<div>
<?php


if(isset($_GET['questionAnswered'])){
    if($_GET["questionAnswered"] == "correct"){
        echo '<h5 class = "response" >Success! Your answer was Correct!</h5>';
    }
    else{
        echo '<h5 class = "response" >Sorry, your answer was Incorrect.</h5>';
        $to_hide = "hello";
    }
}

if(isset($_GET['answer'])){
    $answer3 =$_GET["answer"];
    $correctanswer3 =$_GET["correctAnswer"];
    $dress_Image2 =$_GET['dress_Image3'];
}
?>
</div>

<div class="<?= $to_hide ? '' : 'isHidden' ?>">
<?php
    echo($dress_Image2);
    print('<p class= "wrongresponse"> The name of this dress is '.$correctanswer3.'. Your answer was: '.$answer3.'. To learn more about this dress click on the button. </p>');
?>

<form method="get" action="quiz.php">
    <button type="submit">Continue to Next Question</button>
</form>
</br>
<form method="get" action="display_the_dress.php">
    <button type="submit" name="name" value="<?php echo($correctanswer3); ?>">
        Click Here to learn more about this Dress
    </button>
</form>
</div>

<div class="<?= $to_hide ? 'isHidden' : '' ?>">
<?php
    $page_title = 'Dresses > Dresses Quiz';
    $page = "quiz.php";
    $sql = "SELECT * FROM dresses ORDER BY rand() LIMIT 4" ;
    $GLOBALS['row_data'] = mysqli_query($db, $sql);

    // fetch the data from $_GLOBALS
    if ($row_data->num_rows > 0) {
        $row = $row_data->fetch_assoc();

        $name1 = $row["name"];
        $image = $row["image_url"];
        $row = $row_data->fetch_assoc();
        $name2 = $row["name"];
        $row = $row_data->fetch_assoc();
        $name3 = $row["name"];
        $row = $row_data->fetch_assoc();
        $name4 = $row["name"];

        $image2 = "<image class = 'image' src = images/dress_images/" .$image. "></image>";
        print('<h4 class= "question"> What is the name of this Dress? </h4>');
        echo($image2);

    }

    $correctanswer = $name1;
    $dresses = array("$name1", "$name2", "$name3", "$name4");
    shuffle($dresses);
    ?>


<div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="radio" name="answer" <?php if (isset($answer) && $answer=="$dresses[0]") echo "checked";?>
value="<?php echo($dresses[0]);?>"> <?php echo($dresses[0]);?> 
</br>
<input type="radio" name="answer" <?php if (isset($answer) && $answer=="$dresses[1]") echo "checked";?>
value="<?php echo($dresses[1]);?>"> <?php echo($dresses[1]);?> 
</br>
<input type="radio" name="answer" <?php if (isset($answer) && $answer=="$dresses[2]") echo "checked";?>
value="<?php echo($dresses[2]);?>"> <?php echo($dresses[2]);?> 
</br>
<input type="radio" name="answer" <?php if (isset($answer) && $answer=="$dresses[3]") echo "checked";?>
value="<?php echo($dresses[3]);?>"> <?php echo($dresses[3]); ?> 
</br>
<input type="hidden" name="correct" value="<?php echo($correctanswer); ?>">
<input type="hidden" name="dress_Image" value="<?php echo($image2); ?>">
<input type="submit" name="submit" value="Submit">
</form>
</div>

</div>


</body>
</html>
