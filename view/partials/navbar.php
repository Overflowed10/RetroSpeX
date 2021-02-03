<?php
 require("./../../model/User.php");
 session_start();
 require('../../controller/checkMeetingSession.php');
 require('../../controller/checkLoginStatus.php');
?>
<div class="container-fluid">
    <div class="row navbar-height">
        <nav id="sb-main" class="col-sm-3 col-lg-2 navbar justify-content-center d-md-block borderright-customgreen">
            <!-- TODO: Add navbar-active -->
            <ul class="navbar-nav flex-column">
                <li class="text-center">
                    <img class="img-fluid mb-2" src="../pictures/anonymous_user.png" alt="Profilbild">
                    <h6 class="text-center">
                    <?php echo $_SESSION['user']->firstname ." ".$_SESSION['user']->lastname; ?> 
                    </h6>
                    <hr class="bg-customgreen">
                </li>
                <li class="nav-item pl-4">
                    <a class="nav-link" href="../php/overview.view.php"><b>Übersicht</b></a>
                </li>

                <?php 
                if ($_SESSION['user']->globalRole == "admin"){
                    echo '<li class="nav-item pl-4">
                        <a class="nav-link" href="../php/teams.view.php"><b>Teams</b></a>
                    </li>
                    <li class="nav-item pl-4">
                        <a class="nav-link" href="../php/users.view.php"><b>Nutzer</b></a>
                    </li>';
                    }
                    else {
                    echo '<li class="nav-item pl-4">
                        <a class="nav-link" href="../php/teams.view.php"><b>Meine Teams</b></a>
                    </li>';
                    }
                ?>

                <li class="nav-item pl-4">
                    <a class="nav-link" href="../php/settings.view.php"><b>Einstellungen</b></a>
                </li>
                <li class="nav-item pl-4">
                    <a class="nav-link" href="../php/help.view.php"><b>Hilfe</b></a>
                </li>
                <li class="nav-item pl-4">
                    <a class="nav-link" href="../../controller/logout.php"><b>Log-out</b></a>
                </li>
            </ul>
        </nav>
