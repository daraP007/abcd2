<?php 
$status = session_status();
if($status == PHP_SESSION_NONE){
    session_start();
}
require 'bin/functions.php';
require 'db_configuration.php';
$page_title = ' Project ABCD > Preferences';
include('header.php'); 
    $page="preferences.php";

   // $pic_sql = "SELECT `image_url` FROM `dresses` WHERE 'id = 1'";
   // $pic_results = mysqli_query($db, $pic_sql);
   // $name_sql = "SELECT `name` FROM `dresses`";
    $pic_sql = "SELECT `image_url` FROM `dresses`";
    

   // $name_results = mysqli_query($db, $name_sql);
    $pic_results = mysqli_query($db, $pic_sql);

   // if (mysqli_num_rows($name_results) > 0) {
     //   while ($row = mysqli_fetch_assoc($name_results)) {
       //     $dress_names[] = $row;
    //    }
    //}

    if (mysqli_num_rows($pic_results) > 0) {
        while ($row = mysqli_fetch_assoc($pic_results)) {
            $dress_pics[] = $row;
        }
    }
    $pic1 = $dress_pics[1]['image_url'];
    $pic1 = "images/dress_images/" . $pic1;
   // $pic1 = mysqli_fetch_assoc($pic_results);
   // $pic1 = "images/dress_images/" . $pic1;
    //$pic1 = $dress_pics[1]['image_url'];
    //verifyLogin($page);

// Hard code these defaults for now; Ideally, we can get these from the database.
$row_count = 5;
$dresses_count = 20;
$fav_dress = "Saree";
$image_height = "350";
$image_width = "250";
$home_view = "grid";
$carousel_pic_count = 10;
$description_length = 1000;
$did_you_know_length = 1000;
// cookie name
$row_count_cookie_name = "row_count";
$dresses_count_cookie_name = "dresses_count";
$favorite_dress_cookie_name = "favorite_dress";
$image_height_cookie_name = "img_height";
$image_width_cookie_name = "img_width";
$home_view_cookie_name = "home_view";
$carousel_pic_count_cookie_name = "carousel_pic_count";
$description_length_cookie_name = "description_length";
$did_you_know_length_cookie_name = "did_you_know_length";
// if cookie is present, then use those values
// if cookie is NOT present, then the defaults we set earlier will come into play
if(isset($_COOKIE[$favorite_dress_cookie_name])){
    $fav_dress = $_COOKIE[$favorite_dress_cookie_name];
}

if(isset($_COOKIE[$row_count_cookie_name])){
    $row_count = $_COOKIE[$row_count_cookie_name];
}

if(isset($_COOKIE[$dresses_count_cookie_name])){
    $dresses_count = $_COOKIE[$dresses_count_cookie_name];
}

if(isset($_COOKIE[$image_height_cookie_name])){
    $image_height = $_COOKIE[$image_height_cookie_name];
}

if(isset($_COOKIE[$image_width_cookie_name])){
    $image_width = $_COOKIE[$image_width_cookie_name];
}

if(isset($_COOKIE[$home_view_cookie_name])){
    $home_view = $_COOKIE[$home_view_cookie_name];
}

if(isset($_COOKIE[$carousel_pic_count_cookie_name])){
    $carousel_pic_count = $_COOKIE[$carousel_pic_count_cookie_name];
}

if(isset($_COOKIE[$description_length_cookie_name])){
    $description_length = $_COOKIE[$description_length_cookie_name];
}

if(isset($_COOKIE[$did_you_know_length_cookie_name])){
    $did_you_know_length = $_COOKIE[$did_you_know_length_cookie_name];
}
$home_view_array=['Grid', 'Carousel'];
      
        $num = count($home_view_array);

        for ($i=0 ; $i < $num ; $i++) {

          if ($home_view_array[$i] == $home_view){
            $home_view_array[$i] = "$home_view_array[$i]" .'"'. ' selected = "selected" ' ;
            }
        else $home_view_array[$i] = "$home_view_array[$i]";
        }

