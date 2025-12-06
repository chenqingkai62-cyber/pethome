<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Pet Home</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/carousel.css" type="text/css" media="all" />
	<link rel='stylesheet' href='css/owl.carousel.min.css'>
	<link rel='stylesheet' href='css/owl.theme.default.min.css'>
	<link href="css/font-awesome.css" rel="stylesheet">

</head>

<body>
	<?php
	include 'header.php';
	?>
	<section class="game-section">
		<?php
		require_once 'conn.php';
		$sql = "SELECT name, image_path, age, description FROM pets WHERE status = 'available' ORDER BY RAND() LIMIT 6";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo '<div class="owl-carousel custom-carousel owl-theme">';
			while ($row = $result->fetch_assoc()) {
				echo '<div class="item" style="background-image: url(' . $row["image_path"] . ');">';
				echo '<div class="item-desc">';
				echo '<h4>' . $row["name"] . '  <span class="age">' . $row["age"] . 'old</span></h4>';
				echo '<p>' . $row["description"] . '</p>';
				echo '</div></div>';
			}
			echo '</div>';
		} else {
			echo "0 Result";
		}
		?>
		</div>
	</section>

	<section class="grids-bottom-w3ls bg-light py-md-5 py-3">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 about-in text-left">
					<div class="card">
						<div class="card-body">
							<i class="fa fa-home" aria-hidden="true" data-blast="color"></i>
							<h5 class="card-title">Pet Adoption</h5>
							<div class="line" data-blast="bgColor"></div>
							<p class="card-text mt-3">Connect with loving families through the platform to find a warm home for stray or adoptable pets. View pet information, learn about the adoption process, and help little animals find new families.
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 about-in text-left">
					<div class="card">
						<div class="card-body">
							<i class="fa fa-cubes" aria-hidden="true" data-blast="color"></i>
							<h5 class="card-title">Special Topic Information</h5>
							<div class="line" data-blast="bgColor"></div>
							<p class="card-text mt-3">Providing specialized information, health knowledge, health news, and health assessments to help pets stay healthy, offering health information for pets, and safeguarding their health and happiness.
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 about-in text-left">
					<div class="card">
						<div class="card-body">
							<i class="fa fa-heart-o" aria-hidden="true" data-blast="color"></i>
							<h5 class="card-title">Veterinary Assistance</h5>
							<div class="line" data-blast="bgColor"></div>
							<p class="card-text mt-3">Schedule a vet appointment to keep your pet free from illness
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 about-in text-left">
					<div class="card">
						<div class="card-body">
							<i class="fa fa-calendar" aria-hidden="true" data-blast="color"></i>
							<h5 class="card-title">Easy Booking</h5>
							<div class="line" data-blast="bgColor"></div>
							<p class="card-text mt-3">Schedule a vet appointment to keep your pet free from illness
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="about-sec parallax-section py-lg-5 py-4" id="about">
		<div class="container">
			<div class="inner-sec-w3layouts py-md-5 py-3">
				<div class="row choose-main">
					<div class="col-lg-3">
						<h3><small>About Us</small><br>about<br>us</h3>
					</div>
					<div class="col-lg-4">
						<p>Our pet platform aims to provide pet enthusiasts with a comprehensive service, helping users find the right pets, purchase high-quality pet supplies, and receive professional pet care advice.</p>
						<p>We are committed to building a bridge that connects pets, owners, and service providers, helping more pets find loving homes and enjoy a healthy and happy life.</p>
					</div>
					<div class="col-lg-4">
						<p>Our services cover pet adoption, product purchases, veterinary assistance, and appointment booking, meeting a variety of user needs. We care about the growth of every pet and provide owners with a convenient service experience.</p>
						<p>Through our platform, users can stay informed about the latest pet news, share experiences with other pet enthusiasts, and create a community that cares for pets and promotes their health.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	include 'footer.php';
	?>
	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src='js/owl.carousel.min.js'></script>
	<script src='js/carousel.js'></script>
</body>

</html>