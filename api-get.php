<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include "config.php";

$sql="SELECT * FROM students_data";

$result= mysqli_query($conn, $sql);
if (!$result) {
  $error_message = "SQL query failed: " . mysqli_error($conn);
  var_dump(mysqli_error($conn));
}

if(mysqli_num_rows($result)>0)
{
  $output= mysqli_fetch_all($result, MYSQLI_ASSOC);

     echo json_encode(array(
                      'message'=>'No Record Found',
                      'status'=>'success',
                      'data'=>$output)
    );
}
else
{
  echo json_encode(array(
                   'message'=>'No Record Found',
                   'status'=>'failed'));
   
}

?>