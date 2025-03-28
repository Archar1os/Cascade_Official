<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="assets/css/styles.css" />
		<link rel="icon" href="ULOGO.png" type="image/x-icon" />

		<!-- H1 FONT FOR MENU -->
		<link
			href="https://fonts.googleapis.com/css2?family=Boogaloo&family=Girassol&family=Share+Tech+Mono&display=swap"
			rel="stylesheet"
		/>

		<!-- H2 FOR THE 3 IMAGES -->
		<link
			href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap"
			rel="stylesheet"
		/>

		<!-- FONT FOR 1ST MENU -->
		<link
			href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap"
			rel="stylesheet"
		/>

		<title>Cascade - Menu</title>
	</head>

	<body>
    <!-- HEADER -->
		<?php include("assets/include/header.php");?>
			<div class="content_menu">
				<div class="menu-intro">
					<h1>WELCOME TO OUR MENU</h1>
					<p>
						Try our best-selling drinks and snacks, perfect for
						treating yourself to something special. <br />
						Whether you're in the mood for a warm cup of coffee or a
						tasty treat, we've got something just for you!
					</p>
				</div>
				<div class="menu-section">
					<div class="menu-item">
						<a href="mainmenu.php#coffee-section" style="text-decoration: none">
							<img
								class="coffee-image"
								src="assets/img/coffeeagain.gif"
								alt="Coffee making"
							/>
							<h2>ORDER YOUR COFFEE NOW!</h2>
						</a>
					</div>

					<div class="menu-item">
						<a href="mainmenu.php" style="text-decoration: none">
							<img src="assets/img/pancake2.gif" alt="Bread" />
							<h2>ORDER FOOD NOW!</h2>
						</a>
					</div>
					<div class="menu-item">
						<a href="mainmenu.php#snacks-section" style="text-decoration: none">
							<img src="assets/img/cakegood.gif" alt="Cake" />
							<h2>ORDER YOUR CAKE NOW!</h2>
						</a>
					</div>
				</div>
			</div>
			<div class="background_menu">
				<img
					src="assets/img/menu background.gif"
					alt="background image"
				/>
			</div>
		</div>
		<!-- FOOTER-->
		<?php include("assets/include/footer.php");?>
	</body>
</html>
