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
							<li><a href="/login" class="button">Log in</a></li>
						</ul>
					</nav>
				</header>

			<!-- Main -->
				<section id="main" class="container 75%">
					<header>
						<h2>Sign Up</h2>
						<p>Create an account to use PHPTwitterAPI.</p>
					</header>
					<div class="box">
						<form method="post" action="/signup">
							<div class="row uniform">
								<div class="12u">
									<input type="text" name="username" id="username" value="" placeholder="Username" />
								</div>
								<div class="12u">
									<input type="email" name="email" id="email" value="" placeholder="Email" />
								</div>
								<div class="12u">
									<input type="password" name="password" id="password" value="" placeholder="Password" />
								</div>
								<?php if (strlen(Request::query("offer")) != 0) : ?>
								<input type="hidden" name="offer" value="<?php echo Request::query('offer'); ?>" />
								<?php endif; ?>
							</div>
							<div class="row uniform">
								<div class="12u">
									<ul class="actions align-center">
										<li><input type="submit" value="Sign up!" /></li>
									</ul>
								</div>
							</div>
						</form>
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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>