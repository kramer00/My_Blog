<?php

$response = '';

if(isset($_POST['username']) AND isset($_POST['email']) AND isset($_POST['password']))
{
    include '../backend/user_functions.php';
    $result = add_user($_POST['email'], $_POST['username'], $_POST['password']);

$response = $result;

}
else {
	$response = 'Required fields are missing';
}

echo $response;

?>