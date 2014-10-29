<?php
include 'user_functions.php';
include 'post_functions.php';

$username = 'thiasdf';
$password = 'asdfasdf';
$email = 'thi@thi.com';

//$result = unique_check('username', $username);
//var_dump($result);

$post_id = 1;
$user_id = 1;
$body = 'Hi thar';

add_comment($post_id, $user_id, $body);

/*
$result = add_user($email, $username, $password);

if($result === TRUE)
{
    echo 'User added';
}
else
{
    echo $result;
}
*/

//$result = login_user($username, $password);
//print_r($result);


//add_post('Hi there', 'asdfasdfasdf', 5);