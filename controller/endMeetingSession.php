<?php
require('../model/User.php');
include('../core/Database.php');

$db = new Database();
$pdo = $db->connect();

session_start();

if(isset($_SESSION['ref'])){

    $sql = "UPDATE `meeting` SET `current_state` = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(8, $_GET['retroId']));

    unset($_SESSION['ref']);  
}


unset($_SESSION['meeting']);
unset($_SESSION['autorefresh']);


header("Location: ../view/php/meeting.view.php?id=".$_GET['id']."&name=".$_GET['name']);