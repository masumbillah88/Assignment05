<?php

require "bootstrap.php";
require "config.php";


try{    $data = readDatabaseFile(DB_FILE_PATH);



foreach ($data as $key => $value) {
    
    if($key){
       unset($data[$key]);
       break;
    }
}

writeDatabaseFile(DB_FILE_PATH, $data);
$successMessage = 'Delete Successfully.';
    header("Location: " . BASE_URL . "/index.php?success=" . urlencode($successMessage));
    exit();

}catch(Exception $e){
    $errorMessage = $e->getMessage();
}
showErrorMessage($errorMessage);
        
       
    
    
        
        
    




?>