// we will rely only on cookie; ditch the db values for updates
$form_action = "set_cookie.php";
// if (isset($_SESSION['role'])){
//     $form_action = "modify_the_preferences.php";
// }
?>
<style>#title {text-align: center;color: darkgoldenrod;}</style>
<html>
    <head>

        <title>Project ABCD</title>
        <link href="css/preferences.css" rel="stylesheet">

    </head>
    <body>
    <br>
    <h3 id="title">Update Preferences</h3><br>
    </body>
    <div class="container">
        <!--Check the CeremonyCreated and if Failed, display the error message-->
        
        <form action="<?php echo $form_action ?>" method="POST">
        <table style="width:600px">
        <tr>
            <th style="width:300px"></th>
            <th>Current Value</th> 
            <th>Update Value</th>
        </tr>
        <td>
            <label>Homepage View</label> 
            <td><input disabled type="text" maxlength="10" size="13" value="<?php echo $home_view; ?>" title="Current value"></td>
           <td> <select style=width:120px class="form-control" id="home_view" name="home_view" >
                <?php echo '<option value="'.$home_view_array[0].'">Grid</option>
                <option value="'.$home_view_array[1].'">Carousel</option>'; ?>
            </select> </td>
        </td>
        <tr>
            <td style="width:300px">Number of Dresses on Carousel:</td>
            <td><input disabled type="int" maxlength="2" size="13" value="<?php echo $carousel_pic_count; ?>" title="Current value"></td> 
            <td><input required type="int" name="carousel_pic_count" maxlength="2" size="13" value="<?php echo $carousel_pic_count; ?>" ></td>
        </tr>
        <tr>
            <td style="width:300px">Number of Dresses Per Row:</td>
            <td><input disabled type="int" maxlength="2" size="13" value="<?php echo $row_count; ?>" title="Current value"></td> 
            <td><input required type="int" name="row_count" maxlength="2" size="13" value="<?php echo $row_count; ?>" ></td>
        </tr>
        <tr>
            <td style="width:300px">Number of Dresses to Display Per Page:</td>
            <td><input disabled type="int" maxlength="3" size="13" value="<?php echo $dresses_count; ?>" title="Current value"></td> 
            <td><input required type="int" name="dresses_count" maxlength="3" size="13" value="<?php echo $dresses_count; ?>" ></td>
        </tr>
        <tr>
            <td style="width:300px">Name of Favorite Dress:</td>
            <td><input disabled type="text" maxlength="10" size="13" value="<?php echo $fav_dress; ?>" title="Current value"></td> 
            <td><input required type="text" name="fav_dress" maxlength="20" size="13" value="<?php echo $fav_dress; ?>" ></td>
        </tr>
        
        <tr>
            <td style="width:300px">Length of Description (in characters):</td>
            <td><input disabled type="text" maxlength="10" size="13" value="<?php echo $description_length; ?>" title="Current value"></td> 
            <td><input required type="text" name="description_length" maxlength="20" size="13" value="<?php echo $description_length; ?>" ></td>
        </tr>

        <tr>
            <td style="width:300px">Length of Did you know (in characters):</td>
            <td><input disabled type="text" maxlength="10" size="13" value="<?php echo $did_you_know_length; ?>" title="Current value"></td> 
            <td><input required type="text" name="did_you_know_length" maxlength="20" size="13" value="<?php echo $did_you_know_length; ?>" ></td>
        </tr>

        <tr>
            <td style="width:300px">Height of Image (in px):</td>
            <td><input disabled type="int" maxlength="10" size="13" value="<?php echo $image_height; ?>" title="Current value"></td> 
            <td><input required type="text"id= 'height' name="image_height" maxlength="20" size="13" value="<?php echo $image_height; ?>" onkeyup= "convert('C');" ></td>
          
        </tr>
        <tr>
            <td style="width:300px">Width of Image (in px):</td>
            <td><input disabled type="text" maxlength="10" size="13" value="<?php echo $image_width; ?>" title="Current value"></td> 
           <td><input required type="text" id= 'width' name="image_width" maxlength="20" size="13" value="<?php echo $image_width; ?>" onkeyup = "convert('F');" ></td> 
        
        </tr>
        </table><br>

        <?php  
            // we will ditch the database persistance and rely on only the cookie for preferences
            // if (isset($_SESSION['role'])){
            //     echo '<button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Modify Preferences</button>';
            // } else {
                echo '<button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Update Preferences</button>';
                // echo '<img src= "'.$pic1.'" width = "'.$image_width.'" height = "'.$image_height.'" >';
                // // }
        ?>
      </form>
     <!-- <button class="btn btn-primary btn-md align-items-center" onclick=
    "show_image('images/dress_images/amul_girl.jpg', 
                 250, 
                 350 
                 );">Preview Image Size</button>  -->
    </div> 

    
    <script>
    function convert(param1){
    if(param1 == "C"){
        document.getElementById('width').value = document.getElementById('height').value * (720/1040)
       
    }
    if(param1 == "F"){
        document.getElementById('height').value = document.getElementById('width').value * (1040/720)
        
    }

}
function show_image(src, width, height) {
    var img = document.createElement("img");
    img.src = "images/dress_images/amul_girl.jpg";
    img.width = width;
    img.height = height;
  

    // This next line will just add it to the <body> tag
    document.body.appendChild(img);
}

    </script>
    </body>
</html>

