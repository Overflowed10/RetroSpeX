<?php
session_start();
$_SESSION = array();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {    
    require_once './core/config.php';
    header('Location: view/php/overview.view.php');
    
} else {
    header('Location: view/php/login.view.php');
}

