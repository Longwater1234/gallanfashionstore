<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 $localhost=mysqli_connect("localhost","root","","gallanshop");

if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
} 
?>