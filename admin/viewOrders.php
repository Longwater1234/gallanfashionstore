<?php
ob_start();
session_start();
if ( !isset( $_SESSION[ 'admin' ] ) ) {
	echo "<script>alert('Please login first!') </script>";
	echo "<script>open('adminlogin.php', '_self') </script>";
}
include( '../connections/localhost.php' );
?>



<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
<title>ADMIN | View products</title>
<link rel="stylesheet" href="../style.css" type="text/css">
</head>

<body>

<h2 style="color: crimson; margin-left: 80px">Admin Dashboard</h2>
<nav style="margin-top: 0">
		<a href="adminlogout.php">Logout</a>
		<a href="addproducts.php">Add Products</a>	
		<a href="#">View Orders</a>	
</nav>
<h2 class = "h-auto"> View Orders Placed</h2>
<?php
	
	$query = "SELECT * \n"
    . "FROM `orders` \n"
    . "INNER JOIN `products` ON orders.product_id = products.productID \n"
	. "ORDER BY `date_added` DESC";
	$result = mysqli_query($localhost, $query) or die(mysqli_error($localhost));
	
	$count = mysqli_num_rows($result);
	if ($count == 0) exit('<p align="center"> No Orders Placed Yet! </p>'); 
	
	?>


<table class="table" width="800" border="1">
  <tbody>
    <tr>
      <th scope="col">Order #</th>
      <th scope="col">Customer Email</th>
      <th scope="col">Product Name</th>
      <th scope="col">Recieved Cash (&yen;)</th>
      <th scope="col">Date Ordered</th>
    </tr>
    <?php
			global $i; 
	  		$i = 0; //counter
	  		date_default_timezone_set('Asia/Shanghai'); //change this according to your location
			while ($row = mysqli_fetch_array($result)) {
				$i = ++$i ;
			?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row['customer_email'] ?></td>
      <td><?php echo $row['productname'] ?></td>
      <td align="center"><?php echo $row['price'] ?></td>
      <td><?php echo date_format(new DateTime($row['date_added']), "Y-M-d H:i")  ?></td>
    </tr>
  </tbody>
  <?php  }	?>
</table>




</body>
</html>