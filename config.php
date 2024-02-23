<?php
$conn=mysqli_connect("172.16.238.12","root","","students");

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
?>