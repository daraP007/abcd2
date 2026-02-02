<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}

//require 'bin/functions.php';
require 'db_configuration.php';
include('header.php');
require 'blog_fill.php';

$page_title = 'Project ABCD2 Blog';
//$page = "blogs.php";
//Check if user is login
//verifyLogin($page);
?>

<!DOCTYPE html>
<html>
    <script type="text/javascript" src="js/blog_functions.js"></script>
    <title>Project ABCD2 Blog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="css/blog.css" rel="stylesheet">

    <script>
      function show_form() {
        var form = document.getElementById("blog_creation_form");
        var show_button = document.getElementById("form_show_button");
        form.removeAttribute("hidden");
        show_button.setAttribute("hidden", "hidden");
      }
      function hide_form() {
        var form = document.getElementById("blog_creation_form");
        var show_button = document.getElementById("form_show_button");
        form.setAttribute("hidden", "hidden");
        show_button.removeAttribute("hidden");
      }

    </script>

  <body>
  <div class="header-container" style="background-color: white;">
    <div class="heading">
      <div class="container">
        <h1><span class="accent-text">Blog</span></h1>
      </div>
    </div>

      <?php
        if (isset($_SESSION['role'])) {
            echo '<button id="form_show_button" onclick="show_form();" style="margin-bottom: 20px;">Create Post</button>';
        }
      ?>


    <div class="card blog-form-creation-container">
      <form id="blog_creation_form" action="create_blog_post.php" method="POST" enctype="multipart/form-data" hidden="hidden">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="title">Blog Title</label>
            <input type="text" name="title" class="form-control" maxlength=100 placeholder="Blog Title..." required>
          </div>
          <div class="form-group col-md-6">
            <label for="author">Author</label>
            <input type="text" name="author" class="form-control" value= <?php echo $_SESSION['email'] ?> readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
            <textarea name="description" class="form-control" rows=9 cols=50 placeholder="Enter your description..." required></textarea>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Image(s)</label>
            <input type="file" name="file[]" class="form-control btn" accept="image/*" multiple="multiple">
          </div>
          <div class="form-group col-md-6">
            <label>Video Link</label>
            <input type="text" name="video_link" class="form-control" maxlength=100 placeholder="Optional">
            <div id="extraLink1" style="style.display = none;">
              <input type="text" name="video_link2" class="form-control" maxlength=100 placeholder="Optional">
              <button id="secondLinkButton" type="button" onclick="showThirdLinkField()"> Add Additional Video Link</button>
            </div>
            <div id="extraLink2" style="style.display = none;">
              <input type="text" name="video_link3" class="form-control" maxlength=100 placeholder="Optional">
            </div>
            <button id="firstLinkButton" type="button" onclick="showSecondLinkField()">Add Additional Video Link</button>
          </div>
        </div>
        <div>
          <button type="submit" name="create_post" value="Publish" class="btn btn-md">Publish</button>
          <button id="cancel-button" type="button" onclick="hide_form();" class="btn btn-secondary btn-md">Cancel</button>
        </div>
      </form>
    </div>

  </div>

    
      <div class="blog-post-container d-flex flex-md-row bd-highlight flex-wrap">
        <div class="p-3 flex-fill bd-highlight" style="width: 250px">
          <div id="blog_TOC" class="sticky-top" style="top: 110px;">
            <h3 id="TOC_title" class="accordion-header sticky-top" style="font-weight: bold">Table of Contents</h3>
            
            <ul class="list-group list-group-flush list-group-item-action">
              <?php fill_TOC($db); ?>
            </ul>

          </div>
        
        </div>
        <div class="p-3 flex-fill bd-highlight" style="width: 70%;">
          <?php fill_blog($db); ?>
        </div>
      </div>

      <div id="blog_buttons" class="d-flex justify-content-center">
        <button id="blog_previous" class="btn btn-sm" onclick="handlePageButton('previous')" hidden="hidden">< Previous Page</button>
        <button id="blog_next" class="btn btn-sm" onclick="handlePageButton('next')">Next Page ></button>
      </div>
      <script>
      function showSecondLinkField() {
        var x = document.getElementById("extraLink1");
        var y = document.getElementById("firstLinkButton");
        if (x.style.display === "block") {
          x.style.display = "none";
        } else {
          x.style.display = "block";
          y.style.display = "none";
        }
      }

      function showThirdLinkField() {
        var x = document.getElementById("extraLink2");
        var z = document.getElementById("secondLinkButton");
        if (x.style.display === "block") {
          x.style.display = "none";
        } else {
          x.style.display = "block";
          z.style.display = "none";
        }
      }
      </script>
  </body>
</html>