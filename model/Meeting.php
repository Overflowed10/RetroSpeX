<?php

    class Meeting {
        public $db;
        private $name;
        private $no_of_cards;
        private $timestamp;
        private $retrotypeId;
        private $teamId;
        private $current_state;
        private $tmpMod;

        function __construct($name, $no_of_cards, $timestamp, $retrotypeId, $teamId, $tmpMod){
            $this->name = $name;
            $this->no_of_cards = $no_of_cards;
            $this->timestamp = $timestamp;
            $this->retrotypeId = $retrotypeId;
            $this->teamId = $teamId;
            $this->current_state = 0;
            $this->tmpMod = $tmpMod;
        }

        function save($meeting){
            $db = new Database();
            $pdo = $db->connect();
            $sql = "INSERT INTO `meeting`(`name`, `number_of_cards`, `date`, `retrotype_id`, `team_id`, `current_state`, `tmp_mod`) VALUES (?,?,?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($meeting->name, $meeting->no_of_cards, $meeting->timestamp, $meeting->retrotypeId, $meeting->teamId, $meeting->current_state, $meeting->tmpMod));  
        }

        function delete($meetingP){
            $db = new Database();
            $pdo = $db->connect();
            $sql = "DELETE FROM meeting WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($meetingP));   
        }

        function updateStatus($meetingId, $status){
            $db = new Database();
            $pdo = $db->connect();
            $sql = "UPDATE `meeting` SET `current_state` = ? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($status, $meetingId));
        }
        
        function update($meetingId, $meeting) {
            $db = new Database();
            $pdo = $db->connect();
            $sql = "UPDATE `meeting` SET `name` = ?, `date` = ?, `retrotype_id` = ? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($meeting->name, $meeting->timestamp, $meeting->retroType, $meetingId));
        }
        
    }
?>