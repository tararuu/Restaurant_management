<?php
    //Start session
    session_start();
    
    //checking connection and connecting to a database
    require_once('connection/config.php');
    //Connect to mysqli server
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
    if(!$conn) {
        die('Failed to connect to server: ' . mysqli_error());
    }
    
   
    
    //Function to sanitize values received from the form. Prevents SQL injection
    function clean($str) {
global $conn;
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return mysqli_real_escape_string($conn,$str);
    }
    
    // check if Delete is set in POST
     if (isset($_POST['Delete'])){
         // get id value of partyhall and Sanitize the POST value
         $partyhall_id = clean($_POST['partyhall']);
         
         // delete the entry
         $result = mysqli_query($conn,"DELETE FROM partyhalls WHERE partyhall_id='$partyhall_id'")
         or die("There was a problem while deleting the partyhall ... \n" . mysqli_error()); 
         
         // redirect back to options
         header("Location: options.php");
     }
     
         else
            // if id isn't set, redirect back to options
         {
            header("Location: options.php");
         }
?>