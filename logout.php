<?php
session_start();
include "redirect.php";
?>
<?php
session_destroy();
redirect("index.php");
?>

