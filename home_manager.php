<?php
session_start();
require "bootstrap.php";
if (!isset($_SESSION["role"]) || $_SESSION["role"]!='manager') {
    header('Location:login.php');
}

?>
<!DOCTYPE html>
    <html>
        <title>Login</title>
        <head>

        </head>
        <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning text-white">
  <a class="navbar-brand" href="#">User Panel |</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-black" href="#">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-black" href="#">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-black" href="logout.php"><img style="width:25px;height:25px;"src="baseline_logout_black_24dp.png">Logout</a>
      </li>
      
    
  </div>
</nav>
            <h1 class = "display-1 text-success">Welcome! <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></h1>
            

            <h6 class = "display-6 text-success"> <strong>You have logged in as <?php echo strtoupper($_SESSION['role']); ?></strong> </h6>

        </body>
    </html>