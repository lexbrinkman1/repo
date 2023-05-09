<?php
// Initialize the session
session_start();
require_once "./autoloader.php";

// Get URI and remove basepath
$_GET['basepath'] = dirname($_SERVER['PHP_SELF']);
if ($_GET['basepath'] == "/" || $_GET['basepath'] == "\\") {
    $_GET['basepath'] = "";
}
$_GET['imgpath'] = dirname(dirname($_SERVER['PHP_SELF']));
$uri = substr($_SERVER['REQUEST_URI'], strlen($_GET['basepath']));

// Check for query
if (strstr($uri, '?')) {
// remove querystring
    $uri = substr($uri, 0, strpos($uri, '?'));
}

// seperate URI
$params = explode("/", trim($uri, "/"));

// walk through params
foreach ($params as $key => $value) {
    $_GET['v' . $key] = trim($value);
}


// select page based on parameter
switch ($_GET['v0']) {
    case 'authentication':
    include_once 'view/auth/auth.php';
    break;
    case 'logout':
    include_once 'view/auth/logout.php';
    break;
    case 'account':
    include_once 'view/account.php';
    break;
    default:
    if (isset($_SESSION["loggedin"])) {
        include_once 'view/index.php';
    } else {
        include_once 'view/auth/auth.php';
    }
}