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