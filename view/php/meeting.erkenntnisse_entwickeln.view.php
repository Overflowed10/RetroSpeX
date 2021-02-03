<?php 
require('../partials/meeting.head.php');
require('../partials/meeting.top_navbar.php');?>

<div id="top_page">

<?php 
require('../partials/progressbar/progressbar.phase3.php');
include('../../controller/meeting.save_erkenntnisse.php')?>

<script src="../js/meeting.erkenntnisse_entwickeln.js"></script>

<?php
$db = new Database();
$pdo = $db->connect();

if(isset($_POST['next'])){ 
    if(isset($_SESSION['ref'])){
        setCurrentState($_GET['retroId'], 4);
        saveInsights();
    }
    $sql = "SELECT * FROM meeting WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($_GET['retroId']));
    $meeting = $stmt->fetch();
    if($meeting['current_state'] === "4"){
        if(isset($_SESSION['autorefresh'])){
            unset($_SESSION['autorefresh']);
        }
        header('Location: meeting.summary.php?id='.$_GET['id'].'&name='.$_GET['name'].'&retroId='.$_GET['retroId'].'&retroName='.$_GET['retroName']);
    }
    
}


    

    $url_params = array("id" => $_GET['id'], "name" => $_GET['name'], "retroId" => $_GET['retroId'], "retroName" => $_GET['retroName']);

    // CHECK for unpresented answer count
    $sql = "SELECT COUNT(`answer`.`id`) FROM `answer` WHERE `answer`.`answer_state` = 0 AND `answer`.`meeting_id` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($_GET["retroId"]));
    $allAnswersShown = $stmt->fetchAll()[0][0];
    $allAnswersShown = $allAnswersShown == 0;

    // GET retrospektiveId
    $sql = "SELECT m.retrotype_id FROM meeting m WHERE m.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($_GET["retroId"]));
    $meeting = $stmt->fetchAll()[0];
    $retro_identifier = $meeting["retrotype_id"];

    // GET questions according to retroId
    $sql = "SELECT `question`.`question`, `question`.`id` FROM `question` INNER JOIN `retrotype` ON `retrotype`.`id` = `question`.`retrotype_id`WHERE `retrotype`.`id` = ?";   
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($retro_identifier));
    $questions = $stmt->fetchAll();

    // GET answers according to meetingId
    $sql = "SELECT `answer`.`id`, `answer`.`question_id`, `answer`.`content`, `answer`.`answer_state`, `users`.`firstname`, `users`.`lastname` FROM `answer` INNER JOIN `meeting` ON `meeting`.`id` = `answer`.`meeting_id`
                INNER JOIN `users` ON `users`.`id`= `answer`.`user_id` WHERE `meeting`.`id` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($_GET["retroId"]));
    $answers = $stmt->fetchAll();

    // GET categories 
    $sql = "SELECT c.`name`, c.`id` FROM `category` c WHERE c.`meeting_id` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($_GET["retroId"]));
    $categories = $stmt->fetchAll();

?>
  <form action="" method="POST">
        <div class="container-fluid text-right mt-3">
        <input type="hidden" name="next">
        <button type="submit" class="btn btn-green">Nächste Phase</button>
        </div> 
    

<?php
    if ($retro_identifier == 1 || $retro_identifier > 4){
        require("../partials/methods/standard.php");
        showStandard($url_params);
    } else if ($retro_identifier == 2){
        require("../partials/methods/kalm.php");
        showKalm($url_params);
    } else if ($retro_identifier == 3){
        require("../partials/methods/fff.php");
        showFFF($url_params);
    } else if ($retro_identifier == 4){
        require("../partials/methods/starfish.php");
        showStarfish($url_params);
    }
?>
    <!-- SHOW Question and all corresponding answers -->
  

