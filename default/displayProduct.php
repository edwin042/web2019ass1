<ul class="product_item">
	<?php //displays all the products in the list
	foreach($showProducts as $rows){ ?>
		<li>
			<h3>
				<a href="displayEach.php?eachProduct_id=<?php echo $rows['product_id']; ?>">
					<?php echo $rows['product_name']; ?>
				</a>
			</h3>
			<p>
				<?php echo $rows['description']; ?>
			</p>
			<div class="price">
				£<?php echo $rows['product_price']; ?>
			</div>
			<?php if(isset($_SESSION['user_sessId'])){ ?>
				<a href="insertCart.php?cartget_id=<?php echo $featured['product_id']; ?>">
					<input class="add-button" type="button" value="Add to cart"/>
				</a><br/><br/>
			<?php }else{?>
				<a href="#" onclick="javascipt: alert('Please sign in to add products to cart')" >
					<input class="add-button" type="button" value="Add to cart"/>
				</a><br/><br>
			<?php } ?>
		</li>
	<?php } ?>
</ul>