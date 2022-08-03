<?php
ob_start();
session_start();

include("Connections/localhost.php");
global $conn;
if (!isset($_SESSION['email']) || !isset($_SESSION['totalCost']) || (int)$_SESSION['totalCost'] <= 0) {
	//KICK USER OUT OF THIS PAGE
	exit("<script>window.location.replace('categories.php')</script>");
}

$customeremail = mysqli_real_escape_string($conn, $_SESSION['email']);
$totalCost = mysqli_real_escape_string($conn, $_SESSION['totalCost']);

//first select all stuff in Cart Table 
$selectQuery = "SELECT * FROM `cart` WHERE `customer_email` = '$customeremail'";

$result = mysqli_query($conn, $selectQuery) or die("Database error " . mysqli_error($conn));

while ($row = mysqli_fetch_array($result)) {

	$product_ID = $row['product_id'];

	$insertQuery = "INSERT INTO `orders`( `product_id`, `customer_email`, `date_added`) VALUES ('$product_ID', '$customeremail', NOW())";
	mysqli_query($conn, $insertQuery) or die("Error" . mysqli_error($conn));
}

if (!mysqli_errno($conn)) {
	//order has been placed successfully.
	//NOW CLEAR THE CART FOR CURRENT USER
	$deletequery = "DELETE FROM `cart` WHERE `customer_email` = '$customeremail'";
	mysqli_query($conn, $deletequery) or die("error two: " . mysqli_error($conn));
	//THEN UNSET TOTALCOST
	unset($_SESSION['totalCost']);
	echo "<script>alert('Order has been placed!')</script>";
	echo "<script>window.location.replace('index.php')</script>";
}
