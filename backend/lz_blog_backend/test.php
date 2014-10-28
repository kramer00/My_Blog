<?php
include 'user_functions.php';
include 'post_functions.php';

$username = 'thiasdf';
$password = 'asdfasdf';
$email = 'thi@thi.com';

//$result = unique_check('username', $username);
//var_dump($result);
delete_post(3);
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