<?php

include('../core/Database.php');
require('../model/User.php');

$db = new Database();
$pdo = $db->connect();
session_start();

if(isset($_POST['loginBtn']) && !empty($_POST['email']) && !empty($_POST['pwd'])) {
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    
    /* DB-Query*/
    $sql = "SELECT * FROM `login` INNER JOIN users ON users.login_id = `login`.id WHERE users.email=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(password_verify($password, $row['password'])){ 
        //save in session variable
        $user = new User($row["id"], $row["firstname"], $row["lastname"], $row["email"], $row["global_role"]);
        $_SESSION['user'] = $user; 
        $_SESSION['loggedIn'] = true;
        $_SESSION['csrf_token'] = uniqid('', true);
        header('Location: ../view/php/overview.view.php');
            
    } else {
        header('Location: ../view/php/login.view.php?password=false');
    }
}

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

?>
