<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] !== 'PUT') 
{
    http_response_code(405);
    echo json_encode(array(
                     'message' => 'Method Not Allowed', 
                     'status' => 'failed'));
      exit;
}

$data=json_decode(file_get_contents("php://input"),true);

$id=$data['id'];
$name=$data['name'];
$age=$data['age'];
$city=$data['city'];

include "config.php";

if(isset($data['name']) && !empty($data['name']) OR 
   isset($data['age']) && !empty($data['age']) OR 
   isset($data['city']) && !empty($data['city']))
   {

    $sql="UPDATE students_data SET name='{$name}',age={$age},city='{$city}' WHERE id='{$id}'";

    $result= mysqli_query($conn, $sql) or die("SQL query failed");
    
    if($result)
    {
    
        echo json_encode(array(
                        'message'=>'Data Updated Successfully',
                        'status'=>'success'));
    
    }
    else
    {
        echo json_encode(array(
                        'message'=>'No Data Updated, Try Again!',
                        'status'=>'failed'));
       
    }

   }
    else
   {

    echo json_encode(array(
        'message'=>'Incomplete params , Try Again!',
        'status'=>'failed'));

   }



?>