<?php
require_once '../backend/sessions.php';
require_once '../backend/user_functions.php';

$result = false;
if(isset($_POST['id']) AND !empty($_POST['id'])) {
	$result = delete_user($_POST['id']);
}

echo (int)$result;
?>