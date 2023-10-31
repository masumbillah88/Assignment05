<?php
session_start();
require "bootstrap.php";
require "config.php";

if (!isset($_SESSION["role"]) || $_SESSION["role"]!='admin') {
        header('Location:login.php');
}
$data = readDatabaseFile(DB_FILE_PATH);



  
    


?>
<!DOCTYPE html>
    <html>
        <title>Login</title>
        <head>

        </head>
        <body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-warning text-white">
  <a class="navbar-brand" href="#">Admin Panel |</a>
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
<ul class="nav flex-column bg-dark" style="width:15%;height:100%">
  <li class="nav-item text-white">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item text-white">
    <a class="nav-link" href="#">Manage User</a>
  </li>
  <li class="nav-item text-white">
    <a class="nav-link" href="#">Role Management</a>
  </li>
  <li class="nav-item text-white">
    <a class="nav-link" href="#">Contact us</a>
  </li>
  <li class="nav-item text-white">
    <a class="nav-link" href="logout.php">Logut</a>
  </li>
  <li class="nav-item text-white">
    <a class="nav-link" href="#">FAQ</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled"></a>
  </li>
</ul>
    <div class = "container" style="margin-left:250px; margin-top:-800px">     
    <h1 class = "display-1 text-success">Welcome! <br><strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></strong></h1>

            <h6 class = "display-6 text-success"> <strong>You have logged in as <?php echo strtoupper($_SESSION['role']); ?></strong> </h6>
    </div>
    
    <div class="container">
      <table class="table" style="margin-left:170px;width:960px;">
        <tr>
          <th class="table-info text-gray">Username</th>
          <th class="table-info">Email</th>
          <th class="table-info">Role</th>
          <th class="table-info"></th>
          <th class="table-info">Action</th>
        </tr>
        <?php  foreach ($data as $key => $item) {
        ?>
        <tr>
          <td class="table-secondary"><?php echo $item['username'] ?></td>
          <td class="table-secondary"><?php echo $key; ?></td>
          <td class="table-secondary"><?php echo $item['role']; ?></td>
          <td class="table-secondary"><a href="edit.php?email=<?php echo $key;?>">Edit</a></td>
          <td class="table-secondary"><a href="delete.php">Delete</a></td>
        </tr>
        <?php }?>
      </table>
  
    </div>
</div>

        </body>
    </html>