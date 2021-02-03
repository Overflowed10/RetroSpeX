<?php 
function countAnswersPerQuestion($answers){
    $counts = array();
    foreach ($answers as $answer){
        if (!array_key_exists($answer["question_id"], $counts)){
            $counts[$answer["question_id"]] = 1;
        } else {
            $counts[$answer["question_id"]]++;
        }
    }
    return $counts;
} 
?>

<?php function showStarfish($url_params){
    $db = new Database();
    $pdo = $db->connect();

    // GET retrospektiveId
    $sql = "SELECT m.retrotype_id FROM meeting m WHERE m.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($url_params['retroId']));
    $retro_identifier = $stmt->fetchAll()[0]["retrotype_id"];

    // GET questions according to retroId
    $sql = "SELECT `question`.`question`, `question`.`id` FROM `question` INNER JOIN `retrotype` ON `retrotype`.`id` = `question`.`retrotype_id`WHERE `retrotype`.`id` = ?";   
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($retro_identifier));
    $questions = $stmt->fetchAll();

    // GET answers according to meetingId
    $sql = "SELECT `answer`.`question_id`, `answer`.`content`, `users`.`firstname`, `users`.`lastname` FROM `answer` INNER JOIN `meeting` ON `meeting`.`id` = `answer`.`meeting_id`
                INNER JOIN `users` ON `users`.`id`= `answer`.`user_id` WHERE `meeting`.`id` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($url_params['retroId']));
    $answers = $stmt->fetchAll();

    // Answers per Question
    $counts = countAnswersPerQuestion($answers);
    ?>

    <div id="top_page">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="img">
                    <img id="Seestern" src="../pictures/seesternBild.png" class="img-fluid">
            </div>
<?php } ?>