<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] !== 'DELETE') 
{
    http_response_code(405);
    echo json_encode(array(
                     'message' => 'Method Not Allowed', 
                     'status' => 'failed'));
      exit;
}

$data=json_decode(file_get_contents("php://input"),true);

$id=$data['id'];

include "config.php";

$sql="DELETE * FROM students_data WHERE id='{$id}'";

$result= mysqli_query($conn, $sql) or die("SQL query failed");

if($result)
{

    echo json_encode(array(
                    'message'=>'Data Deleted Successfully',
                    'code'=>200,
                    'status'=>'success'));

}
else
{
    echo json_encode(array(
                    'message'=>'No Data Deleted, Try Again!',
                    'code'=>200,
                    'status'=>'failed'));
   
}

?>