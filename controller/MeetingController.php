<?php
require('../../model/Meeting.php');
require('../../core/config.php');

$date_now = date('Y-m-d H:i:s');

function getFirstDateBiggerThanToday($meetingArray){
    $dateToShow = date('Y-m-d H:i:s', strtotime('-1 hour'));
    $found = false;
    foreach($meetingArray as $meeting) :  
        $date = $meeting['date'];
        if($date > $dateToShow && $meeting['current_state'] != 8) {
            $found = true;
            return $meeting;
        }
endforeach;
    if($found === false){
        return array();
    }
}

function saveMeeting(){
    $name = $_POST['meetingName'];
    $no_of_cards = $_POST['no_of_cards'];
    $tmp = strtotime($_POST['date'].' '.$_POST['time']);
    $date = date("Y-m-d H:i:s", $tmp);
    $retroTypeId = $_POST['retroType'];
    $teamId = $_GET['id'];
    if(!empty($_POST['tmpMod'])){
        $tmpMod = $_POST['tmpMod'];
    }else{
        $tmpMod = null;
    }
    $meeting = new Meeting($name, $no_of_cards, $date, $retroTypeId, $teamId, $tmpMod);
    Meeting::save($meeting);
    $db_config['database'] = require '../../core/config.php';
    if ($db_config["env"] == "production") {
        sendCreateEmail($teamId, $name, $_POST['date'], $_POST['time']);
    }
}

function deleteMeeting(){

    $meetingToBeDeleted = $_POST['meetingId'];
    $db_config['database'] = require '../../core/config.php';
	if ($db_config["env"] == "production") {
        sendDeleteEmail($meetingToBeDeleted);            
	}
    Meeting::delete($meetingToBeDeleted);
}

//this is for the moderator, who changes the states
function setCurrentState($meetingId, $input){
    switch ($input) {
        case 1:
            Meeting::updateStatus($meetingId, 1);
            break;
        case 2:
            Meeting::updateStatus($meetingId, 2);
            break;
        case 3:
            Meeting::updateStatus($meetingId, 3);
            break;
        case 4:
            Meeting::updateStatus($meetingId, 4);
            break;
        case 5:
            Meeting::updateStatus($meetingId, 5);
            break;
        case 6:
            Meeting::updateStatus($meetingId, 6);
            break;
        case 7:
            Meeting::updateStatus($meetingId, 7);
            break;
        
        default:
            break;
    }
}

function sendCreateEmail($teamId, $name, $date, $time){
    
    $db = new Database();
    $pdo = $db->connect();

    $sql = "SELECT * FROM teams WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($teamId));
    $team = $stmt->Fetch(PDO::FETCH_ASSOC);

    $teamname = $team['name'];

    $sql = "SELECT * FROM teams_users INNER JOIN users ON users.id = teams_users.user_id WHERE team_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($teamId));
    $users = $stmt->FetchAll(PDO::FETCH_ASSOC);

    foreach($users as $user) {

        $email = $user["email"];
        $subject = $teamname.": ".$name;
        $message = "Sehr geehrte/r Herr/Frau " . $user['lastname'] . ", \n\nIn Ihrem Team ".$teamname." wurde eine neue Retrospektive am ".$date." um ".$time." geplant. Seien Sie rechtzeitig anwesend und wenden Sie sich bei etwaigen Terminproblemen an Ihren Teammoderator. \n\nIhr RetroSpex Kalender";
        $headers = "FROM:" . "RetroSpeX" . " " . "Kalender" . " <iis.wi.proj@gmail.com>";
        $success = mail($email ,$subject, $message, $headers);
    }
}

function sendDeleteEmail($retroId){
    
    $db = new Database();
    $pdo = $db->connect();

    $sql = "SELECT teams.name AS tname, meeting.name AS mname, teams.id, meeting.date FROM meeting INNER JOIN teams on meeting.team_id=teams.id WHERE meeting.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($retroId));
    $team = $stmt->Fetch(PDO::FETCH_ASSOC);

    $teamname = $team['tname'];
    $name = $team['mname'];
    $teamId = $team['id'];
    $date = $team['date'];
    

    $sql = "SELECT * FROM teams_users INNER JOIN users ON users.id = teams_users.user_id WHERE team_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($teamId));
    $users = $stmt->FetchAll(PDO::FETCH_ASSOC);

    foreach($users as $user) {

        $email = $user["email"];
        $subject = $teamname.": ".$name;
        $message = "Sehr geehrte/r Herr/Frau " . $user['lastname'] . ", \n\nIn Ihrem Team ".$teamname." wurde eine geplante Retrospektive am ".$date." abgesagt. \n\nIhr RetroSpex Kalender";
        $headers = "FROM:" . "RetroSpeX" . " " . "Kalender" . " <iis.wi.proj@gmail.com>";
        $success = mail($email ,$subject, $message, $headers);
    }
}


?>

