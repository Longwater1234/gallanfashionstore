<?php
ob_start();
session_start();
?>


<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>ADMIN LOGIN</title>
	<link rel="stylesheet" href="styleadmin.css" type="text/css">
</head>

<body>
	<div class="boxy">
		<?php
		$msg = '';


		if (
			isset($_POST['login']) && !empty($_POST['username']) &&
			!empty($_POST['password'])
		) {

			if (
				$_POST['username'] == 'admin' &&
				$_POST['password'] == 'admin123'
			) {
				$_SESSION['valid'] = true;
				$_SESSION['admin'] = 'admin';


				//Access granted! take me to Admin Dashboard.
				header('location: viewOrders.php');
			} else {
				$msg = '<p style="color: red">Wrong username or password, Try Again!</p>';
			}
		}
		?>

		<h1 align="center" style="font-family:'Gill Sans', 'Gill Sans MT', 'sans-serif'"> Gallan Fashion Store</h1>
		<h2 align="center"> Admin Login</h2>
		<?php echo $msg; ?>
		<form action="adminlogin.php" method="post" enctype="multipart/form-data">
			<div align="center">
				<label for="username">Username</label>
				<input type="text" name="username" height="40" maxlength="20" placeholder="enter username" required>
			</div>
			<br>
			<div align="center">
				<label for="password">Password</label>
				<input type="password" name="password" height="40" maxlength="20" placeholder="enter password" required>
			</div>
			<br>
			<div align="center">
				<input class="button" type="submit" name="login" value="LOGIN">
				<br>
			</div>
		</form>
		<p align="center"> Go back to <a href="../index.php" title="Store Home">Store Home</a>
		</p>

	</div>
</body>

</html>