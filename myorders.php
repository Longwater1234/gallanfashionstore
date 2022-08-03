<?php
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
	echo "<script>alert('Please login first!') </script>";
	echo "<script>open('login.php', '_self') </script>";
}
include('connections/localhost.php');

?>

<?php include("includes/header.php"); ?>


<?php include("includes/navbar.php"); ?>

<body>
<body>
	<h2 class="h-auto">My Orders</h2>
	<?php
	
	$customeremail = mysqli_real_escape_string( $conn, $_SESSION[ 'email' ] );
	$query = "SELECT * \n"
    . "FROM `orders` \n"
    . "INNER JOIN `products` ON orders.product_id = products.productID AND orders.customer_email = '$customeremail' \n"
	. "ORDER BY `date_added` DESC";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	
	$count = mysqli_num_rows($result);
	if ($count == 0) exit('<p align="center"> You have not ordered yet! </p>'); 
	
	//calculate number of items in cart
	$x = 0;
	for( $x=0; $x < $count; ++$x){
		$x =+ $x; 
	}
	?>
	<div class="container-down">
			<?php
			date_default_timezone_set('Asia/Shanghai'); //change this according to your location
			while ($row = mysqli_fetch_array($result)) {
				
			?>
				<div class="item-box-row">
					<!-- START OF single item box -->
					<div> <img src="<?php echo basename('uploads/') . "/" .  $row['product_image']; ?>" width="200" height="200"> </div>
					<div> <p><?php echo $row['productname'] ?> </p>
						<p style="color: crimson"><strong><?php echo "PAID CNY " . $row['price'] ?></strong> </p>
						<p style="color: darkgreen">Ordered on:  <?php echo date_format(new DateTime($row['date_added']), "Y-M-d H:i")  ?></p>
					</div>
					
				</div>
				<!-- END OF single item box -->
		<?php
			}
		?>
		</div>
		<br> 
		<hr>

		<hr>
</br>
</br>
	<?php include("includes/footer.php"); ?>
</body>
</html>