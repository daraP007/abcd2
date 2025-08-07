<?php
session_start();

require 'bin/functions.php';
require_once 'db_configuration.php';

// — pagination inputs —
$limit  = isset($_GET['limit']) && in_array((int)$_GET['limit'], [10,20,50,75,100])
          ? (int)$_GET['limit'] : 10;
$page   = isset($_GET['page'])  && (int)$_GET['page'] > 0
          ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// — sort inputs —
$sort     = $_GET['sort'] ?? 'ID';
$allowed  = ['ID'=>'id','Name'=>'name','Category'=>'category','Type'=>'type'];
if (! array_key_exists($sort, $allowed)) {
    $sort = 'ID';
}
$sort_column = $allowed[$sort];

// — total count for pagination —
$countRes   = mysqli_query($db, "SELECT COUNT(*) AS total FROM dresses");
$totalRow   = mysqli_fetch_assoc($countRes);
$totalPages = (int)ceil($totalRow['total'] / $limit);

// — Data query with ORDER BY and LIMIT/OFFSET —
$sql = "
    SELECT
        id, name, type, category,
        state_name, key_words,
        image_url, status, notes, tag_line
    FROM dresses
    ORDER BY {$sort_column} ASC
    LIMIT {$offset}, {$limit}
";
$res_data = mysqli_query($db, $sql);
?>


<!-- header.php included before HTML output -->
<?php include('header.php'); ?>

<html>

<head>
<title>ABCD</title>
<link href="css/index.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./css/responsive_style.css">
</head>

