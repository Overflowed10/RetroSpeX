<?php 
require('../partials/meeting.head.php'); 
require('../partials/meeting.top_navbar.php');
require('../partials/progressbar/progressbar.phase5.php');
include('../../controller/MetaanswerController.php');

$db = new Database();
$pdo = $db->connect();   

$meetingId = $_GET['retroId'];
?>

<form action="../../controller/endMeetingSession.php?id=<?php echo $_GET['id']?>&name=<?php echo $_GET['name']?>&retroId=<?php echo $_GET['retroId']?>" method="POST">
    <div class="container-fluid text-right">
    <input type="hidden" name="next">
    <button type="submit" class="btn btn-green mr-5">Beenden</a>
    </div> 
</form>

<div class="form-group container metaquestion-box mt-3">
        <br>
        <h4 class="metaquestion-title text-center">Metafragen</h4>
        <br>
        <?php
        // Get all asked Metaquestions of the meeting
        $sql = "SELECT * FROM `metaquestion` WHERE `metaquestion`.meeting_id = ?";

        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($meetingId));
        $result = $stmt->fetchAll();
        $metaquestionCount = count($result);
        
            //evaluate for each metaquestion the average answer
            for($i = 0; $i < $metaquestionCount; $i++){
                $metaquestionId = $result[$i]["id"];
                $metaquestion = $result[$i]["question"];

                //get all answers of a metaquestion
                $sql = "SELECT * FROM `metaanswer` WHERE `metaanswer`.meeting_id = ? AND `metaanswer`.metaquestion_id = ?";

                $stmt = $pdo->prepare($sql);
                $stmt->execute(array($meetingId, $metaquestionId));
                $currentMetaanswers = $stmt->fetchAll();
                $currentMetaanswersCount = count($currentMetaanswers); 

                //iterate through all answers sum it up and devide it by the answercount
                $avg = 0;
                for($j = 0; $j < $currentMetaanswersCount; $j++){
                    $avg += $currentMetaanswers[$j]["selection"];
                }

                if($currentMetaanswersCount == 0){
                    $avg = 0;
                } else {

                    $avg /= $currentMetaanswersCount;
                    $avg = round($avg, 2);
                }

                echo "
                <h5 class='text-center'>".$metaquestion."</h5>
                <div class='slidecontainer'>
                    <input type='range' disabled=true min='1' max='10' value='".$avg."' class='slider' id='myRange".$i."'>
                    <p class='rangeSliderText'>Bewertung: <span id='demo".$i."'>".$avg."</span></p>           
                </div> 
                ";
            }
            echo "<script src='../js/rangeslider.js'></script>";  
  
        

        ?>
</div>
</body>
</html>