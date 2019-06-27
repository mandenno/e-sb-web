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

$phone = $_POST["user_phone"];
$password = $_POST["password"];
$token = $_POST["token"];
$attempts = $_POST["attempts"];

 $sqlx = "UPDATE users SET device_id='$token' WHERE user_phone='$phone'";
     mysqli_query($conn,$sqlx); 
     
$duplicate_check_sql = "SELECT * FROM users where device_id = '$token' and status !='blocked'";
$suplicate_result = $conn->query($duplicate_check_sql);

if ($suplicate_result->num_rows > 0) {
    
$duplicate_check_sql = "SELECT * FROM users where user_phone = '$phone' and password='$password' and status !='blocked'";
$suplicate_result = $conn->query($duplicate_check_sql);

if ($suplicate_result->num_rows > 0) {
echo"success";
   
}else{
    if($attempts>4)
    {
    $sqlx = "UPDATE users SET status='blocked' WHERE device_id='$token'";
     mysqli_query($conn,$sqlx); 
     echo"blocked";
     
     	    $to = "denonkangi@gmail.com";
$subject = "Account blocked";
$txt = "An account has been blocked due to too many login attempts. Kindly checkout!\r\n
Thank you!";
$headers = "From: info@nupola.com" . "\r\n";

mail($to,$subject,$txt,$headers);
    }
    else
    {
 echo"failed";   
 
	}
}
}
else
{
 echo"does-not-exist";    
}

	

mysqli_close($conn);

?>