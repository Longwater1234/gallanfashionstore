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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../style.css" type="text/css">
	<title>ADMIN | add products</title>
</head>

<body>
	<h2 style="color: crimson; margin-left: 80px">Admin Dashboard</h2>
	<nav style="margin-top: 0">
		<a href="adminlogout.php">Logout</a>
		<a href="#">Add Products</a>	
		<a href="viewOrders.php">View Orders</a>	
	</nav>
	<h2 class="h-auto"> Add New Product</h2>

	<form class="form" action="" method="post" enctype="multipart/form-data">
		<div align="center">
			<label for="name"> Name of Product</label>
			<input name="name" type="text" maxlength="30" required>
		</div>
		<br>
		<div align="center">
			<label for="price">Price (CNY) :</label>
			<input name="price" type="text" size="3" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="4" required>
		</div>
		<br>
		<div align="center">
			<label for="category">Category</label>
			<select name="category">
				<option>Bags</option>
				<option>Caps</option>
				<option>Chains</option>
				<option>Pants</option>
				<option>Shirts</option>
				<option>Shoes</option>
				<option>Shorts</option>
				<option>Tshirts</option>
			</select>
		</div>
		<br>
		<div align="center">
			<label>Image (max file size: 2 MB) </label>
			<input name=MAX_FILE_SIZE value=2000000 type=hidden>
			<!--this line ^ above very useful in PHP. Edit value (in bytes) as you wish.-->
			<input name="product_image" type="file" accept=".jpg, .jpeg, .png" required>
		</div>
		<br>
		<div align="center">
			<input class="button" type="submit" name="insert" value="INSERT">
		</div>
		<br>
	</form>

	<div class="msg">
		<?php

		global $localhost;
		if ( isset( $_POST[ 'insert' ] ) ) {

			$productname = mysqli_real_escape_string( $localhost, $_POST[ 'name' ] );
			$price = mysqli_real_escape_string( $localhost, $_POST[ 'price' ] );
			$category = mysqli_real_escape_string( $localhost, $_POST[ 'category' ] );
							
			$productname = strtoupper(trim($productname)); //converts to UPPER CASE


			//-----------------------------here below START image file upload process -----------//
			$fileName = $_FILES[ 'product_image' ][ 'name' ];
			$filetype = $_FILES[ 'product_image' ][ 'type' ];
			$fileTemp = $_FILES[ 'product_image' ][ 'tmp_name' ];
			$fileSize = $_FILES[ 'product_image' ][ 'size' ];
			$uploadError = $_FILES[ 'product_image' ][ 'error' ];


			if ( $uploadError != 0 ) {
				if ($uploadError == 2) echo( "Sorry, your file size exceeds limit. \n" );
				exit( "Upload failed." );
			}

			// Check if file is an actual image/photo file. VERY INTELLIGENT & ACCURATE. 
			//  USE this if PHOTOS are the only file uploads required. WON'T work with PDF, DOC etc.
		/*	if ( exif_imagetype( $fileTemp ) != IMAGETYPE_JPEG && exif_imagetype( $fileTemp ) != IMAGETYPE_PNG ) {
				exit( "Invalid file type. Upload failed." );
			} */

			//CHECKS file type by simply reading the file extension. QUICK, BUT NOT RECOMMENDED.
			// This Can be fooled easily if User modifies file extension before upload.
			if ( $filetype != "image/jpeg" && $filetype != "image/png" ) {
				exit( "Invalid file type. Upload failed." );
			}


			$target_dir = "../uploads/";
			$target_file = $target_dir . basename( $fileName );

			//check if file exists
			if ( file_exists( $target_file ) ) {
				die( "Sorry, File already exists. Upload failed." );
			}

			// check file size
			if ( $fileSize > 2000000 ) {
				// In bytes.  Adjust the amount as you wish
				die( "Sorry, file is over 2MB. Upload failed" );

			} else {
				// everything is OK. Can now proceed to save the file.

				// FIRST, remove all special characters and spaces in file name
				$pattern = "/[ \s\(\)\[\] \{\} \^`~,%!@#& \+ \$ ]+/";
				$newFileName = preg_replace( $pattern, "", basename(strtolower(($fileName))));

				// THEN, move file to final destination
				move_uploaded_file( $fileTemp, "../uploads/$newFileName" )or die( "Upload failed" );

				//----------------- here above END of file upload process--------//

				// FINALLY add everything you got into database:
				$insert_product = "INSERT INTO `products`(`productname`, `price`, `category`, `product_image`) VALUES ( '$productname', '$price', '$category', '$newFileName')";

				if ( mysqli_query( $localhost, $insert_product ) ) {
					echo "<script>alert('Product added successfully!')</script>";
					echo "<script>window.open('addproducts.php','_self')</script>";
				} else
					echo "Upload failed" . mysqli_error( $localhost );
			}

		}

		?>
	</div>
</body>

</html>