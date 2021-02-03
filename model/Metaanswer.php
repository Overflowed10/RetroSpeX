
<?php

class Metaanswer {
    private $id;
    private $selection;
    private $metaquestionId;
    private $meetingId;
    private $userId;

    function __construct($selection, $metaquestionId, $meetingId, $userId){
        $this->selection = $selection;
        $this->metaquestionId = $metaquestionId;
        $this->meetingId = $meetingId;
        $this->userId = $userId;
    }

    function save($metaanswer){

        $db = new Database();
        $pdo = $db->connect();   

        $sql = "INSERT INTO `metaanswer` (`selection`, `metaquestion_id`, `meeting_id`, `user_id`) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($metaanswer->selection, $metaanswer->metaquestionId, $metaanswer->meetingId, $metaanswer->userId));
 
    }
    
}
?>
