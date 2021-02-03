<?php 
require('../partials/meeting.head.php');
require('../partials/meeting.top_navbar.php');
require('../partials/progressbar/progressbar.phase5.php');
include('../../controller/MetaanswerController.php');


$db = new Database();
$pdo = $db->connect();   

if(isset($_POST['next'])){ 
    if(isset($_SESSION['ref'])){
        setCurrentState($_GET['retroId'], 7);
    }
    $sql = "SELECT * FROM meeting WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($_GET['retroId']));
    $meeting = $stmt->fetch();
    if($meeting['current_state'] === "7"){
        $_SESSION['autorefresh'] = "refresh";
        header('Location: meeting.metaanswers_result.php?id='.$_GET['id'].'&name='.$_GET['name'].'&retroId='.$_GET['retroId'].'&retroName='.$_GET['retroName']);
    }
    
}
?>

<form action="" method="POST">
    <div class="container-fluid text-right">
    <input type="hidden" name="next">
    <button type="submit" class="btn btn-green mr-5">Zum Abschluss</a>
    </div> 
</form>

<?php

$meetingId = $_GET['retroId'];
$userId = $_SESSION['user']->id;


$sql = "SELECT * FROM `metaquestion` WHERE `metaquestion`.meeting_id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute(array($meetingId));
$result = $stmt->fetchAll();
$metaquestionCount = count($result);


if(isset($_POST['save_metaanswers'])){

    $sql = "SELECT * FROM `metaanswer` WHERE `metaanswer`.meeting_id = ? AND `metaanswer`.user_id = ?"; 

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($meetingId, $userId));
    $metaanswers = $stmt->fetchAll();

    if(empty($metaanswers)){
        $values = $_POST["rangeval"];

        
        for($i = 0; $i < $metaquestionCount; $i++){
            $metaquestionId = $result[$i]["id"];
            $selection = $values[$i];
            if($selection){
                if(trim($selection) != ""){
                   
                saveMetaanswer($selection, $metaquestionId, $meetingId, $userId);
                }
             }
        }
    }

}

?>


<form action="meeting.metaanswers.php?id=<?php echo $_GET['id']?>&name=<?php echo $_GET['name']?>&retroId=<?php echo $_GET['retroId']?>&retroName=<?php echo $_GET['retroName']?>" method="POST">
    <div class="form-group container metaquestion-box mt-3">
        <br>
        <h4 class="metaquestion-title text-center">Metafragen</h4>
        <br>

        <?php
        
            for($i = 0; $i < $metaquestionCount; $i++){

                $metaquestion = $result[$i]["question"];
                echo "
                <h5 class='text-center'>".$metaquestion."</h5>
                <div class='slidecontainer'>
                    <input name='rangeval[]' type='range' min='1' max='10' value='5' class='slider' id='rangeval[]'>
                    <p class='rangeSliderText'>Bewertung: <span id='demo[]'>5</span></p>           
                </div> 
                ";
                echo "<script src='../js/rangeslider.js'></script>";  
            }
                 
        ?>
    </div>
    <div class="container my-4 text-center">
        <button id="save_metaanswers" name="save_metaanswers" type="submit" class="btn btn-primary">Alle Antworten senden</button>
    </div>
</form>
  


</body>

</html>