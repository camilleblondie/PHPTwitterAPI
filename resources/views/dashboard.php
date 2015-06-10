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
							<li><a href="/dashboard">Dashboard</a></li>
							<li><a href="/docs">Docs</a></li>
							<?php if (Auth::check()) : ?>
							<li><a href="/logout">Log out</a></li>
							<li><span>Logged in as <em><?php echo Auth::user()->username ?></em></span></li>
							<?php endif; ?>
						</ul>
					</nav>
				</header>

			<!-- Main -->
				<section id="main" class="container">
					<header>
						<h2>Your dashboard</h2>
					</header>
					<div class="box">
						<section class="api-key">
							<?php if (Auth::user()->consumer_key == null && Auth::user()->secret_key == null) : ?>
								<p class="warning">Warning! You haven't signed in with Twitter yet. This step is mandatory to use our API.</p>
							<?php endif;?>
							<header>
								<h3>Your API Key</h3>
								<p>Use it as a GET parameter in your calls</p>
							</header>
							<p><strong><?php echo Auth::user()->api_key ?></strong></p>
						</section>

						<section class="consumption">
							<header>
								<h3>Your stats</h3>
								<p>Monitor your call consumption to the API</p>
							</header>
							<h4 class="offer">
								<i class="fa fa-check"></i>
								Your offer : 
								<?php if (Auth::user()->offer == 3) : ?>
									<strong>Gold - 1200 calls/day</strong></h4>
								<?php elseif (Auth::user()->offer == 2) : ?>
									<strong>Silver - 600 calls/day</strong></h4>
								<?php else : ?>
									<strong>Bronze - 100 calls/day</strong></h4>
								<?php endif; ?>
							<h4><i class="fa fa-bar-chart"></i>Call consumption</h4>

							<p>Today's consumption : <strong><?php echo $metricsForTodayCount; ?></strong> calls</p>
							<table>
									<thead>
										<tr>
											<th>Date</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($metricsCountGroupedByDay as $metric) : ?>
										<tr>
											<td><?php echo $metric->date; ?></td>
											<td><?php echo $metric->total; ?></td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>

							<h4><i class="fa fa-history"></i>  Call history</h4>
							<div class="table-wrapper">
								<table>
									<thead>
										<tr>
											<th>HTTP Method</th>
											<th>Route</th>
											<th>Date</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($metricsGroupedByDay as $metric) : ?>
										<tr>
											<td><?php echo $metric->http_method; ?></td>
											<td><?php echo $metric->http_route; ?></td>
											<td><?php echo $metric->date; ?></td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</section>
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