<?php

session_start();
if(isset($_SESSION['user'])){
    $_SESSION = array();

    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(), '', time() - 3600);
    }
}

session_destroy();
header('Location: ../view/php/login.view.php');
    
?>
