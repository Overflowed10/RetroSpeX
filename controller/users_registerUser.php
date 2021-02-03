<?php 
session_start();
include('../core/Database.php');
include('../core/config.php');

if ($db_config['env'] == "development") {
    $config = $db_config['development'];
}elseif ($db_config['env'] == "production") {
    $config = $db_config['production'];
}else{
    die("Environment must be either 'development' or 'production'.");
}

$db = new Database();
$pdo = $db->connect();

$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();


if ($users != NULL){
    $email_exists = FALSE;
    foreach ($users as $user){
        echo $user["email"];
        if ($_GET['email'] == $user["email"]){
            $email_exists = TRUE;
            break;
        }
    }
}
if (!$email_exists){
    /* Generating password */
    $alphabet = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    $pw = "";
    for ($i=0; $i<8; $i++) {
        $pw .= $alphabet[random_int(0,61)];
    }

    /* CREATE login and user */
    $sql = "INSERT INTO `login` (`password`) VALUES (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(password_hash($pw, PASSWORD_DEFAULT)));
    $login_PK = $pdo->lastInsertId();

    $global_Role = $_GET['globalRole'] == "Administrator" ? "admin" : "user";
    $sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `global_role`, `login_id`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($_GET['firstname'], $_GET['lastname'], $_GET['email'], $global_Role, $login_PK));

    $email = $_GET["email"];
    $subject = "Ihr neues RetroSpex Nutzerkonto";
    $message = "Sehr geehrte/r Herr/Frau " . $_GET['lastname'] . ", \n\nIhr neues RetroSpex Konto wurde soeben eröffnet. Auf " . gethostbyaddr($config["host"]) . " können Sie sich mit Ihrer Email-Adresse und folgenden Passwort anmelden: \n\t" . $pw . "\n Aus Sicherheitsgründen empfehlen wir Ihnen das Passwort direkt unter \"Einstellungen\" zu ändern. \n\nMit freundlichen Grüßen\nDer RetroSpex Passwortmanager";
    $headers = "FROM:" . "RetroSpex" . " " . "Passwortmanager" . " <iis.wi.proj@gmail.com>";

	if ($db_config['env'] == "production") {
        mail($email ,$subject, $message, $headers);
    }

    header('Location: ../view/php/users_register.view.php?userCreated=True');

} else {
    /* E-Mail existiert bereits */
    header('Location: ../view/php/users_register.view.php?userCreated=False');
}

?>