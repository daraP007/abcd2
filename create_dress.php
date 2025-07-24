<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}

require 'bin/functions.php';
require 'db_configuration.php';
include('header.php');

$page_title = 'Dresses > Create A Dress';
$page = "create_dress.php";
verifyLogin($page);

?>
<?php
// here is the information to connect to the database
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
    <form action="create_the_dress.php" method="POST" enctype="multipart/form-data">
        <br>
        <h3 id="title">Create A Dress</h3> <br>

        <div>
            <label>Name</label> <br>
            <input style=width:400px class="form-control" type="text" name="name" maxlength="100" size="50" required title="Please enter a name"></input>
        </div>

        <div>
            <label>Description</label> <br>
            <textarea style=width:400px class="form-control" name="description" cols="55" rows="5" required title="Please enter a description"></textarea>
        </div>

        <div>
            <label>Did You Know</label> <br>
            <textarea style=width:400px class="form-control" name="did_you_know" cols="55" rows="2" required title="Please enter an interesting fact"></textarea>
        </div>

        <div>
            <label>Category</label> <label id="guidance"> (regional, religious, people, dresses, festivals, other)</label><br>
            <input style=width:400px class="form-control" type="text" name="category" maxlength="100" size="50"></input>
        </div>

        <div>
            <label>Type</label> <label id="guidance"> (boys, girls, men, women, other)</label> <br>
            <input style=width:400px class="form-control" type="text" name="type" maxlength="100" size="50" required title="Please enter a type"></input>
        </div>

        <div>
            <label>State Name</label> <br>
            <input style=width:400px class="form-control" type="text" name="state_name" maxlength="100" size="50"></input>
        </div>

        <div>
            <label>Key Words</label> <br>
            <input style=width:400px class="form-control" type="text" name="key_words" maxlength="100" size="50" </input> </div> <div>
            <label>Image</label> <br>
            <input style=width:400px type="file" onchange="loadFile(event)" name="fileToUpload" id="fileToUpload" accept="image/jpg, image/jpeg, image/png" required title="Please enter an image file"></input><br>
            <img id="output" width="200" />
        </div>

        <div>
            <label>Status</label> <br>
            <select style=width:400px class="form-control" id="status" name="status">
                <option value="proposed">Proposed</option>
                <option value="approved">Approved</option>
                <option value="drawing_done">Drawing Done</option>
                <option value="write_done">Write-up Done</option>
            </select>
        </div>

        <div>
            <label>Notes</label> <br>
            <input style=width:400px class="form-control" type="text" name="notes" maxlength="100" size="50" required title="Please enter additional notes or N/A to represent none"></input>
        </div>
        <br><br>
        <div align="center" class="text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Create Dress</button>
        </div>
        <br> <br>

    </form>
</div>

<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>