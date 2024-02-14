<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] !== 'POST') 
{
    http_response_code(405);
    echo json_encode(array(
                     'message' => 'Method Not Allowed', 
                     'status' => 'failed'));
      exit;
}

$data=json_decode(file_get_contents("php://input"),true);

$name=$data['name'];
$age=$data['age'];
$city=$data['city'];

include "config.php";

$sql="INSERT INTO students_data (name,age,city) VALUES ('{$name}',{$age},'{$city}')";

$result= mysqli_query($conn, $sql) or die("SQL query failed");

if($result)
{

    echo json_encode(array(
                    'message'=>'Data Inserted Successfully',
                    'status'=>'success'));

}
else
{
    echo json_encode(array(
                    'message'=>'No Inserted Try Again',
                    'status'=>'failed'));
   
}

?>