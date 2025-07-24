<?php

ob_start();
session_start();

require 'bin/functions.php';
require 'db_configuration.php';

ob_end_flush();

?>

<!DOCTYPE html>
<body>
<?php

echo $_SESSION["id"];

?>
</body>



