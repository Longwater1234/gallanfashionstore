<?php
ob_start();
session_start();
include( 'connections/localhost.php' );

?>


<!doctype html>
<html lang="en">

<?php include( "includes/header.php" ); ?>

<?php include( "includes/navbar.php" ); ?>

<body>
	<h1 class="h-auto" align="center">Create Account</h1>
	<br>
	<div class="form">
		<form action="register.php" method="post" enctype="multipart/form-data">
			<div align="center">
				<label>Name</label>
				<input name="name" type="text" height="30" placeholder="enter name" required>
			</div>
			<br>
			<div align="center">
				<label>Phone No.</label>
				<input name="phone" type="text" maxlength="11" height="30" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="phone number" required>
			</div>
			<br>
			<div align="center">
				<label>Email</label>
				<input name="email" type="email" height="30" maxlength="30" placeholder="enter email" required>
			</div>
			<br>
			<div align="center">
				<label>Create Password</label>
				<input name="password" type="password" height="30" pattern=".{6,}" title="6 characters minimum" maxlength="30" placeholder="6 characters or more" required>
			</div>
			<br>
			<div align="center">
				<label>Confirm Password</label>
				<input name="confirmPass" type="password" height="30" maxlength="30" pattern=".{6,}" title="6 characters minimum" placeholder="repeat password" required>
			</div>
			<br>
			<div align="center">
				<input class="button" name="register" type="submit" value="REGISTER">
			</div>
		</form>
		<p>Already have an Account? <a href="login.php">Login here</a>
		</p>
	</div>

	<div class="msg">
		<?php
		// this code below for when someone presses the REGISTER button
		
		function cleanInput($data){
			//this to clean and sanitize our input data
			$data = strip_tags(trim($data));
			$data = htmlspecialchars($data);
			$data = stripslashes($data);
			return($data);
		}

		if ( isset( $_POST[ 'register' ] ) ) {
			global $localhost;

			$name = mysqli_real_escape_string( $localhost, $_POST[ 'name' ] );
			$phone =  mysqli_real_escape_string( $localhost, $_POST[ 'phone' ] );
			$email =  mysqli_real_escape_string( $localhost, $_POST[ 'email' ] );
			$password = mysqli_real_escape_string( $localhost, $_POST[ 'password' ] );
			$confirmPass = mysqli_real_escape_string( $localhost, $_POST[ 'confirmPass' ] );
			
			$name = cleanInput($name);
			$phone = cleanInput($phone);
			$email = cleanInput($email);
			$password = cleanInput($password);
			
			filter_var($email, FILTER_VALIDATE_EMAIL) or die("Email not valid");
			if(strlen($password) < 6) exit("Password requires 6 or more characters");
			


			if ( !( $password == $confirmPass ) ) {
				//this means passwords do not match
				echo "Passwords do not match";
			} else {

				$s = "SELECT * from `customers` where email= '$email'";
				$result = mysqli_query( $localhost, $s );
				$num = mysqli_num_rows( $result );

				if ( $num > 0 ) {
					// this means the user already exists
					echo "User already exists!";
				} else {
					$hashedpassword = sha1( $password ); 
					$reg = "INSERT INTO `customers`(`name`, `email`, `password`, `phone`, `datejoined`) VALUES ('$name','$email','$hashedpassword', '$phone', NOW())";

					if ( mysqli_query( $localhost, $reg ) ) {
						$_SESSION[ 'valid' ] = true;
						$_SESSION[ 'timeout' ] = time();
						$_SESSION[ 'name' ] = $name;
						$_SESSION[ 'email' ] = $email;
						
						
						echo '<p style="color: green"> Registration successful! Redirecting you... </p>';
						header( 'Refresh: 1; URL = myaccount.php' );
						
					} else {
						echo "Sign up failed" . mysqli_error( $localhost );
					}
				}
			}
		}
		?>
	</div>
	
	<?php include("includes/footer.php"); ?>
</body>
</html>