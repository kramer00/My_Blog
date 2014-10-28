<?php
include_once 'header.php';
?>

<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('img/home-bg.jpg')">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<div class="site-heading">
					<h1>I Don't Know You Yet</h1>
					<hr class="small">
					<span class="subheading">Get On Board And Register</span>
				</div>
			</div>
		</div>
	</div>
</header>

<!-- Main Content -->
<div class="container">
	<div class="row">
		<div id="message-container">
			<form role="form" method="post" id="reg_form">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" class="form-control" id="username" placeholder="Username">
				</div>
				<div class="form-group">
					<label for="email">Email address</label>
					<input type="email" name="email" class="form-control" id="email" placeholder="Email">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control" id="password" placeholder="Password">
				</div>
				<button type="submit" class="btn btn-default">
					Register
				</button>
			</form>
		</div>
	</div>
</div>
<script>
	$(function() {
		$('#username').blur(function() {
			//alert('Exited username');
			var user_field = $(this);
			var data = {'username': $(this).val()}
			
			$.post('ajax/unique_check.php', data,
				function(response) {
					if(response == 1) {
						user_field.removeClass('alert-danger').addClass('alert-success');
				} else {
					user_field.removeClass('alert-success').addClass('alert-danger');
				}
			});
		});
		
		$('#email').blur(function() {
			var email_field = $(this);
			var emailData = {'email': $(this).val()}
			
			$.post('ajax/unique_check.php', emailData,
				function(response) {
					if(response == 1) {
					email_field.removeClass('alert-danger').addClass('alert-success');
				} else {
					email_field.removeClass('alert-success').addClass('alert-danger');
				}
			});
		});
		
		// Handle the submit event by validating our fields first
		$('#reg_form').submit(function() {
			var nameValidate = /^[A-Za-z0-9]{6,20}$/;
			var mailValidate = /^[A-Za-z0-9_\.]+@[A-Za-z0-9]+\.[a-z]{2,4}$/;
			var passValidate = /^[A-Za-z0-9]{6,12}$/;
			var caps = /[A-Z]+/;
			var nums = /[0-9]+/;
			var username = $('#username').val();
			var email = $('#email').val();
			var password = $('#password').val();

			//AJAX call
			var data = {
				'username' : username,
				'password' : password,
				'email' : email
			}

			$.post('/ajax/registration.php', data, function(response) {
				if (response == 1) {
					var div = $('<div>').addClass('alert alert-success').html('Account registration successful');
				} else {
					var div = $('<div>').addClass('alert alert-danger').html(response);
				}
				
				$('#message-container').html(div);
			});

			return false;
		});
	}); 
</script>
<?php
include_once 'footer.php';
?>