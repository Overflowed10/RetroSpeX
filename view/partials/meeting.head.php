<?php include('../../model/User.php');
include('../../controller/MeetingController.php');
include('../../core/Database.php');
include('../../controller/isRole.php');?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php 
        session_start();
        if(!isMod() && !isAdmin() && isset($_SESSION['autorefresh'])){
            echo '<meta http-equiv="refresh" content="5" >';
        } 
        if(isset($_SESSION['autorefresh'])){
            if($_SESSION['autorefresh'] === "refresh"){
                echo '<meta http-equiv="refresh" content="5" >';
            }else if($_SESSION['autorefresh'] === "longrefresh"){
                echo '<meta http-equiv="refresh" content="10" >';
            }
        }
        ?>

        <title>RetroSpeX - Retrospektive</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
        <link rel = "icon" href = "../pictures/miniLogo.png" 
        type = "image/x-icon"> 
        <link href="../css/bootstrap.min.css" rel="stylesheet">
       
        <link href="../css/meeting.css" type="text/css" rel="stylesheet">
        <link href="../css/styles.css" type="text/css" rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <script src="../js/main_meeting_view.js"></script>
        <script src="../js/progressbar.js"></script>
        
    </head>
<body class="custom-page">
