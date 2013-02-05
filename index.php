<?php
session_start();
include "message.php";
require "db_config.php";
include "redirect.php";
include "random_gen.php";
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>login page</title>
    <script src="js/jquery-latest.js"></script>
    <script type="text/javascript" src="js.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <link rel=stylesheet href="style.css" type="text/css" media=screen>
    <script>
        $(document).ready(function () {

            $.validator.addMethod("mobile", function (value, element) {
                return this.optional(element) || /^[0-9\-\+]+$/i.test(value);
            }, "Phone must contain only numbers, + and -.");

            $("#login").validate();
        });
    </script>
</head>
<body>
<div id="page">
    <div id="header">
    </div>

    <div id="contentarea">
    </div>

    <div id="sidebar">
        <center>login here!!!!<br/><br/></center>
        <center>
            <?php
            if (isset($_SESSION['mobile']))
            {
                redirect("home.php");
            }
            else
            {
            if (isset($_POST['submit'])) {
                $flag = true;
                $username = $_POST['uid'];
                $password = $_POST['password'];
                $pass = $password;
                $q = "SELECT * FROM registration WHERE mobile = '$username' AND pass = '$pass'";
                $r = mysqli_query($con, $q);
                if (mysqli_num_rows($r) == 0) {
                    $flag = false;
                    echo "<span class = \"red\">invalid username/password</span>";
                } else {
                    $row = mysqli_fetch_array($r);
                    $uname = $row['uname'];
                    $mob = $row['mobile'];
                    $_SESSION['username'] = $uname;
                    $_SESSION['mobile'] = $mob;
                    $verify = $row['verification'];
                    if (!$verify) {
                        redirect("verify.php");
                    } else {
                        $chk = $row['reset'];
                        if ($chk) {
                            redirect("reset.php");
                            echo "password has been changed";
                        } else {
                            if (isset($_POST['reset'])) {
                                echo "reset checked so pass changed";
                                $pass_new = random();
                                $que_update = "UPDATE `registration` SET pass = '$pass_new', reset = '1' WHERE mobile = '$username'";
                                $r_update = mysqli_query($con, $que_update) or die(mysqli_error($con));
                                /*send message to mobile*/
                                message($row['mobile'], $pass_new);
                            }
                            redirect("home.php");
                        }
                    }
                }
            } else {
                $flag = false;
            }
            if (!$flag)
            {

            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="login" id="login" method="POST"
                  onsubmit="return validate();">
                <table>
                    <tr>
                        <td align="right"> User Name :</td>
                        <td align="left"><input name="uid" id="uid" type="text" class="required" minlength="4"/></td>
                    </tr>
                    <tr>
                        <td align="right"> Password :</td>
                        <td align="left"><input name="password" id="password" class="required" type="password"/></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="reset" id="reset"/> check here for dynamic password
                            reset
                        </td>
                    </tr>
                </table>
                <br/>
                <a href="register.php">Not registered yet??? Click here</a>
                <table>
                    <tr>
                        <td><input type="submit" name="submit" value="submit"/></td>
                        <td align="left"><input type="reset" value="clear fields" name="submit"></td>
                    </tr>
                </table>
        </center>
        </form>
        <?php
        }

        }
        ?>
    </div>
    <div id="footer">
    </div>
</div>
</body>
</html> 
