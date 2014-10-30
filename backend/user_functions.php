<?php
session_start();
require_once 'database.php';

/*
 * @param $email String User email
 * @param $username String Username
 * @param $password String User password
 * @return bool|string Returns a boolean TRUE if successfully added. Returns a string with error message if not.
 */
function add_user($email, $username, $password)
{
    global $db_link;
	
	$hashed_password = sha1($password);

    $insert_query = 'INSERT '.TBL_USERS.'(`username`, `email`, `password`)
                        VALUES(
                            "'.addslashes($username).'",
                            "'.addslashes($email).'",
                            "'.addslashes($hashed_password).'")';


    if($result = mysql_query($insert_query))
    {
        return true;
    }
    return mysql_error();
}

/*
 * Pass in the username and password to log the user in. Returns an array with the fields user_id, username, email on successful login
 * @param $username String
 * @param $password String
 * @return string|array Returns a string with error messages if any. Otherwise, returns array on successful login.
 */
function login_user($username, $password)
{
    global $db_link;

	$hashed_password = sha1($password);

    $select_query = 'SELECT user_id, username, email FROM '.TBL_USERS.'
                        WHERE `username`="'.addslashes($username).'"
                        AND `password`="'.addslashes($hashed_password).'"';

    $result = mysql_query($select_query);
    if(mysql_num_rows($result) == 0)
    {
        return 'Invalid login credentials';
    }

    $row = mysql_fetch_assoc($result);

    // Save the user's data into the 'user' key of our session data
    $_SESSION['user'] = $row;
    return $row;
}

/*
 * Get all users if no id is passed in. Return just the user belonging to id if passed in.
 * @param int $id User id. OPTIONAL
 * @return array Returns an array of all users that are matched
 */
function get_user($id = NULL)
{
    $select_query = 'SELECT user_id, username, email
                      FROM ' . TBL_USERS;

    if ($id !== NULL)
    {
        $select_query .= ' WHERE `user_id`=' . (int)$id;
    }

    $select_query .= ' ORDER BY `user_id` ASC';

    $result = mysql_query($select_query);

    $users = array();
    while ($row = mysql_fetch_assoc($result))
    {
        $users[] = $row;
    }

    return $users;
}

/*
 * Logs the user out by destroying $_SESSION['user']
 * @return bool
 */
function logout_session()
{
    unset($_SESSION['user']);
    session_destroy();
    return TRUE;
}

/*
 * Check whether a username or email is unique
 * @param string $field "username" or "email", the field to check for uniqueness
 * @param string $value Field value
 * @return bool Returns FALSE if entry is not unique. TRUE otherwise.
 */
function unique_check($field, $value)
{
    $select_query = 'SELECT user_id FROM '.TBL_USERS;
    switch($field)
    {
        case 'username':
            $select_query .= ' WHERE username="'.addslashes($value).'"';
            break;
        case 'email':
            $select_query .= ' WHERE email="'.addslashes($value).'"';
            break;
    }

    if($result = mysql_query($select_query))
    {
        if(mysql_num_rows($result) > 0)
        {
            return FALSE;
        }

        return TRUE;
    }

    return TRUE;
}

/**
 * Delete a user based on its ID
 * @param int $id User ID
 * @return bool Returns TRUE on successful deletion. False otherwise.
 */
function delete_user($id)
{
    $delete_query = 'DELETE FROM '.TBL_USERS.' WHERE `user_id`='.(int)$id;
    if($result = mysql_query($delete_query))
    {
        return TRUE;
    }

    return FALSE;
}

/**
 * Determines whether a user is logged in or not
 * @return bool
 */
function is_logged_in()
{
    return isset($_SESSION['user']);
}