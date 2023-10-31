<?php

session_start();

$usersFile = '/Applications/XAMPP/xamppfiles/htdocs/MD5/users.json';

$users = file_exists($usersFile)? json_decode(file_get_contents($usersFile),true):array();
function saveUsers($users,$file){
file_put_contents( $file, json_encode( $users, JSON_PRETTY_PRINT ) );
if(file_put_contents($file,json_encode( $users, JSON_PRETTY_PRINT ) )){
    echo 'Successfully Registered';
}else{
    echo 'Registration failed';
}
 

}
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    
   // echo $firstname,$lastname;
    if(empty($username) || empty($password)||empty($email) || empty($firstname) || empty($lastname)){
        $errorMessage = "Please fill the all fields"; 

}else{
    if(isset($users[$email])){
        $errorMessage = "Email already exists";
    }else{
        $users[$email] = [
            "username"=> $username,
            "password"=> $password,
            "firstname"=>$firstname, 
            "lastname"=>$lastname, 
            "role"=> "user"
        ];
        //print_r($users);
        saveUsers($users,$usersFile);
        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['username'] = $username;
        header('Location:login.php');
//$_SESSION['firstname'] = $firstname;


        }
    }
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>User Registration and Login</title>
    <?php
include 'bootstrap.php';
?>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <h3 class="text-center mb-4">User Role Management App</h3>
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between">
                        <h3>User Registration</h3>
                        <a href="login.php" class="btn btn-info text-white">
                            Already have an account?
                        </a>
                    </div>
                    <div class="card-body">
                        <?php

if ( isset( $errorMessage ) ) {
    echo "<p>$errorMessage</p>";
    
}

?>
                        <form action = "register.php" class="form" method="POST">
                            <input class="form-control" type="text" name="username" placeholder="Username"><br>
                            <input class="form-control" type="text" name="firstname" placeholder="Firstname"><br>
                            <input class="form-control" type="text" name="lastname" placeholder="Lastname"><br>
                            <input class="form-control" type="email" name="email" placeholder="Email"><br>
                            <input class="form-control" type="password" name="password" placeholder="Password"><br>
                            <input type="hidden" name="role" value="">
                            <input class="btn btn-primary" type="submit" name="register" value="Register">
                          
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>