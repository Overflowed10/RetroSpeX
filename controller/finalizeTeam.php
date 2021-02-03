<?php

include('../core/Database.php');

$db = new Database();
$pdo = $db->connect();
session_start();

$sql = "SELECT * FROM  teams_users WHERE local_role = 'mitarbeiter' AND team_id = ".$_GET['teamId'];
$stmt = $pdo->prepare($sql);
$stmt->execute();
$teams_users = $stmt->FetchAll(PDO::FETCH_ASSOC);


if (count($teams_users) > 0){
    $_GET['teamId'] = null;
    header('Location: ../view/php/teams.view.php');
} else {
    header('Location: ../view/php/teams.register.members.view.php?finalizeTeam=false&teamId='.$_GET['teamId'].'&modId='.$_GET['modId']);
}
