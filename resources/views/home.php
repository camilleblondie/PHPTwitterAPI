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
		<!--[if lte IE 8]><script src="/assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="/assets/css/main.css" />
		<link rel="stylesheet" href="/assets/css/custom.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="/assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="landing">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
					<h1><a href="/">PHPTwitterAPI</a> by Florian, Jean and Camille</h1>
					<nav id="nav">
						<ul>
							<li><a href="/">Home</a></li>
							<?php if (Auth::check()) : ?>
								<li><a href="/dashboard">Dashboard</a></li>
							<?php endif; ?>
							<li><a href="/docs">Docs</a></li>
							<?php if (Auth::check() == false) : ?>
								<li><a href="/login">Log in</a></li>
								<li><a href="/signup" class="button">Sign Up</a></li>
							<?php endif; ?>
							<?php if (Auth::check()) : ?>
								<li><a href="/logout">Log out</a></li>
								<li><span>Logged in as <em><?php echo Auth::user()->username ?></em></span></li>
							<?php endif; ?>
						</ul>
					</nav>
				</header>

			<!-- Banner -->
				<section id="banner">
					<h2>PHPTwitterAPI</h2>
					<p>A simple API for Twitter. All you just need.</p>
					<ul class="actions">
						<li><a href="/signup" class="button special">Sign Up</a></li>
						<?php if (Auth::check() == false) : ?>
							<li><a href="/login" class="button">Log in</a></li>
						<?php endif; ?>
					</ul>
				</section>

			<!-- Main -->
				<section id="main" class="container">

					<section class="box special">
						<header class="major">
							<h2>Introducing the ultimate Twitter API
							<br />
							for getting the simplest information</h2>
							<p>All the routes to get essential data and clean responses for easy processing.</p>
						</header>
<!-- 						<span class="image featured"><img src="/images/pic01.jpg" alt="" /></span>
 -->					</section>

					<section class="box">
						<header class="major">
							<h2>Extremely simple</h2>
						</header>
						<div class="10u 12u usage-example">
							<span>GET request</span>
							<pre>GET /tweets/:screen_name</pre>
							<span>JSON response</span>
							<pre>
[
  {"text": "example of tweet 1"},
  {"text": "second example of tweet"}
]
							</pre>
						</div>
					</section>

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
								<h4>100 calls/day</h4>
								<p>With a maximum value of 15 requests every 15 minutes</p>
								<ul class="actions">
									<li><a href="/signup?offer=bronze" class="button alt">Choose</a></li>
								</ul>
							</section>

						</div>
						<div class="4u 12u(narrower)">

							<section class="box special">
								<span class="image featured background-2">
									<h2 class="price">30$/month</h2>
								</span>
								<h3 class="offer-title silver">Silver</h3>
								<h4>600 calls/day</h4>
								<p>With a maximum value of 15 requests every 15 minutes</p>
								<ul class="actions">
									<li><a href="/signup?offer=silver" class="button alt">Choose</a></li>
								</ul>
							</section>

						</div>
						<div class="4u 12u(narrower)">

							<section class="box special">
								<span class="image featured background-3">
									<h2 class="price">50$/month</h2>
								</span>
								<h3 class="offer-title gold">Gold</h3>
								<h4>1200 calls/day</h4>
								<p>With a maximum value of 15 requests every 15 minutes</p>
								<ul class="actions">
									<li><a href="/signup?offer=gold" class="button alt">Choose</a></li>
								</ul>
							</section>

						</div>
					</div>

				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li class="footer-label"><span class="label">Visit our GitHub</span></li>
						<li><a href="http://github.com/camilleblondie/PHPTwitterAPI" class="icon fa-github"><span class="label">Github</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; PHPTwitterAPI. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="/assets/js/jquery.min.js"></script>
			<script src="/assets/js/jquery.dropotron.min.js"></script>
			<script src="/assets/js/jquery.scrollgress.min.js"></script>
			<script src="/assets/js/skel.min.js"></script>
			<script src="/assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="/assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="/assets/js/main.js"></script>

	</body>
</html>