<?php
session_start();
include "message.php";
require "db_config.php";
include "redirect.php";
if (isset($_SESSION['mobile'])) {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        <title>verification page</title>
        <link rel=stylesheet href="style.css" type="text/css" media=screen>
        <style type="text/css">
            * {
                font-family: Verdana;
                font-size: 96%;
            }

            label {
                width: 10em;
                float: left;
            }

            .error {
                float: none;
                color: red;
                padding-left: .5em;
                vertical-align: top;
            }

            span.red {
                color: red;
                font-weight: bold
            }

            p {
                clear: both;
            }

            .submit {
                margin-left: 12em;
            }

            em {
                font-weight: bold;
                padding-right: 1em;
                vertical-align: top;
            }
        </style>
    </head>
<body>
<div id="page">
    <div id="header">
    </div>

    <div id="contentarea">
    </div>

    <div id="sidebar">
    <center>
    <?php
    $mob = $_SESSION['mobile'];
    $query = "SELECT * FROM registration WHERE mobile = '$mob'";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_array($res);
    $verification = $row['verification'];
    if (!$verification) {
        if (isset($_POST['verify'])) {
            $code = $_POST['code'];
            $form = false;
            $check = $row['code'];
            if ($code == $check) {
                $que = "UPDATE `registration` SET verification = '1' WHERE mobile = '$mob'";
                $res1 = mysqli_query($con, $que);
                echo "mobile successfully verified";
                redirect("home.php");
            } else {
                echo "<span class = \"red \">invalid code entered</span><br/>\n";
                $form = true;
            }
        } else {
            $form = true;
        }
        if ($form) {
            ?>
            Enter the code received on mobile<br/><br/>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                Code :<input type="text" name="code">
                <input type="submit" value="verify!!!" name="verify">
            </center>
            </div>
            <div id="footer">
            </div>
            </div>
            </body>
            </html>
            <?php
        }
    } else {
        redirect("home.php");
    }
} else {
    redirect("index.php");
}
?>
