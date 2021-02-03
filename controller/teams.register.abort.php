<?php

include('../core/Database.php');

$db = new Database();
$pdo = $db->connect();
session_start();

if(isset($_GET['teamId'])) {
$sql = "DELETE FROM `teams` WHERE id = ('" . $_GET["teamId"] . "')";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$sql = "DELETE FROM `teams_users` WHERE team_id = ('" . $_GET["teamId"] . "')";
$stmt = $pdo->prepare($sql);
$stmt->execute();

}

$_GET['teamId'] = null;

echo $_GET['destination'];


if(isset($_GET['destination'])) {
    switch(intval($_GET['destination'])) {
        case 1 : header('Location: ../view/php/overview.view.php'); break;
        case 2 : header('Location: ../view/php/teams.view.php'); break;
        case 3 : header('Location: ../view/php/users.view.php'); break;
        case 4 : header('Location: ../view/php/settings.view.php'); break;
        case 5 : header('Location: ../view/php/help.view.php'); break;
        case 6 : header('Location: ../../controller/logout.php'); break;
        default:  header('Location: ../view/php/teams.view.php'); break;
    }
} else {
    header('Location: ../view/php/teams.view.php');
}

?>