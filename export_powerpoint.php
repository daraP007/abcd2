<!DOCTYPE html>
<html>
    <style>
    h1 {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding-top: 100px;
    }

    h2 {

      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding-bottom: 50px;

    }
    </style>
    <?php
    include('header.php'); 
    ?>
    <h1>PowerPoint Downloaded!</h1>
    <h2>Please check you downloads folder...</h2>
    <form form style="text-align: center;">
        <input type="button" value="Go back!" onclick="history.back()">
    </form>
</html>

<?php

use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\DocumentLayout;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Slide;
use PhpOffice\PhpPresentation\Slide\Iterator;

require_once 'vendor/autoload.php';

//Option Variables
$quantity = ($_POST['quantity']);

$display = 1;

$display2 = ($_POST['option2']);

if(isset($_POST['option3'])){

    $sortStateType = $_POST['option3'];

}

if($_POST['category'] != ""){

    $category = $_POST['category'];

}



$portraitLayout = new DocumentLayout();
$portraitLayout->setDocumentLayout(DocumentLayout::LAYOUT_SCREEN_16X9, false);

$objPHPPowerPoint = new PhpPresentation();
$objPHPPowerPoint->getLayout($portraitLayout);

// Create slide
$currentSlide = $objPHPPowerPoint->getActiveSlide();

// Create a shape (drawing)
$shape = $currentSlide->createDrawingShape();
$shape->setName('PHPPowerPoint logo')
->setDescription('PHPPowerPoint logo')
->setPath('images\about_images\abcd_logo.png')
->setHeight(72)
->setOffsetX(20)
->setOffsetY(20);

// Create a shape (text)
$shape = $currentSlide->createRichTextShape()
->setHeight(300)
->setWidth(600)
->setOffsetX(70)
->setOffsetY(230);
$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
$textRun = $shape->createTextRun('Thank You For Using ABCD Project!');
$textRun->getFont()->setBold(true)
->setSize(60)
->setColor( new Color( 'FFE06B20' ) );
$intdisplay = intval($display);
if ($intdisplay == 1) {
    $x_val_pic = 120;
    $y_val_pic = 200;
    $x_val_text = 80;
    $y_val_text = 200;
} 
else {
    $x_val_pic = 700;
    $y_val_pic = 200;
    $x_val_text = 20;
    $y_val_text = 200;
}

require 'bin/functions.php';
require 'db_configuration.php';

$mysqli = mysqli_connect('localhost', 'root', '', 'abcd_db');
$TableName = "dresses";

if(isset($_POST['sort']) && isset($_POST['option3']) && $_POST['category'] != ""){
    $strSQL = "SELECT * FROM $TableName WHERE category LIKE '%$category%' ORDER BY $sortStateType, name";
}

else if(isset($_POST['sort']) && $_POST['category'] != ""){
    $strSQL = "SELECT * FROM $TableName WHERE category LIKE '%$category%' ORDER BY name";
}

else if(isset($_POST['option3']) && $_POST['category'] != ""){
    $strSQL = "SELECT * FROM $TableName WHERE category LIKE '%$category%' ORDER BY $sortStateType";
}

else if(isset($_POST['sort']) && isset($_POST['option3'])){
    $strSQL = "SELECT * FROM $TableName ORDER BY $sortStateType, name";
}

else if(isset($_POST['sort'])){
    $strSQL = "SELECT * FROM $TableName ORDER BY name";
}

else if(isset($_POST['option3'])){
    $strSQL = "SELECT * FROM $TableName ORDER BY $sortStateType";
}

else {
    $strSQL = "SELECT * FROM $TableName";
}

$sql = mysqli_query($db, $strSQL);

