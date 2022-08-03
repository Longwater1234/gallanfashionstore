<?php
ob_start();
session_start();

include("Connections/localhost.php");
global $conn;
if (!isset($_GET['id']) || !isset($_SESSION['email']) || empty(trim($_GET['id']))) {
	header("location:categoryview.php");
} else {

	$categoryName = $_SESSION['category']; // for taking us back to exact category page.

	$product_id = htmlspecialchars(stripslashes(trim($_GET['id'])));
	$product_id = mysqli_real_escape_string($conn, $product_id);
	$customeremail = mysqli_real_escape_string($conn, $_SESSION['email']);

	//first check if it already exists in database 

	$checkQuery = "SELECT `customer_email`, `product_id` FROM `cart` WHERE `customer_email` = '$customeremail' AND `product_id` = '$product_id'";

	$result = mysqli_query($conn, $checkQuery) or die("DAtabase error " . mysqli_error($conn));

	$count = mysqli_num_rows($result);
	if ($count > 0) {
		// Item was already in cart. Please note, We can only add ONE item ONLY once.
		//So STOP here, take us back!
		echo "<script>alert('SORRY! ITEM ALREADY EXISTS IN CART!')</script>";
		echo "<script>window.location.replace('cart.php')</script>";
		exit;
	} else {
		// Add it to the cart
		$query = "INSERT INTO `cart`( `customer_email`, `product_id`, `date_added`) VALUES ('$customeremail','$product_id', NOW())";

		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		if ($result === TRUE) {
			echo "<script>alert('Success! Item Added to Cart!')</script>";
			echo "<script>window.location.replace('categoryview.php?category=$categoryName')</script>";
		}
	}
}
