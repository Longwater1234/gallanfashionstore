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
	<h1 class="h-auto"> Hello <?php echo $_SESSION['name']; ?>. </h1>

	<h2 style="text-align: center"> This is your Dashboard. </h2>

	<br>
	<br>
	<div class="button-large-div">
		<a href="myorders.php"><button class="button-large">My Orders</button></a>
	</div>
	<br>
	<div class="button-large-div">
		<a href="logout.php"><button class="button-large">Logout</button></a>
	</div>

</body>

</html>