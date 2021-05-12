<?php
ob_start();
session_start();
include('connections/localhost.php');
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Home | Gallan Fashion Store</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css" type="text/css">
    
</head>

<?php include("includes/navbar.php"); ?>
<body>
	<h1 class="h-orangee">Welcome to Gallan Fashion Store.
<p>Feel free to explore our large collection of items.</p>
<p>You won't regret shopping from us! </p>
</h1>

<br>
<br>
<br>


<div class="button-large-div">
<?php 
	if(!isset($_SESSION["email"])){
echo '<a href="register.php" target="_self"><button class="button-large">Create Account</button></a>';
echo "<br>";
echo "<br>";
	}
	?>
<a href="categories.php" target="_self"><button class="button-large">Browse our Collection</button></a>
</div>

</br>
</br>
	<?php include("includes/footer.php"); ?>
</body>
</html>