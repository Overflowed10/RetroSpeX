<?php 
require('../partials/meeting.head.php');
require('../partials/meeting.top_navbar.php');
require('../partials/progressbar/progressbar.phase5.php');
include('../../controller/MetaquestionController.php');


$db = new Database();
$pdo = $db->connect();   


if(isset($_POST['next'])){ 
    if(isset($_SESSION['ref'])){
        setCurrentState($_GET['retroId'], 6);

    }
    $sql = "SELECT * FROM meeting WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($_GET['retroId']));
    $meeting = $stmt->fetch();
    if($meeting['current_state'] === "6"){
        header('Location: meeting.metaanswers.php?id='.$_GET['id'].'&name='.$_GET['name'].'&retroId='.$_GET['retroId'].'&retroName='.$_GET['retroName']);
    }
    
}
?>

<?php
//wird noch mit autorefresh function eingeführt
//if(isset($_SESSION['ref'])){?>
    <form action="" method="POST">
        <div class="container-fluid text-right">
        <input type="hidden" name="next">
        <button type="submit" class="btn btn-green mr-5">Weiter</a>
        </div> 
    </form>
<?php //}?>


<?php


$meetingId = $_GET['retroId'];

if(isset($_POST['save_metaquestions'])){
    $metaquestions = $_POST["metaquestion"];
    
    foreach($metaquestions as $content){
        if($content){
            if(trim($content) != ""){
                saveMetaquestion($content, $meetingId);
            }
        }
    }
}

?>
<script src="../js/meeting.create_metaquestion.js"></script>

<main>
    <div class="container my-4 text-center">
        <button id="add_metaquestion" class="btn btn-primary">+</button>
    </div>
    <form action="" method="POST">

        <div class="form-group container metaquestion-box mt-3 after-metaquestion">
            <br>
            <h4 class="metaquestion-title text-center">Metafrage</h4>
            <br>
            <div class="input-group">
                <input name="metaquestion[]" type="text" class="form-control" placeholder="Frage stellen...">
            </div>
            
            <br>
        </div>
        <div class="copy hidden-metaquestion">
            <div class="form-group container metaquestion-box mt-3">
                <br>
                <h4 class="metaquestion-title text-center">Metafrage</h4>
                <br>
                <div class="input-group">
                    <input name="metaquestion[]" type="text" class="form-control" placeholder="Frage stellen...">
                    
                </div>
                <br>
            </div>
        </div>
        <div class="container my-4 text-center">
        <button id="save_metaquestions" name="save_metaquestions" type="submit" class="btn btn-primary">Alle Fragen senden</button>
    </div>
    </form>
    

</main>

</body>

</html>
