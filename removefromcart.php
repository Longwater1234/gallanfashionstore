<?php
ob_start();
session_start();
include( "Connections/localhost.php" );
global $localhost;
if (!isset( $_GET['del']) || !isset($_SESSION['email']) || empty(trim($_GET[ 'del' ]))) {
	header("location:cart.php");
} else {
	
	$customeremail = $_SESSION['email'];
		
	$cart_id = htmlspecialchars( stripslashes(trim( $_GET['del'])));
	$cart_id = mysqli_real_escape_string( $localhost, $cart_id );
	$customeremail = mysqli_real_escape_string( $localhost, $_SESSION['email'] );
	
	$removeQuery = "DELETE FROM `cart` WHERE `customer_email`= '$customeremail' AND `cart_id`='$cart_id'";
	
	$result = mysqli_query($localhost, $removeQuery) or die(mysqli_error($localhost));

	if($result === TRUE){
		echo "<script>alert('Item has been removed from Cart!')</script>";
		echo "<script>window.location.replace('cart.php')</script>";
		
	}

}



