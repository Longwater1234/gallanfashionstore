<?php
ob_start();
session_start();
include('connections/localhost.php');
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contact | Gallan Fashion Store</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="contactStyle.css" rel="stylesheet" type="text/css">
</head>

<?php include("includes/navbar.php"); ?>

<body>

	<div class="msg">
		<?php
		// FOR HANDLING CONTACT FORM
		function cleanInput($data)
		{
			//this PHP function to clean and sanitize our input data
			$data = strip_tags(trim($data));
			$data = htmlspecialchars($data);
			$data = stripslashes($data);
			return ($data);
		}


		if (isset($_POST['submit'])) {
			global $conn;

			$name = cleanInput($_POST['name']);
			$email = cleanInput($_POST['email']);
			$message = cleanInput($_POST['message']);


			if (empty($name) || empty($email) || empty($message)) die("Must fill all fields");

			filter_var($email, FILTER_VALIDATE_EMAIL) or die("Email not valid. Message not sent! ");

			if (strlen($message) > 200) exit("Message must NOT be more than 200 characters");


			$name = mysqli_real_escape_string($conn, $name);
			$email = mysqli_real_escape_string($conn, $email);
			$message = mysqli_real_escape_string($conn, $message);

			$sendMsg = "INSERT INTO `contactus`( `name`, `email`, `message`, `date_posted`) VALUES ('$name', '$email', '$message', NOW())";

			if (mysqli_query($conn, $sendMsg)) {
				echo "<script>alert('Message Sent!')</script>";
				echo "<script>window.open('contact.php','_self')</script>";
			} else
				echo "Error:" . mysqli_error($conn);
		}

		?>
	</div>

	<!--	the contact form-->
	<div class="container">
		<form id="contact" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
			<h3>Contact Form</h3>
			<h4>Write to us if you have any questions</h4>
			<fieldset>
				<input name="name" placeholder="Your name (required)" type="text" tabindex="1" maxlength="20" required autofocus>
			</fieldset>
			<fieldset>
				<input name="email" placeholder="Your Email Address (required)" type="email" maxlength="50" tabindex="2" required>
			</fieldset>
			<fieldset>
				<textarea name="message" id="messageInput" placeholder="Type your message here...." maxlength="200" onKeyUp="countChars()" tabindex="5" required></textarea>
			</fieldset>
			<p align="right" id="charLeft">200 characters left</p>
			<fieldset>
				<button name="submit" type="submit" id="contact-submit">Send Message</button>
			</fieldset>
		</form>
	</div>
	<br>


	<?php include("includes/footer.php"); ?>

	<script type="application/javascript">
		function countChars() {
			//for displaying number of characters left for Message
			var val = document.getElementById("messageInput").value;
			var charCounter = 200 - val.length;
			document.getElementById("charLeft").innerHTML = charCounter + ' characters left';

		}
	</script>


</body>

</html>