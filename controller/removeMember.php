<?php

include('../core/Database.php');

session_start();

    $teamId = $_GET['id'];
    $name = $_GET['name'];


if(isset($_POST['rem']) & $_POST['rem'] != "none") {



    $db = new Database();
    $pdo = $db->connect();

    $sql = "SELECT * FROM `teams_users` WHERE local_role = 'mitarbeiter' AND team_id = ".$_GET['id'];
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo count($members);

    $email = $_POST['rem'];
    $sql = "SELECT * FROM users WHERE email = '".$_POST['rem']."'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    $uid = $row['id'];

    if(count($members) > 1) {

        $sql = "DELETE FROM `teams_users` WHERE user_id = ".$uid." AND team_id = ".$_GET['id']." AND NOT local_role = 'moderator'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        header('Location: ../view/php/teams.edit.view.php?id='.$teamId.'&name='.$name);

    } else {

        header('Location: ../view/php/teams.edit.view.php?id='.$teamId.'&name='.$name.'&empty=true');

    }
  
} else {
    header('Location: ../view/php/teams.edit.view.php?id='.$teamId.'&name='.$name."&userinput=false");
}
?>