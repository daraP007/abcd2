<?php

  // used to convert a traditional youtube link into an embedded video link.
  function get_yt_embed_url($url) {
    return str_replace('/watch?v=', '/embed/', $url);
  }

  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }

  function fill_blog($db) {
    $MAX_POSTS = 10;

    $sql = "SELECT * FROM blogs ORDER BY Created_Time DESC";
    $result = mysqli_query($db, $sql);
    // Create Post from data from each row
    if ($result->num_rows > 0) {
      $number_of_posts = 0;
      $number_of_pages = 1;
      echo '<div class="blog_page" id="page'. $number_of_pages . '">';
      while($row = $result->fetch_assoc()) {

        #create new page when the posts-per-page has been reached
        if ($number_of_posts == $MAX_POSTS) {
          $number_of_pages += 1;
          echo '
            </div>
            <div class="blog_page" id="page'. $number_of_pages . '" hidden="hidden">
            ';
          $number_of_posts = 0;
        }
        if ($row["Video_Link"] != NULL) {
          // $blog_video = '<a class="blog_link" href=' . $row["Video_Link"] . '> Video </a>';

          // embed the youtube video
          $blog_video = '<div style="width: 560px; height: 315px; float: none; clear: both; margin: 2px auto;">
          <embed
            src='. get_yt_embed_url($row["Video_Link"]) .'
            wmode="transparent"
            type="video/mp4"
            width="100%" height="100%"
            allow="autoplay; encrypted-media; picture-in-picture"
            allowfullscreen
            >
          </div>';


        } else {
          $blog_video = '';
        }
        if ($row["Video_Link2"] != NULL) {
          // $blog_video = '<a class="blog_link" href=' . $row["Video_Link"] . '> Video </a>';

          // embed the youtube video
          $blog_video2 = '<div style="width: 560px; height: 315px; float: none; clear: both; margin: 2px auto;">
          <embed
            src='. get_yt_embed_url($row["Video_Link2"]) .'
            wmode="transparent"
            type="video/mp4"
            width="100%" height="100%"
            allow="autoplay; encrypted-media; picture-in-picture"
            allowfullscreen
            >
          </div>';


        } else {
          $blog_video2 = '';
        }
        if ($row["Video_Link3"] != NULL) {
          // $blog_video = '<a class="blog_link" href=' . $row["Video_Link"] . '> Video </a>';

          // embed the youtube video
          $blog_video3 = '<div style="width: 560px; height: 315px; float: none; clear: both; margin: 2px auto;">
          <embed
            src='. get_yt_embed_url($row["Video_Link3"]) .'
            wmode="transparent"
            type="video/mp4"
            width="100%" height="100%"
            allow="autoplay; encrypted-media; picture-in-picture"
            allowfullscreen
            >
          </div>';


        } else {
          $blog_video3 = '';
        }
        $picture_sql = "SELECT Location FROM blog_pictures WHERE Blog_Id = " . $row["Blog_Id"];
        $picture_locations = mysqli_query($db, $picture_sql);
        $blog_pictures = '<div class="d-flex flex-wrap justify-content-center">';
        if ($picture_locations->num_rows > 0) {
          while($picture = $picture_locations->fetch_assoc()) {
            $blog_pictures = $blog_pictures . '<img class="blog_picture" src="'. $picture['Location'] . '"> <br>';
          }
        }
        $blog_pictures = $blog_pictures . '</div>';

        $blog_body =
        '
        <div class="blog_post"  id="'. $row['Blog_Id'] . '">
          <h2 style="padding-top: 10px; font-weight: bold;">' . $row['Title'] . '</h2>
          <h5 style="text-align: left; margin-left: 20px;"> By: ' . $row['Author'] . '</h5>
          <p>' . $row['Created_Time'] . '</p>
          <p>' . nl2br($row['Description']) . '</p> <br>
        ';

        $blog_admin_buttons = '
        <div style="margin-top: 8px;">
          <a class="btn btn-warning btn-sm" href="modify_blog.php?id='.$row["Blog_Id"].'">Modify</a>
          <a class="btn btn-danger btn-sm" href="delete_blog.php?id='.$row["Blog_Id"].'" onclick="return confirm(\'Are you sure you would like to delete this blog post?\');">Delete</a> <br><br>
        </div>
        ';
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
          echo $blog_body.$blog_pictures.$blog_video.$blog_video2.$blog_video3.$blog_admin_buttons.'</div>';
        } else {
          echo $blog_body.$blog_pictures.$blog_video.$blog_video2.$blog_video3.'</div>';
        }
        $number_of_posts += 1;
      }
      echo '</div>';
    } else {
      echo "0 results";
    }
  }

  function fill_TOC($db) {
    $sql = "SELECT Blog_Id, Title FROM blogs ORDER BY Created_Time DESC";
    $result = mysqli_query($db, $sql);

    if ($result->num_rows > 0) {
      // Place title in TOC
      while($row = $result->fetch_assoc()) {
        $TOC_Entry = '<li class="list-group-item list-group-item-action" onclick="scrollToPost(\'' . $row['Blog_Id'] . '\')">' . $row['Title'] . '</a></li>';
        echo $TOC_Entry;
      }
    } else {
      echo "0 results";
    }
  }
  ?>