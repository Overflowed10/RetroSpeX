<?php

function isAdmin() {

    if($_SESSION['user']->globalRole === "admin") {
        return true;
    } else { 
        return false;
    }
}

function isMod() {

    $db = new Database();
    $pdo = $db->connect();

    $sql = "SELECT local_role FROM `teams_users` INNER JOIN users ON teams_users.user_id = users.id WHERE user_id = ". $_SESSION['user']->id." AND team_id = ".$_GET['id'];
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->Fetch(PDO::FETCH_ASSOC);

    if ($row) {
        if($row['local_role'] == 'moderator') {
            return true;
        } else { 
           return false;
        }
    } else {
        if(isAdmin()) {
            return true;
        } else {
            return false;
        }
    }

}
?>