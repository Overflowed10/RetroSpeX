<?php require('../partials/head.php');
require('../partials/navbar.php');
require('../../controller/MeetingController.php');
?>

<main class="col-sm-9 col-lg-10">
    <?php require('../partials/meeting.overview.navbar.php');
    
    $db = new Database();
    $pdo = $db->connect();
    
    if(isset($_POST['saveMeeting']) && !empty($_POST['meetingName']) && !empty($_POST['no_of_cards']) && !empty($_POST['date']) && !empty($_POST['time'])){
        saveMeeting();
        header('Location: meeting.view.php?id='.$_GET['id'].'&name='.$_GET['name']);
    }

    if(isset($_POST['deleteMeeting']) && !empty($_POST['meetingId'])){
        deleteMeeting();
    }
    
    $sql = "SELECT * FROM `teams` WHERE id =".$_GET['id'];
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $status = $stmt->Fetch(PDO::FETCH_ASSOC);
    

    if(!$status['deactivated']) {
    ?>
    

    <div class="row">

        <!-- Meeting erstellen-->
        <div class="col-lg-6 col-xl-5 mt-3">
            <div class="container-fluid w-400 round-border">
                <h4 class="text-center">Retrospektive erstellen</h4>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="meetingName" class="mx-3 ">Titel:</label>
                        <input id="meetingName" type="text" class="form-control" name="meetingName" class="mw-400" placeholder="Titel eingeben" required>
                    </div>  

                    <div class="form-group">
                        <label for="anzKlebekarten" class="mx-3">Klebekartenanzahl: (pro Frage je Mitglied)</label>
                        <input id="anzKlebekarten" type="number" class="form-control" name="no_of_cards" min="1" max="10" placeholder="Klebekartenanzahl eingeben" required>
                    </div>

                    <div class="form-group">
                        <label for="tmpMod" class="mx-3">Vorübergehenden Moderator ernennen (optional):</label>
                        <select class="form-control" id="tmpMod" name="tmpMod">
                            <?php
                            $sql = "SELECT * FROM `users` u JOIN teams_users tu ON u.id = tu.user_id WHERE team_id=? AND local_role != 'moderator'";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(array($_GET['id']));
                            $users = $stmt->fetchAll(); ?>
                            <option hidden disabled selected value>-- Bitte wählen --</option>
                            <?php
                            foreach($users as $user):
                            ?><option value="<?php echo $user['id']?>"><?php echo $user['firstname']." ".$user['lastname']." ".$user['email']?></option> 
                            <?php endforeach;?>                      
                        </select>
                    </div> 

                    <div class="form-group">
                        <label for="datepicker" class="mx-3">Datum:</label>
                        <input id="datepicker" type="date" class="form-control" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="timepicker" class="mx-3">Uhrzeit:</label>
                        <input id="timepicker" type="time" class="form-control" name="time" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="retroType" class="mx-3">Retrospektiventyp:</label>
                        <select class="form-control" id="retroType" name="retroType">
                            <?php
                            $sql = "SELECT * FROM retrotype";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(array());
                            $retrotypes = $stmt->fetchAll(); 
                            foreach($retrotypes as $retrotype):
                            ?><option value="<?php echo $retrotype['id']?>"><?php echo $retrotype['name']?></option> 
                            <?php endforeach;?>                      
                        </select>
                    </div>        
                    <button class="btn btn-green mb-3" name="saveMeeting" type="submit">Retrospektive erstellen</button>
                </form>
            </div>
        </div>

        <div class="col-lg-6 col-xl-5 mt-3">
            <div class="container-fluid w-400 round-border">
                <h4 class="text-center">Retrospektive löschen</h4>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="retroArt" class="mx-3">Bitte wählen:</label>
                        <select class="form-control" id="meetingId" name="meetingId">
                        <?php 
                        $sql = "SELECT * FROM meeting";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array());
                        $meetings = $stmt->fetchAll();
                            foreach($meetings as $meeting):
                                if($meeting['team_id'] === $_GET['id']){
                            ?><option value="<?php echo $meeting['id']?>"><?php echo $meeting['name']." ".$meeting['date']?></option> 
                            <?php } endforeach;?> 
                        </select>
                    </div> 
                    <button name="deleteMeeting" type="submit" class="btn btn-red mb-3">Löschen</button>                                       
                </form>
            </div>
        </div>
    </div>
<?php } else {
    echo "<br><h2 style='color:red'>Team deaktiviert</h2>";
    }
?>
</main>
<?php require('../partials/footer.php'); ?>