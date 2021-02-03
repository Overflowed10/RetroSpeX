<?php 
require('../partials/head.php'); 
require("./../../model/User.php");
session_start();
?>
<div class="container-fluid">
    <div class="row">
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
                    <a class="nav-link" href="../../controller/teams.register.abort.php?teamId=<?php echo $_GET['teamId']?>&destination=1"><b>Übersicht</b></a>
                </li>

                <?php 
                if ($_SESSION['user']->globalRole == "admin"){
                    echo '<li class="nav-item pl-4">
                        <a class="nav-link" href="../../controller/teams.register.abort.php?teamId='.$_GET['teamId'].'&destination=2"><b>Teams</b></a>
                    </li>
                    <li class="nav-item pl-4">
                        <a class="nav-link" href="../../controller/teams.register.abort.php?teamId='.$_GET['teamId'].'&destination=3"><b>Nutzer</b></a>
                    </li>';
                    }
                    else {
                    echo '<li class="nav-item pl-4">
                        <a class="nav-link" href="../../controller/teams.register.abort.php?teamId='.$_GET['teamId'].'&destination=2"><b>Meine Teams</b></a>
                    </li>';
                    }
                ?>

                <li class="nav-item pl-4">
                    <a class="nav-link" href="../../controller/teams.register.abort.php?teamId=<?php echo $_GET['teamId']?>&destination=4"><b>Einstellungen</b></a>
                </li>
                <li class="nav-item pl-4">
                    <a class="nav-link" href="../../controller/teams.register.abort.php?teamId=<?php echo $_GET['teamId']?>&destination=5"><b>Hilfe</b></a>
                </li>
                <li class="nav-item pl-4">
                    <a class="nav-link" href="../../controller/teams.register.abort.php?teamId=<?php echo $_GET['teamId']?>&destination=6"><b>Log-out</b></a>
                </li>
            </ul>
        </nav>
<?php include('../../core/Database.php'); ?>
<script src="../js/users.js"></script>

<main class="col-sm-9 col-lg-10">
    <div class="row justify-content-between">
        <div class="col-6 my-auto">
            <h3><b>Team erstellen</b></h3>
        </div>
        <div class="col-3 col-lg-2">
            <img class="float-right" src="../pictures/Logo.png" alt="RetroSpeX Logo" width="90" height="60">
        </div>
    </div>
    <div class="container-fluid mt-3 ml-3">
        <?php if (isset($_GET['uid']))  {?>
        <form action="../../controller/addMember.php?teamId=<?php echo $_GET['teamId']; ?>&modId=<?php echo $_GET['modId']; ?>&uid=<?php echo $_GET['uid']; ?>" method="POST">
        <?php } else { ?>
        <form action="../../controller/addMember.php?teamId=<?php echo $_GET['teamId']; ?>&modId=<?php echo $_GET['modId']; ?>" method="POST">
        <?php } ?>
            <div class="form-group">
                <label for="mitarbeiter" class="my-0 text-left pl-2">Mitarbeiter</label><span style="color:red;"><?php 
                if(isset($_GET['finalizeTeam'])) {
                     if($_GET['finalizeTeam'] == false || $_GET['finalizeTeam'] == "false") {
                         echo " Bitte noch einen Mitarbeiter hinzufügen.";
                    }
                }
                if(isset($_GET['userinput'])) {
                     if($_GET['userinput'] == false || $_GET['userinput'] == "false") {
                         echo " Bitte unten einen Mitarbeiter auswählen.";
                    }
                }
                ?></span>

                <?php

                $modId = $_GET['modId'];
                $teamId = $_GET['teamId'];
                
                if(isset($_GET['uid'])){
                    $userid = intval($_GET['uid']);
                }

                $useremail = "";
                 if(isset($userid)) {
                    $db = new Database();
                    $pdo = $db->connect();
                    
                    $sql = "SELECT email FROM `users` WHERE id = ". $userid;
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->Fetch(PDO::FETCH_ASSOC);

                    $useremail = $row['email'];
                 }
                
                ?>
                <div class="input-group">
                <input name="mitarbeiteremail" id="mitarbeiteremail" placeholder="Bitte einen Nutzer unten auswählen" type="hidden" value= "<?php echo $useremail; ?>" class="form-control mw-400" required onkeypress="return false;">
                <?php if (isset($_GET['uid'])) {?><span class='badge badge-primary' style="color:white"><h6><?php echo $useremail; ?></h6></span><?php } else { echo "<label></label>"; }?>
                </div><br>
                    <div class="input-group-append">
                        <button class="btn btn-green" type="submit">Hinzufügen</button>
                    </div>
                    
                <br>
                    
            <div class="input-group">
                <input id="user-searchbar" onkeyup="search_users()" type="search" class="form-control mw-400" placeholder="Filtere Nutzer">                                
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
        </form>
        
        <div class="row">            
            <!-- QUERY all Teams inclusive their Users and show them via cards -->
            <?php
                $db = new Database();
                $pdo = $db->connect();

                
                $sql = "SELECT DISTINCT users.`id`, firstname, lastname, email FROM `users` WHERE users.`id` NOT IN (SELECT users.`id` FROM users INNER JOIN teams_users ON users.`id` = teams_users.user_id WHERE `teams_users`.`team_id` = ?) OR users.`id` NOT IN (SELECT user_id FROM `teams_users`)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array($_GET['teamId']));
                $users = $stmt->FetchAll(PDO::FETCH_ASSOC);
                
                foreach($users as $user){
                    echo '<div class="col my-3 text-center user-content">
                        <a href="teams.register.members.view.php?teamId='.$teamId.'&modId='.$modId.'&uid='.$user['id'].'">
                            <img src="../pictures/anonymous_user.png" class="rounded-circle" alt="Profilild">
                             <p>'.$user['firstname']." ".$user['lastname'].'<br>
                            '.$user['email'].'</p>
                        </a>
                    </div>';
                }     
            ?>
    </div>
    <div>
        <a href="../../controller/finalizeTeam.php?teamId=<?php echo $_GET['teamId']."&modId=".$_GET['modId'];?>">
            <button class="btn btn-green text-left mt-3" name="exit" value="exit">Fertig</button>
        </a>
        <a href="../../controller/teams.register.abort.php?destination=2&teamId=<?php echo $_GET['teamId']?>">
            <button class="btn btn-green text-left mt-3" name="exit" value="exit">Abbrechen</button>
        </a>
    </div>
    
    <div class="container-fluid mt-5">
    <?php 
    if (isset($_GET['teamId'])) {
    ?>
        <a href="teams.register.view.php?modId=<?php echo $_GET['modId'];?>&teamId=<?php echo $_GET['teamId'];?>">
    <?php } else { ?>
        <a href="teams.view.php">
    <?php } ?>
            <button class="btn btn-green text-left"><i class="fa fa-angle-left fa-2x"></i></button>
        </a>
    </div>
</main>
</main>

<?php require('../partials/footer.php'); ?>