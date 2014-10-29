<?php
session_start();
require_once 'database.php';

/**
 * Add a comment to a post
 * @param int    $post_id The post ID
 * @param int    $user_id The user ID
 * @param string $comment The comment body
 * @return bool|array Returns assoc array of the comment data if successful
 */
function add_comment($post_id, $user_id, $comment)
{
    $data = array(
        '`post_id`'    => (int)$post_id,
        '`body`'       => '"' . addslashes($comment) . '"',
        '`user_id`'    => (int)$user_id,
        '`created_ts`' => time(),
    );

    $insert_query = 'INSERT ' . TBL_COMMENTS . '(' . implode(',', array_keys($data)) . ') VALUES (' . implode(',', array_values($data)) . ')';

    if($result = mysql_query($insert_query))
    {
        $comment_id       = mysql_insert_id();
        $select_query  = 'SELECT c.*, u.username
                            FROM ' . TBL_COMMENTS . ' c
                            JOIN '.TBL_USERS.' u
                                ON u.`user_id` = c.`user_id`
                            WHERE c.`comment_id`=' . (int)$comment_id;
        $select_result = mysql_query($select_query);
        $row           = mysql_fetch_assoc($select_result);

        return $row;
    }

    return FALSE;
}

/**
 * Get all comments for a post.
 * @param int $post_id POST ID
 * @return array Returns an array of all comments belonging to a post
 */
function get_post_comments($post_id)
{
    $select_query = 'SELECT c.*, u.username
                      FROM '.TBL_COMMENTS.' c
                      JOIN '.TBL_USERS.' u
                        ON u.`user_id` = c.`user_id`
                      WHERE c.`post_id`='.(int)$post_id.'
                      ORDER BY c.`created_ts` ASC';

    $comments = array();
    $results = mysql_query($select_query);
    while($row = mysql_fetch_assoc($results))
    {
        $comments[] = $row;
    }

    return $comments;
}

/**
 * @param int $comment_id Comment ID
 * @return bool
 */
function delete_comment($comment_id)
{
    $delete_query = 'DELETE FROM '.TBL_COMMENTS.' WHERE `comment_id`='.(int)$comment_id;
    if($result = mysql_query($delete_query))
    {
        return TRUE;
    }

    return FALSE;
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