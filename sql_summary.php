<?php
session_start();

require 'bin/functions.php';
require 'db_configuration.php';

$query = "SELECT category, COUNT(name) AS count
FROM dresses
GROUP BY category
ORDER BY count DESC";

$GLOBALS['data'] = mysqli_query($db, $query);

?>


<?php $page_title = 'Project ABCD > dresses'; ?>

<?php include('header.php'); 
    $page="dresses_list.php";
   // verifyLogin($page);
?>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<!-- Page Content -->
<br><br>
<!-- <div class="container-fluid"> -->
   
    <h2 id="title">Dresses -> Category Summary</h2><br>
    
    <div id="customerTableView">
        <table class="display" id="category_table" style="width:100%">
            <div class="table">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Count</th>
                </tr>
                </thead>
                <tbody>
                
                <?php
                // fetch the data from $_GLOBALS
                if ($data->num_rows > 0) {
                    // output data of each row
                    while($row = $data->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["category"]. "</td>";
                        echo "<td>" . $row["count"] . "</td>";
                        echo "</tr>";
                    }//end while
                }//end if
                ?>  
                </tbody>
            </div>
        </table>
    </div>
<!-- </div> -->


</body>
</html>
