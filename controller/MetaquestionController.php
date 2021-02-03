<?php

require('../../model/Metaquestion.php');

function saveMetaquestion($question, $meetingId){
    $metaquestion = new Metaquestion($question, $meetingId);
    Metaquestion::save($metaquestion);
}

?>