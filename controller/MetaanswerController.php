<?php

require('../../model/Metaanswer.php');

function saveMetaanswer($selection, $metaquestionId, $meetingId, $userId){
    $metaanswer = new Metaanswer($selection, $metaquestionId, $meetingId, $userId);
    Metaanswer::save($metaanswer);
}

?>