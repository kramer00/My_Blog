<?php
include 'user_functions.php';

$username = 'thiman';
$password = 'asdfasdf';
$email = 'thi@thi.com';
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

$result = login_user($username, $password);
print_r($result);