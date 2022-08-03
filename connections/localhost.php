<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1); //<---comment this to disable in production
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 $conn = mysqli_connect("localhost","root","x12345678","gallanshop");

if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
