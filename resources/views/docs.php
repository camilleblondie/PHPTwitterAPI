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

			<!-- Main -->
				<section id="main" class="container">
					<header>
						<h2>PHPTwitterAPI Docs</h2>
					</header>
					<div class="box row uniform">
						<div class="5u 12u">
							<ul class="nav nav-pills nav-stacked">
								<li class="active">
									<a href="#1" aria-controls="1" data-toggle="pill">
									GET /api/tweet/:id
									</a>
								</li>
								<li>
									<a href="#2" aria-controls="2" data-toggle="pill">
									GET /api/tweets/:screen_name
									</a>
								</li>
								<li>
									<a href="#3" aria-controls="3"  data-toggle="pill">
									GET /api/favorites
									</a>
								</li>
								<li>
									<a href="#4" aria-controls="4"  data-toggle="pill">
									GET /api/followers
									</a>
								</li>
								<li>
									<a href="#5" aria-controls="5"  data-toggle="pill">
									GET /api/followings
									</a>
								</li>
								<li>
									<a href="#6" aria-controls="6"  data-toggle="pill">
									POST /api/retweet
									</a>
								</li>
								<li>
									<a href="#7" aria-controls="7"  data-toggle="pill">
									POST /api/tweet
									</a>
								</li>
								<li>
									<a href="#8" aria-controls="8"  data-toggle="pill">
									DELETE /api/tweet/:id
									</a>
								</li>
							</ul>
						</div>

						<div class="tab-content 7u 12u">
							<div role="tabpanel" class="tab-pane active" id="1">
								<h3>GET /api/tweet/:id</h3>
								<h4>Parameters :</h4>
								<table>
									<tbody>
										<tr>
											<td>id</td>
											<td>Id of the user</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div role="tabpanel" class="tab-pane" id="2">
								<h3>GET /api/tweets/:screen_name</h3>
								<h4>Parameters :</h4>
								<table>
									<tbody>
										<tr>
											<td>screen_name</td>
											<td>Name of the user (e.g. for @flmgt, screen_name is flmgt)</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div role="tabpanel" class="tab-pane" id="3">
								<h3>GET /api/favorites</h3>
								<h4>Parameters :</h4>
								<table>
									<tbody>
										<tr>
											<td>screen_name</td>
											<td>Name of the user</td>
										</tr>
										<tr>
											<td>user_id</td>
											<td>Id of the user</td>
										</tr>
										<tr>
											<td>count</td>
											<td>Limit of the favorites to get. Default to 10.</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div role="tabpanel" class="tab-pane" id="4">
								<h3>GET /api/followers</h3>
								<h4>Parameters :</h4>
								<table>
									<tbody>
										<tr>
											<td>screen_name</td>
											<td>Name of the user</td>
										</tr>
										<tr>
											<td>user_id</td>
											<td>Id of the user</td>
										</tr>
										<tr>
											<td>count</td>
											<td>Limit of the favorites to get. Default to 10.</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div role="tabpanel" class="tab-pane" id="5">
								<h3>GET /api/followings</h3>
								<h4>Parameters :</h4>
								<table>
									<tbody>
										<tr>
											<td>screen_name</td>
											<td>Name of the user</td>
										</tr>
										<tr>
											<td>user_id</td>
											<td>Id of the user</td>
										</tr>
										<tr>
											<td>count</td>
											<td>Limit of the favorites to get. Default to 10.</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div role="tabpanel" class="tab-pane" id="6">
								<h3>POST /api/retweet</h3>
								<h4>Parameters :</h4>
								<table>
									<tbody>
										<tr>
											<td>id</td>
											<td>Id of the tweet to be retweeted</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div role="tabpanel" class="tab-pane" id="7">
								<h3>POST /api/tweet</h3>
								<h4>Parameters :</h4>
								<table>
									<tbody>
										<tr>
											<td>status</td>
											<td>Text of the tweet to post</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div role="tabpanel" class="tab-pane" id="8">
								<h3>DELETE /api/tweet/:id</h3>
								<h4>Parameters :</h4>
								<table>
									<tbody>
										<tr>
											<td>id</td>
											<td>Id of the tweet to delete</td>
										</tr>
									</tbody>
								</table>
							</div>
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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

			<!-- Latest compiled and minified JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>