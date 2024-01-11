<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<body>
	<h1 class="h-orangee">Welcome to Gallan Fashion Store. <br>
	Feel free to explore our large collection of items. <br>
	You won't regret shopping from us!
	</h1>

	<br>
	<br>
	<br>

	<div class="button-large-div">
		<?php 
			if(!isset($_SESSION["email"])){ ?>
				<a href="register.php" target="_self">
					<button 
						class="button-large"
						title="Create Account">
						Create Account
					</button>
				</a>
				<br>
				<br> 
			<?php }
		?>

		<a href="categories.php" target="_self">
			<button 
				class="button-large"
				title="Browse our Collection">
				Browse our Collection
			</button>
		</a>

	</div>

	</br>
	</br>
	
	<?php include("includes/footer.php"); ?>

