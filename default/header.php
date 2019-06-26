	<!-- meta tags -->
	<meta charset="utf-8" />
	<!-- css and font awesome -->
	<link rel="stylesheet" href="css/electronics.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body>
<header>
	<h1>Ed's Electronics</h1>
	<ul>
		<!-- menu start -->
		<li>MENU
			<ul>
				<li> <a href="electronics.php">Home</a> </li>
				<!-- add new menu items here -->

			<?php //only shows when there is value in session
				if(isset($_SESSION['user_sessId'])){ ?>
				<li> <a href="profileUsers.php">Profile</a> </li>
				<li><a href="default/logout_users.php">Logout <i class="fa fa-log-out"></i></a></li>
				<!-- add menu items here for logged in users-->

			<?php } //users who are not registered will see this menu
			else{ ?>
				<li><a href="login_users.php">Login</i></a></li>
				<li><a href="register_users.php">Register</i></a></li>
			<?php } ?>
			</ul>
		</li>
		<!-- menu end -->

		<!--Drop-down Product Categories Here -->
		<li>Products
			<ul>
				<?php
					//Displays all the categories in drop down menu
					$showCategoriesDropDown = $pdo->prepare("SELECT * FROM categories_db_table");
					$showCategoriesDropDown->execute();
				 foreach($showCategoriesDropDown as $dropdownValues) { ?>
				<li><a href="category.php?categoryId=<?php echo $dropdownValues['category_id'];?>"><?php echo $dropdownValues['category_name']; ?></a></li>
			<?php } ?>
			</ul>
		</li>

		<?php if(isset($_SESSION['user_sessId'])){ ?>
			<li><a href="shoppingcart.php?cartuserid=<?php echo $_SESSION['user_sessId']; ?>">My Cart <i class="fa fa-shopping-cart"></i></a></li>
		<?php } ?>
	</ul>
	<address>
		<p>We are open 9-5, 7 days a week. Call us on
			<strong>01604 11111</strong>
		</p>
	</address>
</header>

<!-- Search navigation -->
<div class="search_nav">
	<form style="text-align: left;" action="searchProducts.php" method="GET">
		<input class="search-input" type="text" name="search_query" placeholder="Search...."/>
		<button class="search-button" type="submit" name="search"><i class="fa fa-search"></i></button>
	</form>
</div>
		

