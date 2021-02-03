<?php
if(isset($_SESSION['meeting'])){
    unset($_SESSION['meeting']);
}

if(isset($_SESSION['ref'])){
    unset($_SESSION['ref']);
}