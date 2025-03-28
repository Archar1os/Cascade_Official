<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="stylesheet" href="assets/css/styles.css" />
		<link rel="icon" href="ULOGO.png" type="image/x-icon" />
		<title>Cascade - Contact</title>

		<!-- FONT FOR THE MIDDLE TEXT -->
		<link
			href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap"
			rel="stylesheet"
		/>

		<!-- Font for the bottom middle text -->
		<link
			href="https://fonts.googleapis.com/css2?family=Caladea:ital,wght@0,400;0,700;1,400;1,700&family=Teko:wght@300..700&display=swap"
			rel="stylesheet"
		/>

		<!-- Font for the sign in texts -->
		<link
			href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200..800&family=Manrope:wght@200..800&family=Sono:wght@200..800&display=swap"
			rel="stylesheet"
		/>
	</head>

	<body>
    <!-- HEADER -->
		<?php include("assets/include/header.php");?>
			<div class="content-wrapper">
				<div class="contact-section">
					<div class="contact-text">
						<h2>CONTACT US NOW!</h2>
					</div>
					<div class="contact-form">
						<form action="#" method="post">
							<div class="form-group">
								<label for="first-name">First name*</label>
								<input
									type="text"
									id="first-name"
									name="first-name"
								/>
							</div>

							<div class="form-group">
								<label for="last-name">Last name</label>
								<input
									type="text"
									id="last-name"
									name="last-name"
								/>
							</div>

							<div class="form-group full-width">
								<label for="email">Email*</label>
								<input type="email" id="email" name="email" />
							</div>

							<div class="form-group full-width">
								<label for="message"
									>Leave a Message for us!</label
								>
								<textarea
									id="message"
									name="message"
								></textarea>
							</div>
							<div class="button-container">
								<button class="button-contact" type="submit">
									Submit
								</button>
							</div>
						</form>
					</div>
					<img
						src="assets/img/here.png"
						alt="Description of the image"
						class="contact-image"
					/>
				</div>
			</div>
			<div class="background contact">
				<img src="assets/img/contact back.gif" alt="background image" />
			</div>
		</div>

		<!-- FOOTER-->
		<?php include("assets/include/footer.php");?>
	</body>
</html>
