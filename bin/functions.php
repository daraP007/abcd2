<script type="text/javascript">


//**************************** ToggleView **********************************
//Function: Used to toggle between the table and grid view
//Pre Condition: TableView is display and Grid is hidden. ID of the button
//               clicked
//Post Condition: The display coorisponding with which button was clicked is
//                visible. The other is hiddent.
//***************************************************************************
function toggleview(id){
var show = document.getElementById(id);

  if (id == 'customerTableView'){
    show.style.display = 'block'
    var hide = document.getElementById('gridView')
    hide.style.display = 'none'
  }//end if

  else{
    show.style.display = 'block'
    var hide = document.getElementById('customerTableView')
    hide.style.display = 'none'
  }//end else
}//end toggleview
//**************************** end toggleview *******************************

//************************* addBookFields ***********************************
//Function:
//Pre Condition:
//Post Condition:
//***************************************************************************
function displayBookFields(id){
var divElement = document.getElementById(id);

  if ( divElement.style.display == 'none')
    divElement.style.display = 'block'

  else
    divElement.style.display = 'none'
}//end addBookFields
//**************************** end toggleview *******************************
</script>
<?php
function verifyLogin($page){
  if(isset($_SESSION['role'])) {
    return;          
  } else{
    echo '<script>window.location.href = "loginForm.php";</script>';
    // header('Location: loginForm.php'); // old version does not work since headers already set
    exit();
  }
}
?>
