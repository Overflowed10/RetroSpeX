<?php include('../core/Database.php'); ?>

<?php 
if (isset($_POST["presenterBtn"]) && !empty($_POST["presenterSelect"])){
    
    $db = new Database();
    $pdo = $db->connect();

    // SELECT answers for selected user
    $sql = "SELECT `answer`.`id` FROM answer WHERE `answer`.`user_id`= ? AND `answer`.`meeting_id` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($_POST["presenterSelect"], $_POST["retroId"]));    
    $presenterAnswerIds = $stmt->fetchAll();

    // SET Answerstate to 2 for all answerstates that are 1 at the moment
    $sql = "UPDATE `answer` SET `answer_state`= 2 WHERE `answer`.`answer_state` = ? and `answer`.`meeting_id` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(1, $_POST["retroId"]));  
    
    // SET answerstate to 1 for chosen presenter
    foreach ($presenterAnswerIds as $answerId){
        $sql = "UPDATE `answer` SET `answer_state`= 1 WHERE `answer`.`id` = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($answerId["id"]));   
    }   
    header('Location: ../view/php/meeting.erkenntnisse_entwickeln.view.php?id='.$_POST['id'].'&name='.$_POST["name"].'&retroId='.$_POST["retroId"].'&retroName='.$_POST["retroName"].'');
}
?>
