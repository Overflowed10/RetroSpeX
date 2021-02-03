<?php
require('../core/Database.php');

$db = new Database();
$pdo = $db->connect();
session_start();

$teamid = $_GET['id'];

$sql = "DELETE FROM `teams_users` WHERE team_id = ".$teamid;
$stmt = $pdo->prepare($sql);
$stmt->execute();


$sql = "UPDATE `teams` SET deactivated = true WHERE id = ".$teamid;
$stmt = $pdo->prepare($sql);
$stmt->execute();

header('Location: ../view/php/teams.view.php');

?>