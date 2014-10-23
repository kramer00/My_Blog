<?php
require_once 'database.php';

/**
 * @param $email String User email
 * @param $username String Username
 * @param $password String User password
 * @return bool|string Returns a boolean TRUE if successfully added. Returns a string with error message if not.
 */
function add_user($email, $username, $password)
{
    global $db_link;

    $insert_query = 'INSERT '.TBL_USERS.'(`username`, `email`, `password`)
                        VALUES(
                            "'.addslashes($username).'",
                            "'.addslashes($email).'",
                            "'.addslashes($password).'")';


    if($result = mysql_query($insert_query))
    {
        return true;
    }
    return mysql_error();
}

/**
 * Pass in the username and password to log the user in
 * @param $username String
 * @param $password String
 * @return string
 */
function login_user($username, $password)
{
    global $db_link;

    $select_query = 'SELECT user_id, username, email FROM '.TBL_USERS.'
                        WHERE `username`="'.addslashes($username).'"
                        AND `password`="'.addslashes($password).'"';

    $result = mysql_query($select_query);
    if(mysql_num_rows($result) == 0)
    {
        return 'Invalid login credentials';
    }

    $row = mysql_fetch_assoc($result);
    return $row;
}