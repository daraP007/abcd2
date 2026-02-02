<?php $page_title = 'Admin > Create New User'; ?>
<?php 
    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    $page="users.php";
    //verifyLogin($page);

?>

<div class="container">
<style>

    #title {
        text-align: center; 
        color: darkgoldenrod;
}

    #guidance {
        color: grey;
        font-size: 10px;
    }

</style>
    <!--Check the CeremonyCreated and if Failed, display the error message-->
    <?php
    // if(isset($_GET['createQuestion'])){
    //     if($_GET["createQuestion"] == "fileRealFailed"){
    //         echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not real, Please Try Again!</h3>';
    //     }
    // }
    // if(isset($_GET['createQuestion'])){
    //     if($_GET["createQuestion"] == "answerFailed"){
    //         echo '<br><h3 align="center" class="bg-danger">FAILURE - Your answer was not one of the choices, Please Try Again!</h3>';
    //     }
    // }
    // if(isset($_GET['createQuestion'])){
    //     if($_GET["createQuestion"] == "fileTypeFailed"){
    //         echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not a valid image type (jpg,jpeg,png,gif), Please Try Again!</h3>';
    //     }
    // }
    // if(isset($_GET['createQuestion'])){
    //     if($_GET["createQuestion"] == "fileExistFailed"){
    //         echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image does not exist, Please Try Again!</h3>';
    //     }
    // }
  
    ?>
    <form action="create_the_user.php" method="POST" enctype="multipart/form-data">
        <br>
        <h3 id="title">Create New User</h3> <br>
        
        <div>
            <label>First Name</label> <br>
            <input style=width:400px class="form-control" type="text" name="first_name" maxlength="100" size="50" required title="Please enter a name (first)"></input>
        </div>
        
        <div>
            <label>Last Name</label> <br>
            <input style=width:400px class="form-control" type="text" name="last_name" maxlength="100" size="50" required title="Please enter a name (last)"></input>
        </div>

        <div>
            <label>Email</label> <label id="guidance"> </label><br>
            <input style=width:400px class="form-control" type="text" name="email" maxlength="100" size="50"></input>
        </div>

        <div>
            <label>Role</label> <br>
            <input style=width:400px class="form-control" type="text" name="role" maxlength="100" size="50" required title="Please enter a role (admin, developer, tester, etc)"></input>
        </div>
         
        <br><br>
        <div align="center" class="text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Create User</button>
        </div>
        <br> <br>

    </form>
</div>

<script>
//var loadFile = function(event) {
	//var image = document.getElementById('output');
	//image.src = URL.createObjectURL(event.target.files[0]);
//};

</script>