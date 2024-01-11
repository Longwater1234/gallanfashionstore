<?php include('connections/localhost.php') ?>

<nav class="navbar">
	<a title="Home" href="index.php"><strong>Home</strong> </a>
	<a title="Categories" href="categories.php"><strong>Categories</strong></a>
	<a title="Contact Us" href="contact.php"><strong>Contact Us</strong></a>

	<?php
	if (isset($_SESSION['email'])) {
		// if user is LOGGED IN.
		// if user is LOGGED IN.
		$email = mysqli_real_escape_string($conn,  $_SESSION['email']);
		$query = "SELECT COUNT(*) AS count FROM `cart` WHERE `customer_email`='$email'";
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		$cartCount = (int) mysqli_fetch_assoc($result)["count"];

		echo '<a href="myaccount.php"><strong>My Account</strong></a>';
	?>
		<a class="cart-icon" href="cart.php">
			<img src="shopping-cart-icon.png">
			<strong>Cart (<?= $cartCount ?>)</strong>
		</a>
	<?php

		echo '<br> <br> <p class="wow">Logged in as: ' . $email . '</p>';
	} else {
		//if  NOT logged in
		echo '<a href="login.php" title="login"><strong>Log In</strong></a>';

		echo '<a title="Cart" onClick="loginFirst()"><img src="shopping-cart-icon.png" class="cart-icon"><strong> Cart</strong></a>';
	}
	?>

</nav>
<!-- end of nav bar-->

<script type="application/javascript">
	function loginFirst() {
		//this will take non-logged in user to Login Page
		window.alert("Please login first!");
		window.location.replace("login.php");
	}
</script>
