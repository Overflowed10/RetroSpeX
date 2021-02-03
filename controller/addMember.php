<?php

include('../core/Database.php');


if(isset($_GET['teamId'])) {
    $teamId = $_GET['teamId'];
}

if(isset($_GET['id'])) {
    $teamId = $_GET['id'];
    $name = $_GET['name'];
}

if(isset($_GET['action'])) {
    if($_GET['action'] == 'remove') {
        header('Location: ../view/php/teams.edit.view.php?teamId='.$teamId.'&id='.$_GET['id']);
    }
}


if(isset($_GET['uid'])) {

    $db = new Database();
    $pdo = $db->connect();
    session_start();

    $uid = $_GET['uid'];

    $sql = "INSERT INTO `teams_users`(`user_id`, `team_id`, `local_role`) VALUES (" . $uid .", " . $teamId. ", 'mitarbeiter')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo $_GET['action'];
    if(isset($_GET['action'])) {
        
        header('Location: ../view/php/teams.edit.view.php?id='.$teamId.'&name='.$name);

    } else {
        header('Location: ../view/php/teams.register.members.view.php?teamId='.$teamId.'&modId='.$_GET['modId']);
    }
} else {

    

    if(isset($_GET['action'])) {
        header('Location: ../view/php/teams.edit.view.php?id='.$teamId.'&name='.$name."&userinput=false");

    } else {

        header('Location: ../view/php/teams.register.members.view.php?teamId='.$teamId.'&modId='.$_GET['modId']."&userinput=false");
    }
}


?>