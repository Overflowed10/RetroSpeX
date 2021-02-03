<?php

include('../core/Database.php');
include('../core/config.php');


function random_str(
    $length = 64,
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

$db = new Database();
$pdo = $db->connect();

$sql = "SELECT * FROM login INNER JOIN users ON users.login_id = login.id WHERE users.email = '" . $_POST['email'] . "'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$row = $stmt->Fetch(PDO::FETCH_ASSOC);

$loginid = $row['login_id'];
$lastname = $row['lastname'];

$randomPassword = random_str(8, 'abcdefghijklmnopqrstuvwxyz');
$encrypted = password_hash($randomPassword, PASSWORD_DEFAULT);

$sql = "UPDATE `login` SET `password`= '" . $encrypted . "' WHERE `id` = " . $loginid; 
$stmt = $pdo->prepare($sql);
echo $stmt->execute();
    
$email = $_POST["email"];
$subject = "Ihr neues RetroSpex Passwort";
$message = "Sehr geehrte/r Herr/Frau " . $lastname . ", \n\nHier erhalten Sie Ihr angefordertes neues Passwort. Auf " . gethostbyaddr($config["host"]) . " können Sie sich mit Ihrer Email-Adresse und folgenden Passwort anmelden: \n\t" . $randomPassword . "\n Aus Sicherheitsgründen empfehlen wir Ihnen das Passwort direkt unter \"Einstellungen\" zu ändern. \n\nMit freundlichen Grüßen\nDer RetroSpex Passwortmanager";
$headers = "FROM:" . "RetroSpeX" . " " . "Passwortmanager" . " <iis.wi.proj@gmail.com>";

if ($db_config['env'] == "production") {
    $success = mail($email ,$subject, $message, $headers);
}
    

if($success) {
    echo "success";
    header('Location: ../view/php/login.view.php?mail=sent');
} else {
    echo "failed";
    header('Location: ../view/php/login.view.php?mail=failed');
}