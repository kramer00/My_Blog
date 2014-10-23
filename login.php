<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>

	</head>
	<body>
		<form method="post" id="login_form">
			<label for="username">User Name:</label>
			<input type="text" name="user_id" id="username" />
			<br />
			<br />
			<label for="userpw">Password:</label>
			<input type="password" name="user_password" id="userpw" />
			<br />
			<br />
			<button class="btn btn-success" type="submit">
				Login
			</button>
			<br />
		</form>
		
		<?php
		require_once 'backend/user_functions.php';

		if (isset($_POST['user_id']) AND isset($_POST['user_password'])) {
			$result = login_user($_POST['user_id'], $_POST['user_password']);
			if (isset($result['user_id'])) {
				echo 'ADDED NEW USER';
			} else {
				echo $result;
			}
		}
		?>
		
		<script>
			
		</script>
		
	</body>
</html>
