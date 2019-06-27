<?php

$servername = "localhost";
$username = "fastagas_deno";
$password = "mandenno@123";
$dbname = "fastagas_swahilibox";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$case_no = $_POST["case_no"];
$court_date = $_POST["court_date"];
$bus_name = $_POST["bus_name"];
$desc = "Business Name: ".$bus_name."\r\nCourt Date:$court_date.\r\n".$_POST["desc"]."\r\n";



 
    $sqlx = "UPDATE lodged_cases SET bus_name='$desc' WHERE case_no='$case_no'";
     if(mysqli_query($conn,$sqlx))
     {
       echo"success";  
     }
     
     else
     {
      echo"failed";     
     }
     




	

mysqli_close($conn);

?>