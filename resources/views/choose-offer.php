<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>PHPTwitterAPI</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="/assets/css/custom.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1><a href="/">PHPTwitterAPI</a> by Florian, Jean and Camille</h1>
					<nav id="nav">
						<ul>
							<li><a href="/">Home</a></li>
							<li><a href="/docs">Docs</a></li>
							<li><a href="/signup" class="button">Sign Up</a></li>
						</ul>
					</nav>
				</header>

			<!-- Main -->
				<section id="main" class="container">
					<header class="price-header">
						<h1>Our offers</h1>
					</header>
					<div class="row">
						<div class="4u 12u(narrower)">

							<section class="box special">
								<span class="image featured background-1">
									<h2 class="price">Free</h2>
								</span>
								<h3 class="offer-title bronze">Bronze</h3>
								<p>100 calls/day</p>
								<ul class="actions">
									<?php if (Request::query('change') == 1) : ?>
										<li><a href="/choose-offer?change=1&amp;offer=bronze" class="button alt">Choose</a></li>
									<?php else : ?>
										<li><a href="/choose-offer?offer=bronze" class="button alt">Choose</a></li>
									<?php endif; ?>
								</ul>
							</section>

						</div>
						<div class="4u 12u(narrower)">

							<section class="box special">
								<span class="image featured background-2">
									<h2 class="price">30$/month</h2>
								</span>
								<h3 class="offer-title silver">Silver</h3>
								<p>600 calls/day</p>
								<ul class="actions">
									<?php if (Request::query('change') == 1) : ?>
										<li><a href="/choose-offer?change=1&amp;offer=silver" class="button alt">Choose</a></li>
									<?php else : ?>
										<li><a href="/choose-offer?offer=silver" class="button alt">Choose</a></li>
									<?php endif; ?>
								</ul>
							</section>

						</div>
						<div class="4u 12u(narrower)">

							<section class="box special">
								<span class="image featured background-3">
									<h2 class="price">50$/month</h2>
								</span>
								<h3 class="offer-title gold">Gold</h3>
								<p>1200 calls/day</p>
								<ul class="actions">
									<?php if (Request::query('change') == 1) : ?>
										<li><a href="/choose-offer?change=1&amp;offer=gold" class="button alt">Choose</a></li>
									<?php else : ?>
										<li><a href="/choose-offer?offer=gold" class="button alt">Choose</a></li>
									<?php endif; ?>
								</ul>
							</section>

						</div>
					</div>
				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>