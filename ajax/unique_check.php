<?php
$result = false;
if(isset($_POST['username']) OR isset($_POST['email']))
{
    include '../backend/user_functions.php';
	
	if(isset($_POST['username']) AND !empty($_POST['username'])) {
		$result = unique_check('username', $_POST['username']);
	} elseif(isset($_POST['email']) AND !empty($_POST['email'])) {
		$result = unique_check('email', $_POST['email']);
	}
}

echo (int)$result;

?>