<?php

define("BASE_URL","http://localhost:8080");
define("DB_FILE_PATH","/Applications/XAMPP/xamppfiles/htdocs/MD5/users.json");
//reading the data from file:
function readDatabaseFile($filepath)
{
    if(file_exists($filepath)&& is_readable($filepath)){
        $data = json_decode(file_get_contents($filepath), true)??[];
        return $data;
    }else{
        throw new Exception("Database is not accessible");
    }
}
//validate and sanitize the data:
function validatedInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//functon to find data by email;
function findDataByEmail($data, $email)
{
    foreach($data as $key){
        if($key == $email){
            return $key;
        }else{
            return null;
        }
    }
}
//function to find data by role;
function findDataByRole($data, $role)
{
    foreach($data as $key => $item){
        if($item["role"] == $role){
            return $item;
         }else{
        return null;
         }
    }
}
function isAdmin(){
    return('admin'==$_SESSION['role']);
}
function saveUsers($users,$file){
    file_put_contents( $file, json_encode( $users, JSON_PRETTY_PRINT ) );
    if(file_put_contents($file,json_encode( $users, JSON_PRETTY_PRINT ) )){
        echo 'Updated Successfully';
    }else{
        echo 'Registration failed';
    }
}
function writeDatabaseFile($filePath, $data)
{
    // if (file_exists($filePath) && is_writable($filePath)) {
    //     file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));
    // } else {
    //     throw new Exception('Database file is not writable.');
    // }

    file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));
}
function showErrorMessage($message){
    echo ''. $message .'';
}
?>