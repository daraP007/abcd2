<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($page_title)) {
    $page_title = 'Project ABCD';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="./css/publishersdb.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <style>
        #header {
            color: darkgoldenrod;
        }
    </style>
    <script src="https://kit.fontawesome.com/f40040d297.js" crossorigin="anonymous"></script>
    <script>
        // When the user scrolls the page, execute myFunction
    </script>

</head>

<body onload="displayAdminFields('admin1')" class="navbar-body">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-xl sticky navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <a href="index.php" title="SILC Project ABCD"><img src="images/about_images/abcd_logo2.png"></a>
                <?php if (isset($_SESSION['role'])) { ?>
                    <div class="profileInfo">
                        <i class="fa-solid fa-user" id="userIcon"></i>
                        <p><?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"]; ?> / <i><?php echo $_SESSION["role"]; ?></i></p>
                    </div>
                <?php } ?>
            </ul>
            <ul class="navbar-nav mr-right">
                <li class="nav-item">
                    <div class="search-container">
                        <form action="./searchbar.php" method="POST"><input required type="text" placeholder="Search.." name="search"><button class="btn" type="submit"><i class="fa fa-search"></i></button></form>
                    </div>
                </li>
                                <!-- "Celebrate" button added to toolbar - FP2 -->
                <li class="nav-item active"><a class="nav-link" id="header" href="celebrations.php">Celebrate<span class="sr-only">(current)</span></a></li>
                <li class="nav-item active"><a class="nav-link" id="header" href="list_dresses.php">Dresses<span class="sr-only">(current)</span></a></li>
                <li class="nav-item active"><a class="nav-link" id="header" href="artistShowcase.php">Artists<span class="sr-only">(current)</span></a></li>
                <li class="nav-item active"><a class="nav-link" id="header" href="nomination.php">Nomination<span class="sr-only">(current)</span></a></li>
                <li class="nav-item active"><a class="nav-link" id="header" href="blogs.php">Blog<span class="sr-only">(current)</span></a></li>
                <li class="nav-item active"><a class="nav-link" id="header" href="about.php">About<span class="sr-only">(current)</span></a></li>
                <!--Temporarily hidden from view per instructor direction -->
                <!--<li class="nav-item active"><a class="nav-link" id="header" href="help.php">Help<span class="sr-only">(current)</span></a></li> -->
                <li class="nav-item active"><a class="nav-link" id="header" href="shop.php">Shop<span class="sr-only">(current)</span></a></li>
                <?php if (isset($_SESSION['role'])) { ?>
                    <?php if ($_SESSION['role'] == 'admin') { ?>
                        <li class="nav-item active"><a class="nav-link" id="header" href="admin.php">Admin<span class="sr-only">(current)</span></a></li>
                    <?php } ?>

                    <li class="nav-item active"><a class="nav-link" id="header" href="logout.php">Logout<span class="sr-only">(current)</span></a></li>
                <?php } else { ?>
                    <li class="nav-item active"><a class="nav-link" id="header" href="loginForm.php">Login<span class="sr-only">(current)</span></a></li>
                <?php } ?> 
            </ul>
        </div>
    </nav>