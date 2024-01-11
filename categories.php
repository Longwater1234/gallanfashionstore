<?php include( "includes/header.php" ); ?>
<?php include( "includes/navbar.php" ); ?>
<?php include( "arrays/categories.php" ); ?>

<body>

<div class="categories">

	<?php 
		foreach ($categories as $category) { ?>
			<div class="category">
				<a href="categoryview.php?category=<?= $category['category'] ?>">
				  <img 
				  	src="<?= $category['image'] ?>" 
				  	class="category-img" 
				  	title="<?= $category['title'] ?>"
				  	alt="<?= $category['title'] ?>">		  
				</a>

				<a 
					href="categoryview.php?category=<?= $category['category'] ?>" 
					class="category-title"
					title="<?= $category['title'] ?>">		  
				  <?= $category['title'] ?>
				</a>

				<p class="category-description"><?= $category['description'] ?></p>				
			</div> 
		<?php } ?>

</div>

<?php include( "includes/footer.php" ); ?>
    
