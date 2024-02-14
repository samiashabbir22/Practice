<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] !== 'GET') 
{
    http_response_code(405);
    echo json_encode(array(
                     'message' => 'Method Not Allowed', 
                     'code'=>405,
                     'status' => 'failed'));
      exit;
}


$search_value=isset($_GET['search']) ? $_GET['search'] : die();

include "config.php";

$sql="SELECT * FROM students_data WHERE name LIKE '%{$search_value}%'";

$result= mysqli_query($conn, $sql) or die("SQL query failed");

if(mysqli_num_rows($result)>0)
{
 
      $output= mysqli_fetch_all($result, MYSQLI_ASSOC);
      echo json_encode(array(
                       'status'=>'success',
                       'code'=>200,
                       'message'=>'Data Fectched Successfully',
                       'data'=>$output));
}
else
{
       echo json_encode(array(
                       'message'=>'No Data Fetched, Try Again!',
                       'code'=>204,
                       'status'=>'failed'));
   
}

?>