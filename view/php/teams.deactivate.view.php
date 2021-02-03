<?php 
require('../partials/head.php');
require('../partials/navbar.php');
require('../../controller/MeetingController.php');

if(isset($_POST['saveMeeting']) && !empty($_POST['meetingName']) && !empty($_POST['no_of_cards']) && !empty($_POST['date']) && !empty($_POST['time'])){
    saveMeeting();
    header('Location: meeting.view.php?name='.$_GET['name'].'&id='.$_GET['id']);
}

if(isset($_POST['deleteMeeting']) && !empty($_POST['meetingId'])){
    deleteMeeting();
}

?>

<main class="col-sm-9 col-lg-10">
    <?php require('../partials/meeting.overview.navbar.php'); ?>


    
    <div class="col-lg-6 col-xl-12 mt-3 w-400 round-border">
            <div>
                <h4 class="text-center">Wollen Sie <?php echo $_GET['name']; ?> sicher deaktivieren?</h4>
                <h4 class="text-center">(Diese Änderung kann nicht rückgängig gemacht werden)</h4><br>
            </div>
                <div class="text-center">
                        <a href='teams.edit.view.php?name=<?php echo $_GET['name']."&id=". $_GET['id'];?>'>
                    <button class="btn btn-green mb-3" name="saveTeamChanges" >Zurück</button>
                    </a>
                        <a href="../../controller/deactivateTeam.php?name=<?php echo $_GET['name'].'&id='.$_GET['id'];?>">
                    <button class="btn btn-red mb-3" name="saveTeamChanges">Team deaktivieren</button>
                    </a>
                    </div>
        </div>

    </main>