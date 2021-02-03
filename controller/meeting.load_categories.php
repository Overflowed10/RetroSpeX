<?php include('../core/Database.php'); ?>

<?php 
$db = new Database();
$pdo = $db->connect();


$sql = "SELECT * FROM category c where c.meeting_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($_POST["cat_meetingId"]));
$answers = $stmt->fetchAll();
echo "|";
foreach($answers as $answer){
    echo $answer["name"]."°°".$answer["id"]."|";
}
?>