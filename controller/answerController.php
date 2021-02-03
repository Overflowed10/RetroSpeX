<?php
require('../../model/Answer.php');

function saveAnswer($userId, $meetingId, $questionId, $content){
    $answer = new Answer($userId, $meetingId, $questionId, $content);
    Answer::save($answer);
}