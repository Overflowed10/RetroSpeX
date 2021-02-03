<?php 
require('../partials/head.php');
require('../partials/navbar.php');
require('../../controller/MeetingController.php');

setlocale(LC_TIME, "de_DE");

?>

<main class="col-sm-9 col-lg-10">
    <?php include('../partials/meeting.overview.navbar.php');

        $db = new Database();
        $pdo = $db->connect();

            
        $sql = "SELECT * FROM `teams` WHERE id =".$_GET['id'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $status = $stmt->Fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM meeting WHERE team_id=? ORDER BY date ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($_GET['id']));
        $meetingsPlan = $stmt->fetchAll();
        
        if(!$status['deactivated']) {

        if(count($meetingsPlan) > 0){
            $nextMeeting = getFirstDateBiggerThanToday($meetingsPlan);  
            if (!empty($nextMeeting)){
                $nextDate = $nextMeeting['date'];
                ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-2 pl-0">
                <h5>Nächste Retrospektive:</h5>
            </div>
            <div class="col-md-10 meeting-box">
                <div class="container-fluid">
                    <div class="row my-auto">
                    
                        <div class="col my-auto text-center"><?php echo $nextMeeting['name']?></div>
                        <div class="col my-auto text-center">Geplant</div>
                        <div class="col my-auto text-center"><?php echo strftime('%A, %d.%m.%Y, %H:%M', strtotime($nextDate))?></div>
                        <!-- Hier Link zu Meeting-Start -->
                        <form action="../../controller/startMeetingSession.php?id=<?php echo $_GET['id']?>&name=<?php echo $_GET['name']?>&retroId=<?php echo $nextMeeting['id']?>&retroName=<?php echo $nextMeeting['name']?>" method="POST">
                            <div class="col my-auto text-center">
                            <button type="submit" class="badge badge-primary">Starten</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }} ?>

    <br>
    <h3>Geplante Retrospektiven</h3>
    <?php foreach($meetingsPlan as $meetingP) :
    if($meetingP['team_id'] === $_GET['id']){  
         $dateP = $meetingP['date'];
         if($dateP > $date_now && $meetingP['current_state'] != 8) {?>
        <div class="container-fluid mt-3 px-0">
        <div class="container-fluid meeting-box">
            <div class="row justify-content-between">

                <div class="col my-auto text-center"><?php echo $meetingP['name']?></div>
                <div class="col my-auto text-center"><?php echo strftime('%A', strtotime($dateP))?></div>
                <div class="col my-auto text-center"><?php echo strftime('%d.%m.%Y', strtotime($dateP))?></div>
                <div class="col my-auto text-center"><?php echo strftime('%H:%M', strtotime($dateP))?></div>
                
                <div class="col my-auto text-center">
                </div>
            </div>
        </form>  
        </div>
    </div>
    <?php
         }
        }
     endforeach;
        ?>
    
    <br>
     
<?php } else {
    echo "<br><h2 style='color:red'>Team deaktiviert</h2>";
}
?>
    <h3>Historie</h3>
    <?php 
    $sql = "SELECT * FROM meeting ORDER BY `date` DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $meetings = $stmt->fetchAll();
     foreach($meetings as $meeting) : 
        if($meeting['team_id'] === $_GET['id']){
            $date = $meeting['date'];
            if($date < $date_now || $meeting['current_state'] == 8) {?>
           <div class="container-fluid mt-3 px-0">
           <div class="container-fluid meeting-box">
           
               <div class="row justify-content-between collapsible-meeting">      
                   <div class="col my-auto text-center"><?php echo $meeting['name']?></div>
                   <div class="col my-auto text-center"><?php echo strftime('%A', strtotime($date))?></div>
                   <div class="col my-auto text-center"><?php echo strftime('%d.%m.%Y', strtotime($date))?></div>
                   <div class="col my-auto text-center"><?php echo strftime('%H:%M', strtotime($date))?></div>
                   <div class="col my-auto text-center"><i class="fa fa-caret-left fa-3x" aria-hidden="true"></i></div>
               </div>
               
               <div class="hidden-content">
                   <hr>
                   <div class="container-fluid">
                        <?php echo'<a target="_blank" href="../../controller/createPdf.php?id='.$meeting['id'].'">';?>
                            <button type="submit" class="btn float-right">
                                <i class="fa fa-floppy-o fa-2x float-right" aria-hidden="true"></i>
                            </button>
                        </a> 
                   </div>
                   <div class="container-fluid">
                       <h6 class="summary_title">Zusammenfassung:</h6>
                       <?php 
                        $sql = "SELECT * FROM summary s JOIN category c ON s.category_id=c.id WHERE s.meeting_id =?";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array($meeting['id']));
                        $summaries = $stmt->fetchAll();
                        if(empty($summaries)){
                            echo "<br>";
                        }

                       foreach($summaries as $summary): ?>
                       <div class="container-fluid">
                            
                       <p><b><i><h6><?php echo "Kategorie: ".$summary['name']?></h6></i></b>
                           <b>Soll-Zustand:</b> <?php echo $summary['target_state']?><br>
                           <b>TODO:</b> <?php echo $summary['todo']?></p>
                                <?php

                                    if(isMod()){
                                        $sql = "SELECT * FROM `answer` a JOIN `users` u ON u.id=a.user_id JOIN question q ON q.id=a.question_id WHERE a.meeting_id=? AND a.category_id=? ORDER BY a.question_id ASC";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute(array($meeting['id'], $summary['category_id']));
                                        $answers = $stmt->fetchAll();
                                        ?>
                                        <h6>Antworten:</h6>
                                        <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col"> Frage </th>
                                                <th scope="col"> Vorname </th> 
                                                <th scope="col"> Nachname </th>
                                                <th scope="col"> Antwort </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($answers as $answer):?>
                                                    <tr>
                                                        <td><?php echo $answer['question'];?></td>
                                                        <td><?php echo $answer['firstname'];?></td>
                                                        <td><?php echo $answer['lastname'];?></td>
                                                        <td><?php echo $answer['content'];?></td>
                                                    </tr>
                                                <?php
                                                endforeach;
                                            
                                            ?>
                                            </tbody>
                                            </table>
                                    <?php
                                    } 
                                ?>
                           </div>
                       <?php
                       endforeach;
                       ?>
                    
                   </div>
               </div>
           </div>
       </div>
       <?php
            }
        }
        endforeach;?>
    


    <!-- Script: Collapsibles -->
    <script>collapseMeetingBox()</script>
   
</main>
<?php include('../partials/footer.php'); ?>