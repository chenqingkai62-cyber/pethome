<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Pet Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
</head>

<body>
	<?php
	include 'header.php';
	?>
	<section class="about-sec parallax-section py-lg-5 py-4" id="book">
		<br>
		<br>
		<div class="container">
			<div class="inner-sec-w3layouts py-md-5 py-3">
				<div class="choose-main">
					<div id="search_form" class="search_top text-center">
						<form action="action/submit_service.php" method="post" class="booking-form row">
							<div class="col-md-3 banf">
								<input class="form-control" type="text" name="Name" placeholder="Name" required="">
							</div>
							<div class="col-md-3 banf">
								<input class="form-control" type="text" name="Phone" placeholder="Contact Information" required="">
							</div>
							<div class="col-md-3 banf">
								<select id="country13" class="form-control" name="Service" required="">
									<option value="">Select Service</option>
									<option value="Routine Check">Routine Check</option>
									<option value="Pet vaccine">Pet vaccine</option>
									<option value="Surgery/Treatment">Surgery/Treatment</option>
								</select>
							</div>
							<div class="col-md-3 banf">
								<input class="form-control" data-blast="bgColor" type="submit" value="Reserve">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="about-sec contact-sec parallax-section py-lg-5 py-4" id="contact">
		<div class="container">
			<div class="inner-sec-w3layouts py-md-1 py-3">
				<div class="choose-main row">
					<div class="col-md-4">
						<h3><small>Leave a message</small>Contact Us</h3>
						<div class="map mt-3">
							<iframe src="" allowfullscreen=""></iframe>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-contact">
							<form action="action/submit_message.php" method="post">
								<div class="form-group">
									<label class="my-2">name</label>
									<input class="form-control" type="text" name="name" placeholder="Real Name" required="">
								</div>
								<div class="form-group">
									<label>Contact Information</label>
									<input class="form-control" type="text" name="contact" placeholder="Email or phone" required="">
								</div>
								<div class="form-group">
									<label>Message content</label>
									<textarea id="textarea" name="content" placeholder="Please enter your message" required=""></textarea>
								</div>
								<div class="input-group1">
									<input class="form-control" data-blast="bgColor" type="submit" value="Submit">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	include 'footer.php';
	?>
	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/boost.js"></script>
	<script src="js/blast.min.js"></script>
	<script src="js/lightbox-plus-jquery.min.js"></script>
	<script src="js/move-top.js"></script>
	<script src="js/easing.js"></script>
	<script src="js/bootstrap.js"></script>
</body>

</html>