<body>
        
        <div class="contentContainer">
    <?php
        if(isset($_SESSION['status']) == "Success") {
            echo "<br><h3 alignt=center style='color:green'> Account Successfully Created! </h3>";
            unset($_SESSION['status']);
        }
    ?>

    <?php
    if (isset($_GET['preferencesUpdated'])) {
        if ($_GET["preferencesUpdated"] == "Success") {
            echo "<br><h3 align=center style='color:green'>Success! The Preferences have been updated!</h3>";
        }
    }

      //=============================================================================
    // Step 1: Get the row_count and dresses_count from COOKIE or from defaults
    //=============================================================================
    // Hard code these defaults for now; Ideally, we can get these from the database.

    $fav_dress = "Saree";
    $image_height = "350";
    $image_width = "250";

    // cookie name
    $row_count_cookie_name = "row_count";
    $dresses_count_cookie_name = "dresses_count";
    $favorite_dress_cookie_name = "favorite_dress";
    $image_height_cookie_name = "img_height";
    $image_width_cookie_name = "img_width";

    // if cookie is present, then use those values
    // if cookie is NOT present, then the defaults we set earlier will come into play

    if (isset($_COOKIE[$favorite_dress_cookie_name])) {
        $fav_dress = $_COOKIE[$favorite_dress_cookie_name];
    }

    if (isset($_COOKIE[$row_count_cookie_name])) {
        $row_count = $_COOKIE[$row_count_cookie_name];
    }

    if (isset($_COOKIE[$dresses_count_cookie_name])) {
        $dresses_count = $_COOKIE[$dresses_count_cookie_name];
    }

    else {
        $dresses_count = 20;
    }

    if (isset($_COOKIE[$image_height_cookie_name])) {
        $image_height = $_COOKIE[$image_height_cookie_name];
    }

    if (isset($_COOKIE[$image_width_cookie_name])) {
        $image_width = $_COOKIE[$image_width_cookie_name];
    }

    //=============================================================================
    // Step 2: Get the $pic and $name for each of the dresses from the database
    // Refrence: https://www.php.net/manual/en/mysqli-result.fetch-assoc.php
    //=============================================================================
   
 //$all_sheroes = array(743,711,476,733,523,677,688,442,319,473,542,731,115,317,763,468,669,739,690,611,742,724,401,112,313,700,686,560,475,326,735,655,668,710,618,714,578,684,626,703,525,547,671,318,725,32,549,722,434,713,405,728,687,698,691,466,751,435,620,760,102,654,695,768,762,470,605,33,750,114,432,429,439,662,119,265,328,673,30,151,101,493,471,689,31,438,732,323,581,538,324,111,761,723,327,582,506,754,409,440,423,678,588,693,734,692,444,320,664,659,276,658,746,709,534,196,548,117,477,518,418,632,720,445,704,407,426,729,437,748,306,752,577,52,701,50,188,206,441,670,330,771,568,321,740,696,427,766,544,679,699,666,716,322,411,755,764,443,491,737,316,601,685,464,492,53,414,110,676,730,663,753,325,415,356,413,420,39,412,660,736,329,575,469,183,717,463,665,702,27,715,410,425,770,726,430,586,583,28,769,697,406,275,314,574,428,235,681,712,772,483,424,462,201,467,29,741,524,631,718,682,680,758,683,738,465,419,674,472,745,520,474,116,431,721,171,484,436,744,759,672,422,767,433,749,502,756,706,478,719,747,757,26,694,765,667);
    $all_dresses_sql = "SELECT * FROM `dresses`";
    $id_sql = "SELECT `ID` FROM `dresses`";
    $name_sql = "SELECT `name` FROM `dresses`";
    $pic_sql = "SELECT `image_url` FROM `dresses`";
    
    $input = @$_GET['sort'];
    if ( strcmp($input,"shero") == 0 || empty($input) ){
        $all_sheroes = array(743,711,476,733,523,677,688,442,319,473,542,731,115,317,763,468,669,739,690,611,742,724,401,112,313,700,686,560,475,326,735,655,668,710,618,714,578,684,626,703,525,547,671,318,725,32,549,722,434,713,405,728,687,698,691,466,751,435,620,760,102,654,695,768,762,470,605,33,750,114,432,429,439,662,119,265,328,673,30,151,101,493,471,689,31,438,732,323,581,538,324,111,761,723,327,582,506,754,409,440,423,678,588,693,734,692,444,320,664,659,276,658,746,709,534,196,548,117,477,518,418,632,720,445,704,407,426,729,437,748,306,752,577,52,701,50,188,206,441,670,330,771,568,321,740,696,427,766,544,679,699,666,716,322,411,755,764,443,491,737,316,601,685,464,492,53,414,110,676,730,663,753,325,415,356,413,420,39,412,660,736,329,575,469,183,717,463,665,702,27,715,410,425,770,726,430,586,583,28,769,697,406,275,314,574,428,235,681,712,772,483,424,462,201,467,29,741,524,631,718,682,680,758,683,738,465,419,674,472,745,520,474,116,431,721,171,484,436,744,759,672,422,767,433,749,502,756,706,478,719,747,757,26,694,765,667);
        $Sort_string = 'name'; 
    }else{
    $Sort_string = $input;
    }

    
    $id_sql = $id_sql. " ORDER BY " .$Sort_string. " ASC";
    $name_sql = $name_sql. " ORDER BY " .$Sort_string. " ASC";
    $pic_sql = $pic_sql. " ORDER BY " .$Sort_string. " ASC";
   
    $dresses_results = mysqli_query($db, $all_dresses_sql);
    $id_results = mysqli_query($db, $id_sql);
    $name_results = mysqli_query($db, $name_sql);
    $pic_results = mysqli_query($db, $pic_sql);
    

    if (mysqli_num_rows($name_results) > 0) {
        while ($row = mysqli_fetch_assoc($id_results)) {
            $dress_id[] = $row;
        }
    }

    if (mysqli_num_rows($name_results) > 0) {
        while ($row = mysqli_fetch_assoc($name_results)) {
            $dress_names[] = $row;
        }
    }

    if (mysqli_num_rows($pic_results) > 0) {
        while ($row = mysqli_fetch_assoc($pic_results)) {
            $dress_pics[] = $row;
        }
    }


    $total_pages_sql = "SELECT COUNT(*) FROM dresses";
    $result = mysqli_query($db, $all_dresses_sql);
    $num_results = mysqli_num_rows($result);


// — Pagination Inputs —
$limit  = isset($_GET['limit'])  && in_array((int)$_GET['limit'], [10,20,50,75,100])
            ? (int)$_GET['limit'] : 10;
$page   = isset($_GET['page'])   && (int)$_GET['page'] > 0
            ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// — Total count for pagination —
$countRes  = mysqli_query($db, "SELECT COUNT(*) AS total FROM dresses");
$totalRow  = mysqli_fetch_assoc($countRes);
$total     = (int)$totalRow['total'];
$totalPages = (int)ceil($total / $limit);

// — Data query with ORDER BY id and LIMIT/OFFSET —
$sql = "
    SELECT
      id, name, type, category,
      state_name, key_words,
      image_url, status, notes, tag_line
    FROM dresses
    ORDER BY id ASC
    LIMIT {$offset}, {$limit}
";
$res_data = mysqli_query($db, $sql);


?>
    
<h1 class="mainTitle">Welcome to Project ABCD</h1>
<h2 class="subTitle">A Bite of Culture in Dresses</h2><br>
<h1 id="section-heading">Select a dress to know more about it</h1><br>

