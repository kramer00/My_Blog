<!DOCTYPE html>
<html>
	<head>
		<title>Form Validation</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Clean Blog - Contact</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="css/clean-blog.min.css" rel="stylesheet">

		<!-- Custom Fonts -->
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>

	</head>
	<body>

		<?php
		require_once 'backend/user_functions.php';

		if (isset($_POST['user_id']) AND isset($_POST['user_password']) AND isset($_POST['uesr_email'])) {
			$result = add_user($_POST['user_email'], $_POST['user_id'], $_POST['user_password']);
			if ($result === TRUE) {
				echo 'ADDED NEW USER';
			} else {
				echo $result;
			}
		}
		?>

		<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">Start Bootstrap</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="index.html">Home</a>
						</li>
						<li>
							<a href="about.html">About</a>
						</li>
						<li>
							<a href="post.html">Sample Post</a>
						</li>
						<li>
							<a href="contact.html">Contact</a>
						</li>
					</ul>
				</div>

			</div>

		</nav>

		<header class="intro-header" style="background-image: url('img/blogging-500x295.jpg')">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
						<div class="page-heading">
							<h1>Contact Me</h1>
							<hr class="small">
							<span class="subheading">Have questions? We have answers (maybe).</span>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div id="frame">
			<div>
				<form method="post" id="reg_form">
					<label for="username">User Name:</label>
					<input type="text" name="user_id" id="username" />
					<br />
					<br />
					<label for="userpw">Password:</label>
					<input type="password" name="user_password" id="userpw" />
					<br />
					<br />
					<label for="useremail">Email:</label>
					<input type="text" name="user_email" id="useremail" />
					<br />
					<br />
					<button class="btn btn-success" type="submit">
						CREATE
					</button>
					<br />
					<br />
					<button class="btn btn-danger" type="submit" id="showPw">
						Show Password
					</button>
				</form>
			</div>
		</div>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
						<ul class="list-inline text-center">
							<li>
								<a href="#"> <span class="fa-stack fa-lg"> <i class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-twitter fa-stack-1x fa-inverse"></i> </span> </a>
							</li>
							<li>
								<a href="#"> <span class="fa-stack fa-lg"> <i class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-facebook fa-stack-1x fa-inverse"></i> </span> </a>
							</li>
							<li>
								<a href="#"> <span class="fa-stack fa-lg"> <i class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-github fa-stack-1x fa-inverse"></i> </span> </a>
							</li>
						</ul>
						<p class="copyright text-muted">
							Copyright &copy; Your Website 2014
						</p>
					</div>
				</div>
			</div>
		</footer>

		<script>
			var patt = /^[a-z0-9]{4,10}$/;
			var pattPw = /^[A-Za-z0-9]{6,12}$/;
			var pattPwCaps = /[A-Z]+/;
			var pattPwNumber = /[0-9]+/;
			var pattEmail = /^[a-zA-Z0-9\._]+@[A-Za-z0-9]+\.[a-z]{2,4}$/;

			//note above	^start   you can use a * match of 0 or more, + match one or more, or {min,max}... $end
			//note above if [^carrot in side of brackets it is saying we will not accept the following within the brackets]
			//note above can also be written like /^[a-z][a-zA-Z0-9]+$/  what that code says is the first must be a lower case a-z then the rest is a-z and/or A-Z 0-9

			//email example         jeffkramer00   @   gmail     . com
			//note above          /^[a-zA-Z0-9_\.]+@[A-Za-z0-9]+\.[a-z]{2,4}$/
			//note above                                        \.(com|net|org)$/
			//$('#showPw'(password){
			//.attr('password', 'text')
			//});

			$(function() {
				// Handle the submit event by validating our fields first
				$('#reg_form').submit(function() {

					var username = $('#username').val();
					var userpw = $('#userpw').val();
					var useremail = $('#useremail').val();

					if (!patt.test(username)) {
						alert('Username is incorrect!');
						return false;
					}

					if (!pattPw.test(userpw) || !pattPwNumber.test(userpw) || !pattPwCaps.test(userpw)) {
						alert('Password is incorrect. Must contain at least one number and one capital.');
						return false;
					}

					if (!pattEmail.test(useremail)) {
						alert('Email is incorrect!');
						return false;
					}
				});
			});
		</script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/clean-blog.min.js"></script>
	</body>
</html>