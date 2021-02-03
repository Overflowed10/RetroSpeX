<?php

    class Metaquestion {
        private $id;
        private $question;
        private $teamId;
        private $meetingId;

        function __construct($question, $meetingId){
            $this->question = $question;
            $this->meetingId = $meetingId;
        }

        function save($metaquestion){

            $db = new Database();
            $pdo = $db->connect();   

            $sql = "INSERT INTO `metaquestion` (`question`, `meeting_id`) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($metaquestion->question, $metaquestion->meetingId));
        }
        
    }
?>