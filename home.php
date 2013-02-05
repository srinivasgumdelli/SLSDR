<?php
session_start();
include "redirect.php";
include "db_config.php";
if (isset($_SESSION['mobile'])) {
    $mob = $_SESSION['mobile'];
    $query = "SELECT * FROM registration WHERE mobile = '$mob'";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_array($res);
    $name = $row['uname'];
    $verification = $row['verification'];
    if (!$verification) {
        redirect("verify.php");
    }
    $flag = true;
} else {
    $flag = false;
}
if ($flag) {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        <title>Home Page</title>
        <link rel=stylesheet href="style.css" type="text/css" media=screen>
    </head>
    <body>
    <div id="page">
        <div id="header">
        </div>

        <div id="contentarea">
            <?php echo "Welcome $name"; ?>
        </div>
        <div id="sidebar">
            <center>
                <a href="logout.php">logout</a>
            </center>
    </body>
    </html>
    <?php
} else {
    redirect("index.php");
}
?>

