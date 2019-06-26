<section></section>
	<aside>
		<h1><a href="#">Featured Product</a></h1>
			<hr/>
			<?php 
			/*
				Only show the product whose featured value is yes
			*/
			$showFeaturedProducts = $pdo->prepare("SELECT * FROM products_db_table");
			$showFeaturedProducts->execute();
				foreach($showFeaturedProducts as $featured)
				{ 
					if($featured['featured']==='yes'){ ?>
					<p>
						<strong><?php echo $featured['product_name'];?></strong>
					</p>
					<p><strong>Manufactured By:</strong> <?php echo $featured['manufacturer']; ?></p>
					<?php if(isset($_SESSION['user_sessId'])){ ?>
						<a href="insertCart.php?cartget_id=<?php echo $featured['product_id']; ?>"><input class="add-button" type="button" value="Add to cart"/></a><br/><br>
					<?php }else{?>
						<a href="#" onclick="javascipt: alert('Please sign in to add products to cart')" ><input class="add-button" type="button" value="Add to cart"/></a><br/><br>
					<?php } ?>
					<hr/>

		<?php } } ?>
	</aside>