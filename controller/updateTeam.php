<?php

include('../core/Database.php');

$db = new Database();
$pdo = $db->connect();

$sql = "UPDATE `teams` SET `teams`.name = '" . $_POST['teamname'] . "' WHERE `teams`.id = " . $_GET['id'];
$stmt = $pdo->prepare($sql);
$stmt->execute();


if($_POST['moderator'] != "none") {


$sql = "UPDATE `teams_users` SET local_role = 'mitarbeiter' WHERE local_role = 'moderator' AND team_id = " . $_GET['id'];
$stmt = $pdo->prepare($sql);
$stmt->execute();

$sql = "UPDATE `teams_users` INNER JOIN users ON user_id=users.id SET local_role = 'moderator' WHERE email = '". $_POST['moderator'] ."' AND team_id = " . $_GET['id'];
$stmt = $pdo->prepare($sql);
$stmt->execute();

}

header('Location: ../view/php/teams.edit.view.php?id='.$_GET['id'].'&name='.$_POST['teamname']);