<?php 
    $qcounter = 1;
    foreach ($questions as $question): ?>
        <div class="placeholder" id="question<?php echo($qcounter); ?>"></div>
        <div class="container-fluid p-3 my-3 border text-center round-border">
            <?php echo '<h1>'.$question["question"].'</h1>'; ?>
            <div class="my-2 row">
                    <?php                     
                        foreach ($answers as $row):
                            if (!($row["question_id"] == $question["id"])){
                                continue;
                            } 
                            if($row["answer_state"] == 1){ ?>                
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 p-2">
                                    <div class="card karteHervorgehoben">
                            <?php } else if($row["answer_state"] == 2){ ?>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 p-2">
                                <div class="card bg-warning">
                            <?php } else {
                                continue;
                            } ?>

                                    <div class="form-group">
                                        <!-- SHOW card-header if Referent --></form>
                                        <?php if ((isset($_SESSION['ref']) && ($allAnswersShown == 1))): ?>
                                            <input type="hidden" name="selected_answerId[]" value="<?php echo $row["id"]; ?>">
                                            <div class="card-header">
                                                <select name="selected_category[]" class="custom-select">
                                                    <option value="0" disabled selected>Überkategorie auswählen</option>
                                                    <?php foreach($categories as $cat){
                                                        echo "<option value='".$cat["id"]."'>".$cat["name"]."</option>";
                                                        }?>
                                                </select>
                                            </div>
                                        <?php endif ?>

                                        <div class="card-body text-center">
                                            <?php echo '
                                            <p class="card-text">'.$row["content"].'</p>
                                            <h6>'.$row["firstname"].' '.$row["lastname"].'</h6>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                </div>
                <!-- TODO: highligting -->
        </div>

        <div id="ButtonBack" class="col text-left">
            <a href='#top_page'>
                <button type="button" class="btn btn-green">
                    Zurück</button>
            </a>
        </div>
<?php $qcounter++;
    endforeach; 
?>
    </form>
<?php
// SHOW Navbar bottom if referent
if (isset($_SESSION['ref'])):
?>
        <nav class="navbar fixed-bottom">
            <div class="container-fluid">
                <button type="button" onclick="hideAndShowUsers()" class="btn">
                    <img src="../pictures/user.png">
                </button>
                <button type="button" onclick="hideAndShowSettings()" class="btn">
                    <img src="../pictures/settings.png">
                </button>
            </div>
    
            <div id="users-fixedbottom" class="container-fluid">
                <div class="container-fluid">
                    <form action="../../controller/meeting.SetPresentingMember.php" method="POST">

                        <?php
                        // Answer-states: 0 = not presented, 1 = presenting, 2 = already presented
                        // GET Team-Members, whose answer-State = 0
                        $sql = "SELECT DISTINCT `users`.`id`, `users`.`firstname`, `users`.`lastname` 
                            FROM `users` 
                            INNER JOIN `answer` ON `answer`.`user_id` = `users`.`id`
                        WHERE `answer`.`meeting_id` = ? AND `answer`.`answer_state` = 0";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array($_GET["retroId"]));
                        $members = $stmt->fetchAll();
                        ?>

                        <h6>Präsentierender Mitarbeiter:</h6>
                        <select name="presenterSelect" id="leiste-custom-select">
                            <option selected disabled>Mitglied auswählen</option>
                            <?php foreach($members as $member){
                                echo "<option value='".$member["id"]."'>".$member["firstname"]." ".$member["lastname"]."</option>";
                            }?>                                
                        </select>
                        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
                        <input type="hidden" name="name" value="<?php echo $_GET["name"]; ?>">
                        <input type="hidden" name="retroId" value="<?php echo $_GET["retroId"]; ?>">
                        <input type="hidden" name="retroName" value="<?php echo $_GET["retroName"]; ?>">
                        <button name="presenterBtn" class="btn btn-secondary mb-1" type="submit">OK</button>
                    </form>
                </div>
            </div>
            
            <div id="settings-fixedbottom" class="container-fluid">
                <div class="column3">
                    <div class="container-fluid">
                        <form id="categoryForm" method="POST">
                            <h6>Überkategorie erstellen</h6>
                            <label for="categoryName">Name:</label>
                            <input id="categoryName" name="categoryName" type="text" style="border-radius: 25px;">
                            <input id="cat_meetingId" name="cat_meetingId" value="<?php echo $_GET["retroId"]; ?>" hidden>
                            <button id="catButton" class="btn btn-secondary mb-1" type="submit">OK</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
<?php endif ?>
    </body>
</html>