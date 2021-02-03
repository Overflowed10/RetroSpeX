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

<?php 
function showStandard($url_params){
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
    <div class="container-fluid"> 
        <!-- SHOW Retroquestions and answercount for question -->
        <div id="standard-deck" class="card-deck justify-content-center my-5">
            <?php $qcounter = 1;
            foreach ($questions as $question): ?>
                <div class="standard-card">
                    <div class="container text-center cardSum">
                        <?php 
                            if (array_key_exists($question["id"], $counts)){
                                echo $counts[$question["id"]];
                            } else {
                                echo 0;
                            }   
                        ?>
                    </div>
                    <div class="card-body text-center">
                        <a class="card-link" href="#question<?php echo $qcounter; ?>">
                            <?php 
                            echo $question[0];
                            ?>    
                        </a>
                    </div>
                </div>
            <?php $qcounter++;
            endforeach ?>
        </div>
<?php } ?>