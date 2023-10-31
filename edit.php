<?php
require "bootstrap.php";
require "config.php";
$data = readDatabaseFile(DB_FILE_PATH);


$email = $_GET['email'];
foreach ($data as $key => $value) {
    
    if($key == $email){
       $item = $value;
       break;
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
        $username = $_POST['username'];
        $emailAdd = $_POST['email'];
        $role = $_POST['select'];
        
       
    
    foreach ($data as $key => $value) {
        
        if($key == $email){
            if(is_array($value)) {  
            
            $data[$email]['role'] = $role;
            $data[$email]['username'] = $username; 
                   
        }else{
            $data[$email] = $emailAdd;
            echo $data[$email];
            echo "masum";
        }
        file_put_contents( 'users.json', json_encode( $data, JSON_PRETTY_PRINT ) );
        }
        }
    } 
    




?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Edit</title>
        </head>
        <body>
        <h1 class = "display-3 text-center"><strong>Edit User Information</strong></h1>
    <div class="container" style="width:50%">        
        <form action="edit.php?email=<?php echo $email; ?>" method ="POST">

  <div class="form-group" >
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name = "username" class="form-control" id="exampleInputEmail1" value="<?php echo $item['username']; ?>">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputPassword1" value="<?php echo $email; ?>" >
    
</div>
  <div class="form-group form-check">
  <select class = "form-select mt-3"name ="select">
    <option value="user">User</option>
    <option value="admin">Admin</option>
    <option value="manager">Manager</option>
  </select>
  </div>
  <button type="submit" name="update" class="btn btn-warning mt-3">Update</button>

</form>
<a href="home_admin.php"> Go Back</a>
</div>
<!-- Section: Design Block -->

        </body>
    </html>