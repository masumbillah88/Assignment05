<?php

    session_start();
    require "config.php";
    //check if the user is already logged in.
    if (isset($_SESSION["loggedin"])){
      header("Location:" . BASE_URL);
      exit();
    }
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login']))
    {
      try {
        $email = validatedInput($_POST['email']);
        $password = validatedInput($_POST['password']);
        
        // echo $email;
        // echo $password;
        if(empty($email) || empty($password)){
          throw new Exception('Both Email and password are required');
          
        }
        //validate the email format:
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          throw new Exception('Email is invalid');
        }
        //read data from the databse file:
        $data = readDatabaseFile(DB_FILE_PATH);
        //print_r($data);
        
        //check if the provided credentials match the any user in Database:
        foreach($data as $key => $item)
        {
          
          if(isset($key) && $item['password'] == $password){
          if($email == $key && $password == $item['password']){
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $item['role'];
            $_SESSION['firstname'] = $item['firstname'];
            $_SESSION['lastname'] = $item['lastname'];
            
          if($_SESSION['role']=='admin'){
              header('Location:'. BASE_URL .'/home_admin.php');
            }else if ($_SESSION['role']== 'user'){
              header('Location:'. BASE_URL.'/home_user.php');
            }else if ($_SESSION['role']== 'manager'){
              header('Location:'. BASE_URL.'/home_manager.php');
            }
            exit();
          }
          
        }
      }
      //If no match found throw an exception error message;
      throw new Exception('Email or Password is incorrect');
    }catch(Exception $e){}
    $errorMessage = $e->getMessage();
  }   

    
  ?>

          
    

   


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<style>
    .container{ width:50%;
        height: 370px;
        border: solid 1px gray;
        box-shadow: 0.5px 0px 1px 0px;
        padding: 10px 15px;
    }
</style>  
</head>
  <body>
    <h1 class = "text-center mt-3">Log in to your account</h1>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

<div class="container mt-5">
<form action="login.php" method ="POST">
  <?php if(isset($errorMessage)){echo $errorMessage;} ?>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name = "email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name ="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" name ="check" for="exampleCheck1">Remember me</label>
  </div>
  <p class="text-warning">           </p>
  <button type="submit" name="login" class="btn btn-warning">Login</button>
</form>
<p class="text-primary">Don't have an account?</p><a href="register.php">Please Sign up</a>
</div>
</body>
</html>