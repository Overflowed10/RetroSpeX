<?php
    session_start();
    include('../core/Database.php');

    $db = new Database();
    $pdo = $db->connect();

    $user_id = $_GET["userId"];

    // GET admin count
    $sql = 'SELECT COUNT(*) FROM `users` WHERE `global_role` = "admin"';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $admin_count = $stmt->fetchall()[0][0];

    // GET user info    
    $sql = "SELECT * FROM `users` WHERE `id` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($user_id));
    $user = $stmt->fetchall()[0];

    // EDIT user
    if(isset($_GET["edit-user-btn"])){
        $firstname = $_GET["firstname"];
        $lastname = $_GET["lastname"];
        $email = $_GET["email"];
        $globalRole = $_GET['globalRole'] == "Administrator" ? "admin" : "user";
        
        // CHECK if email already exists
        $sql = "SELECT email FROM `users` WHERE `email` = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($email));
        $emails = $stmt->fetchall();
        
        // IF More than one email with given name already exists
        if (count($emails) > 1){
            header('Location: ../view/php/users_edit.view.php?userEdited=False');
        }
        // CHECK if edited user is last admin and globalRole is changed to user OR user is sysadmin
        else if (($admin_count <= 1 && $user['global_role']=='admin' && $globalRole == 'user') || ($user_id == 1)){
            header('Location: ../view/php/users_edit.view.php?userEdited=False');        
        } 
        // IF one email with given name, but it is NOT the email of the user to be changed
        else if ((count($emails) == 1) && !($emails[0]["email"] == $email)) {
            header('Location: ../view/php/users_edit.view.php?userEdited=False');        
        }
        else {
        // CHANGE user attributes
        $sql = "UPDATE `users` SET `firstname`=?,`lastname`=?,`email`=?,`global_role`=? WHERE `id` = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($firstname, $lastname, $email, $globalRole, $user_id));
        header('Location: ../view/php/users_edit.view.php?userEdited=True');
        }
    }

    // DELETE user IF NOT last admin OR sysadmin
    if(isset($_GET["delete-user-btn"])){
        if (($admin_count <= 1 && $user['global_role']=='admin') || $user['id'] == 1){
            header('Location: ../view/php/users_edit.view.php?userEdited=False');
        } else {
        $sql = "SELECT login_id FROM `users` WHERE `id` = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($_GET["userId"]));
        $login_key = $stmt->fetchall()[0]["login_id"];

        $sql = "DELETE FROM `login` WHERE `login`.`id` = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($login_key));

        $sql = "DELETE FROM `users` WHERE `users`.`id` = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($_GET["userId"]));
        header('Location: ../view/php/users.view.php?userDeleted=True');
       }
    }     

?>