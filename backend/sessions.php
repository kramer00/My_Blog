<?php
session_start();
ob_start();
if(file_exists(__DIR__.'/../constants.php')) {
    require_once __DIR__.'/../constants.php';
} else {
    require_once 'inc/constants.php';
}

// If the 'user' key in the session data is not present, then the user has not logged in.
// Redirect the user to the login page if that is the case.
if(!isset($_SESSION['user']) && strpos($_SERVER['REQUEST_URI'], PAGE_LOGIN) === FALSE) {
    header('Location: '.PAGE_LOGIN.'?url='.$_SERVER['REQUEST_URI']);
}