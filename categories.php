<?php
ob_start();
session_start();
include('connections/localhost.php');
?>

<?php include( "includes/header.php" ); ?>

<?php include( "includes/navbar.php" ); ?>
<body>

<div class="cat1">
<div>
	<a href="categoryview.php?category=bags">
  <img src="categoryimages/bag2.jpg" class="category" width="200" height="200">
    <p class="category">Bags</p>
	</a>
</div>

<div>
<a href="categoryview.php?category=caps">
<img src="categoryimages/caps1.jpg" class="category" width="200" height="200">
	<p class="category">Caps</p>	
	</a>
</div>

<div>
<a href="categoryview.php?category=chains">
<img src="categoryimages/jewllery3.jpg" class="category" width="200" height="200">
	<p class="category">Chains</p>
	</a>	
</div>
</div>

<div class="cat1">
<div>
<a href="categoryview.php?category=pants">
  <img src="categoryimages/pants1.jpg" class="category" width="200" height="200">
	<p class="category">Pants</p>
	</a>
</div>

<div>
<a href="categoryview.php?category=shirts">
<img src="categoryimages/shirts1.jpg" class="category" width="200" height="200">
	<p class="category">Shirts</p>
	</a>	
</div>

<div>
<a href="categoryview.php?category=shoes">
<img src="categoryimages/shoes1.jpg" class="category" width="200" height="200">
	<p class="category">Shoes</p>	
	</a>
</div>
</div>

<div class="cat1">
<div>
<a href="categoryview.php?category=shorts">
<img src="categoryimages/shorts1.jpg" class="category" width="200" height="200">
	<p align="center" class="category">Shorts</p>
	</a>	
</div>

<div>
<a href="categoryview.php?category=tshirts">
<img src="categoryimages/tshirts10.jpg" class="category" width="200" height="200">
	<p class="category">T-shirts</p>	
	</a>
</div>
</div>
<br>
<?php include( "includes/footer.php" ); ?>
<br>


    
</body>
</html>