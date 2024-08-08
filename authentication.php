<?php
session_start();

$session_timeout = 60; 


if (isset($_SESSION['last_activity'])) {
    $inactive = time() - $_SESSION['last_activity']; 
    if ($inactive > $session_timeout) {
        
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}


$_SESSION['last_activity'] = time();


if(!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Please Login to Access User Dashboard!"; 

    header("Location: login.php"); 
    Exit(0); 
}
?>
