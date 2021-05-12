<?php
ob_start();
session_start();
include('connections/localhost.php');
?>

<?php include("includes/header.php"); ?>


<?php include("includes/navbar.php"); ?>


<body>
	<h2 class="h-auto"> Product List</h2>
	<?php
	global $localhost;
	if (!isset($_GET['category']) || empty(trim($_GET['category']))) {
		header("location: categories.php");
	} else {

		$category = htmlspecialchars(stripslashes(strip_tags($_GET['category'])));
		$category = mysqli_real_escape_string($localhost, $category);
		
		$_SESSION['category'] = $category; // for later use.

		$query = "SELECT * FROM `products` WHERE category = '$category'";
		$result = mysqli_query($localhost, $query) or die(mysqli_error($localhost));

		$count = mysqli_num_rows($result);
		if ($count == 0) exit("No Products Found of this Category."); ?>
		
		<div class="container-grid">
			<?php
			while ($row = mysqli_fetch_array($result)) {
			?>
				<div class="item-box">
					<!-- START OF single item box -->
					<div> <img src="<?php echo basename('uploads/') . "/" .  $row['product_image']; ?>" width="200" height="200"> </div>
					<div><?php echo $row['productname'] ?> </div>
					<div>
						<p style="color: crimson"><strong><?php echo "CNY " . $row['price'] ?></strong> </p>
					</div>

					<?php
					if (!isset($_SESSION['email'])) {
						//if user is NOT logged in 
						echo '<div><button class="addtocartbtn" onClick="taketoLogin()">Add to Cart<button></div>';
					} else {
					?>
						<div> <a href="addtocart.php?id=<?php echo $row['productID'] ?>"><button class="addtocartbtn">Add to Cart</button></a></div>
					<?php  }  ?>
				</div>
				<!-- END OF single item box -->
		<?php
			}
		}
		?>
		</div>
		</div>


		<br>
		<?php include("includes/footer.php"); ?>
		<br>
		<script type="application/javascript">
			function taketoLogin() {
				//this JS takes someone to Login page if not logged in.
				window.alert("Please login first!");
				window.location.replace("login.php");
			}
		</script>
</br>
</br>
	<?php include("includes/footer.php"); ?>
</body>
</html>