<!-- sort block updated -->
<div class="controlsForm">

    <!-- 1) SHOW dropdown (preserves current sort) -->
    <form method="get" action="index.php" class="limitForm" style="display:inline-block; margin-right: 1rem;">
        <label for="limitSelect">Show:</label>
        <select name="limit" id="limitSelect" class="sortLink" onchange="this.form.submit()">
            <option value="10"  <?= $limit === 10  ? 'selected' : '' ?>>10</option>
            <option value="20"  <?= $limit === 20  ? 'selected' : '' ?>>20</option>
            <option value="50"  <?= $limit === 50  ? 'selected' : '' ?>>50</option>
            <option value="75"  <?= $limit === 75  ? 'selected' : '' ?>>75</option>
            <option value="100" <?= $limit === 100 ? 'selected' : '' ?>>100</option>
        </select>
        <!-- preserve the sort when changing limit -->
        <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
    </form>

    <!-- 2) SORT BY links -->
    <span class="sortLinksContainer" style="display:inline-block; margin-right: 1rem;">
        <label>Sort by:</label>
        <?php foreach (['ID','Name','Category','Type'] as $opt): ?>
            <a href="?limit=<?= $limit ?>&sort=<?= $opt ?>&page=1" class="sortLink<?= $sort === $opt ? ' active' : '' ?>">
                <?= $opt ?>
            </a>
        <?php endforeach; ?>
    </span>

  <!-- 3) PAGINATION LINKS -->
    <span class="pageNavContainer" style="display:inline-block;">
        <?php if ($page > 1): ?>
            <a href="?limit=<?= $limit ?>&sort=<?= $sort ?>&page=<?= $page - 1 ?>" class="pageButton">&laquo; Previous</a>
        <?php endif; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?limit=<?= $limit ?>&sort=<?= $sort ?>&page=<?= $page + 1 ?>" class="pageButton">Next &raquo;</a>
        <?php endif; ?>
    </span>
</div>

    <?php


    // === ignore: further optimizations are possible =========
//     $query = "SELECT * FROM `dresses`";
    
// if ($result = mysqli_query($db, $query)) {

//     /* fetch associative array */
//     while ($row = mysqli_fetch_assoc($result)) {
//         printf ("%s (%s)\n", $row["name"], $row["image_url"]);
//     }
//     /* free result set */
//     mysqli_free_result($result);
// }



    //=============================================================================
    // Step 3: Now, display the dresses in loop 
    //=============================================================================

    // echo "row count --> " . $row_count;
    // echo "<br>dresses count --> " . $dresses_count;

   // <image class = 'image' src = $pic> </image>
/*?>
   <div id="customerTableView">
   <table class="display" id="ceremoniesTable" style="width:100%">
       <div class="table responsive">
           <thead>
           <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Category</th>
               <th>Type</th>
               <th>State Name </th>
               <th>Status</th>
           </tr>
           </thead> 
           <tbody>
           <div> 
<?php */
    $counter = 0;
    // bootstrap responzive table div wrap
    echo "<div class='table-responsive-lg' id='responsive_table_2'><table id = 'table_2'>";
    while($row = mysqli_fetch_array($res_data)){
        
        if($counter == 0 || $counter % 4 == 0)
        {
            echo '<tr class="row">';
        }

        $dress_id = $row['id'];
        $dress_name = $row['name'];
        $dress_image = $row['image_url'];
        $dress_image_path = "images/dress_images/" . $dress_image;

        echo"<td style='padding:20px'>
                <a href = 'display_the_dress.php?id=$dress_id' title='$dress_name'>
                <img src='$dress_image_path' width='$image_width' height='$image_height'>
                    <div id='title'>$dress_name</div>
                </a>
            </td>";

        $counter++;

        if($counter % 4 == 0) 
        {
            echo '</tr>';
        }
     
    }

    ?>
    </table></div>
    
<!--Data Table -->
<!--<script type="text/javascript" charset="utf8"
        src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script> -->
        <script type="text/javascript" charset="utf8"
        src="https://code.jquery.com/jquery-3.3.1.js"></script> 
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script> 
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


        <script type="text/javascript" language="javascript">
    $(document).ready( function () {
        
        $('#ceremoniesTable').DataTable( {
            dom: 'lfrtBip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
        );

        $('#ceremoniesTable thead tr').clone(true).appendTo( '#ceremoniesTable thead' );
        $('#ceremoniesTable thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            //$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
            /*    if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                } */
            } );
        } ); 
    
        var table = $('#ceremoniesTable').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true 
        } );
        
    } );
</script>
    </div>
    
    <footer class="page-footer text-center">
        <br><p>© Summer 2025 Updated by Team DOLPHIN 🐬</p><br>
    </footer>

</body>

</html>