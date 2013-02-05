<?php
include "message.php";
include "db_config.php";
if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $pwd = $_POST['pwd'];
    $pwd2 = $_POST['pwd2'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $squestion = $_POST['squestion'];
    $sanswer = $_POST['sanswer'];
    $form = false;
    if ($pwd != $pwd2) {
        $message = "The passwords do not match";
    } else {

        $query1 = "SELECT * FROM registration WHERE uname = '" . $uname . "'";
        $res = mysqli_query($con, $query1) or die(mysql_error($con));
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            $message = "Sorry, the username is taken, please try choosing another one";
            mysqli_close($con);
        } else {
            for ($i = 0; $i < 6; $i++) {
                $code .= rand(1, 9);
            }
            $query_insert = "INSERT INTO registration VALUES('0','$name','$email','$uname','$pwd','$squestion','$sanswer','$mobile','$code','0')";
            $res_new = mysqli_query($con, $query_insert) or die(mysqli_error($con));

            //sending message to the mobile
            message($mobile, $code);
            //end of sending message
            $message = "Confirmation code sent to mobile for verification<br/><br/>";
            $message .= "Registration completed successfully";
        }
    }
    ?>
    <html>
    <head>
        <script type="text/javascript" src="js.js"></script>
        <link rel=stylesheet href="style.css" type="text/css" media=screen>
    </head>
    <body>
    <div id="page">
        <div id="header">
        </div>

        <div id="contentarea">
            <?php
            echo "<b><big>$message</big></b>";
            ?>
            <a href="index.php">click here to login</a>
        </div>

        <div id="sidebar">

            <center>Registration details page</center>
        </div>

        <div id="footer">
        </div>

    </div>


    </body>
    </html>
    <?php
} else {
    $form = true;
}
if ($form) {
    ?>


    <html>
    <head>
        <script type="text/javascript" src="js.js"></script>
        <link rel=stylesheet href="style.css" type="text/css" media=screen>
    </head>
    <body>
    <div id="page">
        <div id="header">
        </div>

        <div id="contentarea">
            <center>
                <form id="Register" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <fieldset>
                        <legend>Registration form!!!!</legend>

                        <table cellpadding="2" cellspacing="0" border="0">
                            <tr>
                                <td align="right">User ID:</td>
                                <td align="left"><input name="uname" type="text" id="UserID" size="15"></td>
                            </tr>
                            <tr>
                                <td align="right">Password:</td>
                                <td align="left"><input name="pwd" type="password" id="Password" size="15">
                            </tr>
                            <tr>
                                <td align="right">Enter Again:</td>
                                <td align="left"><input name="pwd2" type="password" id="Password2" size="15"></td>
                            </tr>
                            <tr>
                                <td align="right">Name:</td>
                                <td align="left"><input name="name" type="text" id="Name" size="15"></td>
                            </tr>
                            <tr>
                                <td align="right">E-mail:</td>
                                <td align="left"><input name="email" type="text" id="Email" size="15"></td>
                            </tr>
                            <tr>
                                <td align="right">Mobile No:</td>
                                <td align="left"><input name="mobile" type="text" id="mobile" size="15"></td>
                            </tr>
                            <tr>
                                <td align="right">Secret Question:</td>
                                <td align="left"><input name="squestion" type="text" id="mobile" size="15"></td>
                            </tr>
                            <tr>
                                <td align="right">Secret Answer:</td>
                                <td align="left"><input name="sanswer" type="text" id="sanswer" size="15"></td>
                            </tr>

                        </table>
                        <br/>
                        <table>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="submit" name="submit">
                                    <input type="reset" value="Reset">
                                </td>
                            </tr>
                        </table>
                </form>
            </center>

            </fieldset>
        </div>

        <div id="sidebar">

            <center>Welcome to the registration page. Please enter the details in the fields to the left</center>
        </div>

        <div id="footer">
        </div>

    </div>
    </body>
    </html>
    <?php
}
?>
