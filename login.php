<?php
ob_start();
session_start();
include('connections/localhost.php');

?>

<?php include("includes/header.php");
?>

<?php include("includes/navbar.php");
?>

<body>
	<h1 class="h-auto" align="center">User Login</h1>
	<!-- start of form-->
	<div class="form">
		<form action="login.php" method="post" enctype="multipart/form-data">
			<div align="center">
				<label for="email">Your email</label>
				<input name="email" type="email" height="30" maxlength="30" required placeholder="enter email">
			</div>
			<br>
			<div align="center">
				<label for="password">Password</label>
				<input name="password" type="password" height="30" maxlength="30" placeholder="enter password" required>
			</div>
			<br>
			<div align="center">
				<input class="button" name="login" type="submit" value="LOGIN">
			</div>
		</form>
		<p>Dont have an account? <a href="register.php">Register here</a>.</p>
	</div>
	<!-- end of form-->
	
	<div class="msg">
		<?php
		if (isset($_POST['login'])) {
			global $conn;

			$email = trim(mysqli_real_escape_string($conn, $_POST['email']));
			$password = trim(mysqli_real_escape_string($conn, $_POST['password']));

			if (empty($email) || empty($password)) {
				echo "Must fill all fields";
				exit;
			}

			filter_var($email, FILTER_VALIDATE_EMAIL) or die("Email not valid");


			$query = "SELECT `password` FROM `customers` WHERE `email`= '$email'";
			$query_run = mysqli_query($conn, $query);
			$result = mysqli_fetch_assoc($query_run)["password"] or exit("User does not exist");
			
			if (!password_verify($password, $result)) {
				exit("Wrong email or password!...Try again.");
			} else {
				$getname = "SELECT `name` FROM `customers` WHERE `email`='$email'";
				$query_two = mysqli_query($conn, $getname);
				$name = mysqli_fetch_assoc($query_two)["name"];

				$_SESSION['valid'] = true;
				$_SESSION['email'] = $email;
				$_SESSION['name'] = $name;

				if (isset($_SESSION['category'])) {
					// take us back to where we were (before logged in)
					$categoryName = stripslashes(strip_tags($_SESSION['category']));
					unset($_SESSION['category']);
					header("location:categoryview.php?category=$categoryName");
				} else {
					//otherwise take us to our dashboard.
					header("location:myaccount.php");
				}
			}
		}
		?>
	</div>


	<?php include("includes/footer.php"); ?>
</body>

</html>