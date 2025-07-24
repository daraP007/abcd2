<?php 
    ob_start();
    session_start();

    if ($_SESSION['role'] != 'admin'){
        header('Location:index.php'); 
    }

    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    
    $query = "SELECT * FROM nominations";
    $GLOBALS['data'] = mysqli_query($db, $query);
    
    $page="manageNominations.php";
    verifyLogin($page);
    ob_end_flush();
?>

<style>
    #title {
        text-align: center;
        color: darkgoldenrod;
    }
    thead input {
        width: 100%;
    }
    .thumbnailSize{
        height: 100px;
        width: 100px;
        transition:transform 0.25s ease;
    }
    .thumbnailSize:hover {
        -webkit-transform:scale(3.5);
        transform:scale(3.5);
    }
</style>

<!-- Page Content -->
<div class="container-fluid">   
    
    <div id="customerTableView">

    <h2 id="title">Manage Nominations</h2><br>

        <a class="btn btn-primary btn-sm" href="nomination.php">Create a Nomination</a>
        <table class="display" id="nominationsTable" style="width:100%">
            <div class="table responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Nominator</th>
                    <th>Display</th>
                    <th>Modify</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // fetch the data from $_GLOBALS
                if ($data->num_rows > 0) {
                    // output data of each row
                    while($row = $data->fetch_assoc()) {
                        echo '<tr>
                        <td>'.$row["id"].'</td> 
                        <td>'.$row["category"].'</td>
                        <td>'.$row["name"].'</td>
                        <td>'.$row["description"].'</td>
                        <td>'.$row["nominator"].'</td>
                        <td><a class="btn btn-info btn-sm" href="display_nomination.php?id='.$row["id"].'">Display</a></td>
                        <td><a class="btn btn-warning btn-sm" href="modify_nomination.php?id='.$row["id"].'">Modify</a></td>
                        <td><a class="btn btn-danger btn-sm" href="delete_nomination.php?id='.$row["id"].'">Delete</a></td>
                            </tr>';
                    }//end while
                }//end if
                else {
                    echo "0 results";
                }//end else
                ?>
                </tbody>
            </div>
        </table>
    </div>
</div>

<!-- /.container -->
<!-- Footer -->
<footer class="page-footer text-center">
    
</footer>

<!--JQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!--Data Table-->
<script type="text/javascript" charset="utf8"
        src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script type="text/javascript" language="javascript">
    $(document).ready( function () { 
        $('#nominationsTable').DataTable( {
            dom: 'lfrtBip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
        );       
        $('#nominationsTable thead tr').clone(true).appendTo( '#nominationsTable thead' );
        $('#nominationsTable thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        var table = $('#nominationsTable').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );

</script>

</body>
</html>
