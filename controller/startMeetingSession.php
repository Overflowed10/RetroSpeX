<?php
include('../core/Database.php');
require('../model/User.php');

session_start();
$db = new Database();
$pdo = $db->connect();

$sql = "SELECT * FROM `meeting` WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($_GET['retroId']));
$_SESSION['meeting'] = $stmt->fetch();

$sql = "SELECT * FROM `teams_users` WHERE `team_id` = ? AND `user_id` = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($_GET['id'], $_SESSION['user']->id));
$currentUser = $stmt->fetch();


if($currentUser['local_role'] === 'moderator' || $_SESSION['user']->globalRole == "admin" ||
($_SESSION['meeting']['tmp_mod'] != null && $currentUser['user_id'] === $_SESSION['meeting']['tmp_mod'])){
    $_SESSION['ref'] = true;
} 

if(isset($_SESSION['ref'])){
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE `meeting` SET `current_state` = ?, `date` = ? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(1, $date, $_GET['retroId']));
}

$_SESSION['autorefresh'] = "longrefresh";

header("Location: ../view/php/meeting.waiting_area.mod.php?id=".$_GET['id']."&name=".$_GET['name']."&retroId=".$_GET['retroId']."&retroName=".$_GET['retroName']);

