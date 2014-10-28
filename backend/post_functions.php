<?php
session_start();
require_once 'database.php';

function add_comment($post_id, $comment, $user_id)
{
    $data = array(
        '`post_id`'    => (int)$post_id,
        '`body`'       => '"' . addslashes($comment) . '"',
        '`user_id`'    => (int)$user_id,
        '`created_ts`' => time(),
    );

    $insert_query = 'INSERT ' . TBL_POSTS . '(' . implode(',', array_keys($data)) . ') VALUES (' . implode(',', array_values($data)) . ')';
}

/*
 * Update a post
 * @param int    $post_id Post Id
 * @param string $title
 * @param string $body
 * @param int    $user_id
 * @param string $picture
 * @return array|bool Returns an array of the updated post if successful. Returns boolean FALSE otherwise.
 */
function update_post($post_id, $title, $body, $user_id, $picture = '')
{
    global $db_link;

    $data = array(
        '`title` = "' . addslashes($title) . '"',
        '`body` = "' . addslashes($body) . '"',
        '`user_id` = ' . (int)$user_id,
        '`picture` = "' . addslashes($picture) . '"',
        '`created_ts` = ' . time(),
    );

    // INSERT `posts`(`title`,`body`,`user_id`,`picture`,`created_ts`)
    $insert_query = 'UPDATE ' . TBL_POSTS . '
                        SET ' . implode(',', $data) . '
                        WHERE `post_id`=' . (int)$post_id;

    //echo $insert_query;
    if ($result = mysql_query($insert_query))
    {
        if (mysql_affected_rows() > 0)
        {
            $select_query  = 'SELECT * FROM ' . TBL_POSTS . ' WHERE post_id=' . (int)$post_id;
            $select_result = mysql_query($select_query);
            $row           = mysql_fetch_assoc($select_result);

            return $row;
        }
    }

    return FALSE;
}

/*
 * Add a post to the blog
 * @param string $title
 * @param string $body
 * @param int    $user_id
 * @param string $picture
 * @return array|bool Returns an array of the newly-created post if successful. Returns boolean FALSE otherwise.
 */
function add_post($title, $body, $user_id, $picture = '')
{
    global $db_link;

    $data = array(
        '`title`'      => '"' . addslashes($title) . '"',
        '`body`'       => '"' . addslashes($body) . '"',
        '`user_id`'    => (int)$user_id,
        '`picture`'    => '"' . addslashes($picture) . '"',
        '`created_ts`' => time(),
    );

    // INSERT `posts`(`title`,`body`,`user_id`,`picture`,`created_ts`)
    $insert_query = 'INSERT ' . TBL_POSTS . '(' . implode(',', array_keys($data)) . ') VALUES (' . implode(',', array_values($data)) . ')';

    //echo $insert_query;
    if ($result = mysql_query($insert_query))
    {
        $post_id       = mysql_insert_id();
        $select_query  = 'SELECT * FROM ' . TBL_POSTS . ' WHERE post_id=' . (int)$post_id;
        $select_result = mysql_query($select_query);
        $row           = mysql_fetch_assoc($select_result);

        return $row;
    }

    return FALSE;
}

/*
 * Get all posts if no id is passed in. Return just the post belonging to id if passed in.
 * @param int $id    Post id. OPTIONAL
 * @param int $page  Page number. Starting from 0
 * @param int $limit Number of results to return per page
 * @return array Returns an array of all posts that are matched
 */
function get_post($id = NULL, $page = 0, $limit = 10)
{
    $select_query = 'SELECT p.*, u.username
                      FROM ' . TBL_POSTS . ' p';

    $select_query .= ' JOIN ' . TBL_USERS . ' u
                    ON u.`user_id` = p.`user_id`';

    if ($id !== NULL)
    {
        $select_query .= ' WHERE p.`post_id`=' . (int)$id;
    }

    $select_query .= ' ORDER BY p.`created_ts` DESC
                        LIMIT '.$page.','.$limit;

    $result = mysql_query($select_query);

    $posts = array();
    while ($row = mysql_fetch_assoc($result))
    {
        $posts[] = $row;
    }

    return $posts;
}

/*
 * Delete a post based on its ID
 * @param int $id Post ID
 * @return bool Returns TRUE on successful deletion. False otherwise.
 */
function delete_post($id)
{
    $delete_query = 'DELETE FROM ' . TBL_POSTS . ' WHERE `post_id`=' . (int)$id;
    if ($result = mysql_query($delete_query))
    {
        return TRUE;
    }

    return FALSE;
}