<?php

session_start();

include("include_connection.php");

if(isset($_POST['submit'])){
    login();
}

?>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h3 align="center">Login Page</h3>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <table align="center"  border="0" cellpadding= 5 cellspacing = 0>
                <tr>
                    <td>Username</td>
                    <td><input name="login_un" type="text" placeHolder="Username" /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input name="login_pw" type="password" placeHolder="Password"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Submit" name="submit"/>
                        <p>
                            <?php 
                                
                                if(isset($_GET['error'])){
                                    $err_msg = $_GET['error'];
                                    echo $err_msg;
                                }
                                    
                            ?>
                        </p>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>