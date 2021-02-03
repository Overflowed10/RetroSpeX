<?php include('../core/Database.php'); ?>

<?php 
$db = new Database();
$pdo = $db->connect();

$sql = "SELECT c.name FROM category c where c.meeting_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($_POST["cat_meetingId"]));
$result = $stmt->fetchAll();

if (!in_array($_POST["categoryName"], $result)){
    $sql = "INSERT INTO `category`(`name`, `meeting_id`) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($_POST["categoryName"], $_POST["cat_meetingId"]));
}
?>