if (mysqli_error($db)) {
    echo mysqli_error($db);
} else {
    if($sql->num_rows > 0) {
        $delimiter = ",";
        $filename = "dress-data_" . date('Y-m-d') . ".csv";
        
        $f = fopen('php://memory', 'w');
        $fields = array('id', 'name', 'description', 'did_you_know', 'category', 'type', 'state_name', 'key_words', 'image_url', 'status', 'notes');
        
         $count = 0;

        //testing prints
        echo("Quantity: ". $quantity);
        echo(" | Option: ".$display);
        echo(" | Option: ".$display2);

        if($display2 == 1){
            while($count != $quantity) {            
                $row = $sql->fetch_assoc();
                $lineData = array($row['name'],$row['description'],$row['did_you_know'],$row['category'],$row['type'],$row['state_name'],$row['key_words'],$row['image_url'],$row['status'],$row['notes']);
                
                //testing prints
                echo("<br><br>");
                echo("_______________________________________________________________________________________________________________________________________________________________________________________________________________________________________<br>");
                echo("Name: ".$lineData[0]. "<br>" . "Description: ". $lineData[1] ."<br>" . "Did You Know: ". $lineData[2] ."<br>" . "Category: ". $lineData[3] ."<br>" . "Type: ". $lineData[4] ."<br>" . "State Name: ". $lineData[5] ."<br>" . "Key Words: ". $lineData[6] . "<br>". "Image: ". $lineData[7]. "<br>". "Status: ". $lineData[8]. "<br>". "Notes: ". $lineData[9]);
                
                //create slide for text
                $slide2 = $objPHPPowerPoint->createSlide();
              
                // Create a shape (Description and Did you Know)
                $shape = $slide2->createRichTextShape()
                ->setHeight(300)
                ->setWidth(600)
                ->setOffsetX($x_val_text)
                ->setOffsetY($y_val_pic);
                $textRun1 = $shape->createTextRun($lineData[1]);
                $textRun = $shape->createTextRun("\n\n\nDid you know?: \n");
                $textRun2 = $shape->createTextRun($lineData[2]);
                $textRun1->getFont()->setBold(false)
                ->setSize(20)
                ->setColor( new Color( 'FFE06B20' ) );
                $textRun->getFont()->setBold(true)
                ->setSize(15)
                ->setColor( new Color( 'Black' ) );
                $textRun2->getFont()->setBold(false)
                ->setSize(10)
                ->setColor( new Color( 'Black' ) );

                //create slide for Dress image
                $slide1 = $objPHPPowerPoint->createSlide();
    
                //create picture (Dress image)
                $shape = $slide1->createDrawingShape();
                $shape->setName('PHPPowerPoint logo')
                ->setDescription('PHPPowerPoint logo')
                ->setPath('images/dress_images/'.$lineData[7])
                ->setHeight(700)
                ->setOffsetX(85)
                ->setOffsetY($y_val_pic);
                $shape->getShadow()->setVisible(true)
                ->setDirection(90)
                ->setDistance(20);

                // Create a shape (name)
                $shape = $slide1->createRichTextShape()
                ->setHeight(50)
                ->setWidth(200)
                ->setOffsetX(300)
                ->setOffsetY(20);
                $textRun = $shape->createTextRun($lineData[0]);
                $textRun->getFont()->setBold(True)
                ->setSize(20)
                ->setColor( new Color( 'black' ) );
                        
                $count++;
            }
        }

        if($display2 == 2){
            while($count != $quantity) {            
                $row = $sql->fetch_assoc();
                $lineData = array($row['name'],$row['description'],$row['did_you_know'],$row['category'],$row['type'],$row['state_name'],$row['key_words'],$row['image_url'],$row['status'],$row['notes']);
                
                //testing prints
                echo("<br><br>");
                echo("_______________________________________________________________________________________________________________________________________________________________________________________________________________________________________<br>");
                echo("Name: ".$lineData[0]. "<br>" . "Description: ". $lineData[1] ."<br>" . "Did You Know: ". $lineData[2] ."<br>" . "Category: ". $lineData[3] ."<br>" . "Type: ". $lineData[4] ."<br>" . "State Name: ". $lineData[5] ."<br>" . "Key Words: ". $lineData[6] . "<br>". "Image: ". $lineData[7]. "<br>". "Status: ". $lineData[8]. "<br>". "Notes: ". $lineData[9]);               
               
                //create slide for Dress image
                $slide1 = $objPHPPowerPoint->createSlide();
    
                //create picture (Dress image)
                $shape = $slide1->createDrawingShape();
                $shape->setName('PHPPowerPoint logo')
                ->setDescription('PHPPowerPoint logo')
                ->setPath('images/dress_images/'.$lineData[7])
                ->setHeight(700)
                ->setOffsetX(85)
                ->setOffsetY($y_val_pic);
                $shape->getShadow()->setVisible(true)
                ->setDirection(90)
                ->setDistance(20);

                // Create a shape (name)
                $shape = $slide1->createRichTextShape()
                ->setHeight(50)
                ->setWidth(200)
                ->setOffsetX(300)
                ->setOffsetY(20);
                $textRun = $shape->createTextRun($lineData[0]);
                $textRun->getFont()->setBold(True)
                ->setSize(20)
                ->setColor( new Color( 'black' ) );

                //create slide for text
                $slide2 = $objPHPPowerPoint->createSlide();
              
                // Create a shape (Description and Did you Know)
                $shape = $slide2->createRichTextShape()
                ->setHeight(300)
                ->setWidth(600)
                ->setOffsetX(25)
                ->setOffsetY($y_val_pic);
                $textRun1 = $shape->createTextRun($lineData[1]);
                $textRun = $shape->createTextRun("\n\n\nDid you know?: \n");
                $textRun2 = $shape->createTextRun($lineData[2]);
                $textRun1->getFont()->setBold(false)
                ->setSize(20)
                ->setColor( new Color( 'FFE06B20' ) );
                $textRun->getFont()->setBold(true)
                ->setSize(15)
                ->setColor( new Color( 'Black' ) );
                $textRun2->getFont()->setBold(false)
                ->setSize(10)
                ->setColor( new Color( 'Black' ) );
                        
                $count++;
            }
        }
                        
        // $oWriterPPTX = IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');
        // $oWriterPPTX->save(getenv("HOMEDRIVE").getenv("HOMEPATH")."\Downloads" . "\sample.pptx");
        $oWriterPPTX = IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');
        //$oWriterPPTX->save(__DIR__ . "/sample.pptx");
        $oWriterPPTX->save(getenv("HOMEDRIVE").getenv("HOMEPATH")."\Downloads" . "\abcdsample.pptx");
    }
}
?>






