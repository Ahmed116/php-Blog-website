<?php 
require_once("config/config.php");
   

    // create connection
     $con = new mysqli($servername, $username, $password,$dbname);
      $GLOBALS['db'] = $con;
    // Check Connection
    if (!$con){
        die("Connection Failed : " . mysqli_connect_error());
    }

?>
