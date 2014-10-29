<?php
date_default_timezone_set('America/Los_angeles');
error_reporting(0);
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "blog");
define("TBL_USERS", "`users`");
define("TBL_POSTS", "`posts`");
define("TBL_COMMENTS", "`comments`");
define('PAGE_LOGIN', '/login.php');