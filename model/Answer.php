<?php

    class Answer {
        private $userId;
        private $meetingId;
        private $questionId;
        private $content;

        function __construct($userId, $meetingId, $questionId, $content){
            $this->userId = $userId;
            $this->meetingId = $meetingId;
            $this->questionId = $questionId;
            $this->content = $content;

        }

        function save($answer){
            
            $db = new Database();
            $pdo = $db->connect();  

            $sql = "INSERT INTO `answer`(`user_id`, `meeting_id`, `question_id`, `content`) VALUES (?, ?, ? , ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($answer->userId, $answer->meetingId, $answer->questionId, $answer->content));
            
        }

    }
?>