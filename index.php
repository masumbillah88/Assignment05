<?php
session_start();
require "config.php";
require "bootstrap.php";

if (!isset($_SESSION["loggedin"])) {
    header("Location: login.php");
    
}

 if ($_SESSION["role"]=="user") {
     header("Location: home_user.php");
 }else if ($_SESSION["role"]== "admin") {
    header("Location: home_admin.php");
 }else if ($_SESSION["role"]== "manager") {
    header("Location: home_manager.php");
 }
echo showErrorMessage("$errorMessage");

?>
<z!DOCTYPE html>
    <html>
        <title>Login</title>
        <head>

        </head>
        <body>
            <h1 class = "display-1 text-success">Welcome! <?php echo $_SESSION['email'];?></h1>

            <h6 class = "display-6"><a href="logout.php">logout</a> </h6>

        </body>
    </html>