<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
{
    http_response_code(405);
    echo json_encode(array(
                     'message' => 'Method Not Allowed', 
                     'status' => 'failed'));
      exit;
}

$data=json_decode(file_get_contents("php://input"),true);

$student_id=$data['sid'];

include "config.php";

$sql="SELECT * FROM students_data WHERE id={$student_id}";

$result= mysqli_query($conn, $sql) or die("SQL query failed");

if(mysqli_num_rows($result)>0)
{

    $output= mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);

}
else
{
   echo json_encode(array(
                   'message'=>'No Record Found',
                   'status'=>'failed'));
   
}
?>