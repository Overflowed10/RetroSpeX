<?php

include('../core/Database.php');

$db = new Database();
$pdo = $db->connect();
session_start();

if(!isset($_GET['teamId'])) {

$sql = "INSERT INTO `teams`(`name`) VALUES ('" . $_GET['name'] . "')";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$teamId = $pdo->lastInsertId();

$sql = "SELECT `id` FROM `users` WHERE email = '" . $_GET['moderator']. "'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$row = $stmt->Fetch(PDO::FETCH_ASSOC);

$modId = $row['id'];

$sql = "INSERT INTO `teams_users`(`user_id`, `team_id`, `local_role`) VALUES (" . $modId . ", " . $teamId . ",'moderator')";
$stmt = $pdo->prepare($sql);
$stmt->execute();

header('Location: ../view/php/teams.register.members.view.php?teamId='.$teamId.'&modId='.$modId);

} else {

$sql = "SELECT * FROM `teams_users` WHERE `teams_users`.local_role = 'mitarbeiter' AND `teams_users`.team_id = " . $_GET['teamId'] . " AND teams_users.user_id = ". $_GET['modId'];
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tomod = $stmt->Fetch(PDO::FETCH_ASSOC);

if ($tomod) {
    $sql = "DELETE FROM `teams_users` WHERE `teams_users`.local_role = 'mitarbeiter' AND `teams_users`.team_id = " . $_GET['teamId'] . " AND `teams_users`.user_id =". $_GET['modId'];
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

$sql = "DELETE FROM `teams_users` WHERE `teams_users`.local_role = 'moderator' AND `teams_users`.team_id = " . $_GET['teamId'];
$stmt = $pdo->prepare($sql);
$stmt->execute();

$sql = "UPDATE `teams` SET `teams`.name = '" . $_GET['name'] . "' WHERE `teams`.id = " . $_GET['teamId'];
$stmt = $pdo->prepare($sql);
$stmt->execute();

$sql = "INSERT INTO `teams_users` (user_id, team_id, local_role) VALUES (" . $_GET['modId'] . ", ". $_GET["teamId"]. ", 'moderator')";
$stmt = $pdo->prepare($sql);
$stmt->execute();

header('Location: ../view/php/teams.register.members.view.php?teamId='.$_GET['teamId'].'&modId='.$_GET['modId']);

}

?>