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
					<h1><a href="index.html">PHPTwitterAPI</a> by Florian, Jean and Camille</h1>
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
					<header>
						<h2>PHPTwitterAPI Docs</h2>
					</header>
					<div class="box row uniform">
							<div class="5u 12u">
								<ul class="nav nav-pills nav-stacked">
									<li class="active">
										<a href="#getFollowers" aria-controls="getFollowers" data-toggle="pill">
										GET /api/followers
										</a>
									</li>
									<li>
										<a href="#followings" aria-controls="followings" data-toggle="pill">
										GET /api/followings
										</a>
									</li>
									<li>
										<a href="#status" aria-controls="messages"  data-toggle="pill">
										GET /api/status
										</a>
									</li>
								</ul>
							</div>

							<div class="tab-content 7u 12u">
								<div role="tabpanel" class="tab-pane active" id="getFollowers">
									<h4>Parameters :</h4>
									<table>
										<tbody>
											<tr>
												<td>userId</td>
												<td>Id of the user</td>
											</tr>
											<tr>
												<td>limit</td>
												<td>Max number of followers returned</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div role="tabpanel" class="tab-pane" id="followings">
									<h4>Parameters :</h4>
									<table>
										<tbody>
											<tr>
												<td>userId</td>
												<td>Id of the user</td>
											</tr>
											<tr>
												<td>limit</td>
												<td>Max number of followers returned</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div role="tabpanel" class="tab-pane" id="status">
									<h4>Parameters :</h4>
									<table>
										<tbody>
											<tr>
												<td>id</td>
												<td>Id of the status</td>
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

			<!-- Latest compiled and minified JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>