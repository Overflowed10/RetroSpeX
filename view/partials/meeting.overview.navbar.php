<?php
include('../../core/Database.php');
include('../../controller/isRole.php');
?>

<div class="container-fluid bg-customgreen">
        <nav class="navbar navbar-expand-sm justify-content-center d-md-block">
            <ul class="navbar-nav justify-content-between">
                <li class="navbar-nav">
                    <a class="panel-title-color nav-link mx-auto my-auto" <?php if(isAdmin()) {echo "href='teams.edit.view.php?name=". $_GET['name']."&id=". $_GET['id']."'";}?>><h2><?php echo $_GET['name']?></h3></a>
                </li>
                <li class="navbar-nav">
                    <a class="panel-title-color nav-link mx-auto my-auto" href="meeting.view.php?name=<?php echo $_GET['name']?>&id=<?php echo $_GET['id']?>"><h2>Übersicht</h3></a>
                </li>
                <li class="navbar-nav">
                    <a class="panel-title-color nav-link mx-auto my-auto" <?php if(isMod() || isAdmin()) {echo "href='meeting_plan.view.php?name=". $_GET['name']."&id=". $_GET['id']."'";}?>><h2>Verwaltung</h3></a>
                </li>
            </ul>
        </nav>
    </div>