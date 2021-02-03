<?php

include('../core/Database.php');
require('../model/User.php');


$db = new Database();
$pdo = $db->connect();
session_start();

    /* DB-Query*/
    $sql = "SELECT * FROM `login` INNER JOIN users ON users.login_id = `login`.id WHERE users.id= " . $_SESSION['user']->getId();
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->Fetch(PDO::FETCH_ASSOC);

    $loginid = $row['login_id'];
    $old_pw = $_POST["old_pw"];   

    if(password_verify($old_pw, $row['password'])){ 
        if($_POST["new_pw1"] == $_POST["new_pw2"]) {
            $new_pw = $_POST["new_pw1"];
            $encrypted = password_hash($new_pw, PASSWORD_DEFAULT);

            $sql = "UPDATE `login` SET `password`= '" . $encrypted . "' WHERE `id` = " . $loginid; 
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            header('Location: ../view/php/overview.view.php?changedPassword=true');
        } else {
        header('Location: ../view/php/settings.view.php?changedPassword=false');
        }
            
    } else {
        header('Location: ../view/php/settings.view.php?changePassword=false');
    
}

?>