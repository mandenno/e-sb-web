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

$user_phone = $_POST["user_phone"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];

$bus_no =$_POST["bus_no"];
//$qr_code =$_POST["qr_code"];
//$qr_url = 'http://www.example.com/5478631';
$qr_code = $_POST["qr_code"];
//$qr_code = substr($qr_url, strrpos($qr_url, '=' )+1)."\n";

//$userToken =$_POST["userToken"];
$case_no=rand(10000,100000);

$court_days='7';
$vcode=rand(1000,10000);


				//	$Date = Date();
				 $court_date= "2019-09-25";
               // $court_date= date('Y-m-d', strtotime($Date. ' + '.$court_days.' days'));
            

$duplicate_check_sql = "SELECT * FROM business_account where permit_no = '$bus_no' and qr_code='$qr_code'";
$suplicate_result = $conn->query($duplicate_check_sql);

if ($suplicate_result->num_rows > 0) {
    
$sqlp = "INSERT INTO activities (user_phone, activity_type, lat, lng, case_no, bus_no, qr_code, bus_name, fine, court_date) VALUES ('$user_phone', 'valid', '$lat', '$lng', '000', '$bus_no', '$qr_code', '$bus_name', '', '')";

	mysqli_query($conn, $sqlp);
	    
$sqlx = "SELECT * FROM business_account WHERE qr_code='$qr_code'";

$ress=mysqli_query($conn, $sqlx);
$rows=mysqli_fetch_array($ress);

	 $results = array();
    array_push($results,
array('busines_name'=>$rows['bus_name'],
'permit_no'=>$rows['permit_no'],
'cert_no'=>$rows['cert_no'],
'plot_no'=>$rows['plot_no'],
'amount_paid'=>number_format($rows['amount_paid']),
'date_issues'=>$rows['date_of_issue'],
'date_expiry'=>$rows['date_of_expiry'],
'image_url'=>$rows['image_url'],
'response'=>"right",
    'bus_location'=>$rows['bus_loc']
));
echo json_encode($results);

   
}
else
{
    
 
	$sql = "INSERT INTO activities (user_phone, activity_type, lat, lng, case_no, bus_no, qr_code, bus_name, fine, court_date) VALUES ('$user_phone', 'case', '$lat', '$lng', '$case_no', '$bus_no', '$qr_code', '$bus_name', '4500', '$court_date')";

	if (mysqli_query($conn, $sql)) {
	    
	 $result = array();
    array_push($result,
array('case_no'=>$case_no,
'response'=>"wrong",
    'court_date'=>$court_date
));
echo json_encode($result);

	    
	    $to = "alysalim1981@gmail.com";
$subject = "Lodged Case : No ".$case_no;
$txt = "A new business permit case has been lodged!\r\nBusiness No: $bus_no \r\nLocation: $lat, $lng\r\n 
Thank you!";
$headers = "From: info@nupola.com" . "\r\n";

mail($to,$subject,$txt,$headers);

	} else {
  echo"error";
	}
}
	

mysqli_close($conn);

?>