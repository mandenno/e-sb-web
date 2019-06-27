<?php

$con = mysqli_connect("localhost","fastagas_deno","mandenno@123","fastagas_swahilibox");
$phone=$_GET['phone'];

$sql = "SELECT * from activities where user_phone=$phone order by id desc limit 0,6"; 
          
$res = mysqli_query($con,$sql);
$count=mysqli_num_rows($res);
if($count>0)
{
    
$result = array();  
 
while($row = mysqli_fetch_array($res)){
    
  
    
    array_push($result,
array('id'=>$row['id'],
    'activity_type'=>$row['activity_type'],
    'bus_no'=>ucwords($row['activity_type']).": ".$row['bus_no'],
    'bus_name'=>$row['bus_name'],
    'reg_date'=>$row['reg_date'],

'image'=>"http://ec.europa.eu/environment/waste/reporting/images/173649127.jpg"
));

}
echo json_encode($result);
}
else
{
    $result = array();
    array_push($result,
array('id'=>'',
    'activity_type'=>'',
    'bus_no'=>'You have not verified any business permits so far.',
    'bus_name'=>'No records to display!',
    'reg_date'=>'',
'image'=>"https://demarillac.org/wp-content/uploads/2016/08/male.jpg"
));
echo json_encode($result);
}
 
mysqli_close($con);


 
?>