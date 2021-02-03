<?php 
require('../partials/head.php');
require('../partials/navbar.php');
require('../../controller/MeetingController.php');
?>

<script src="../js/users.js"></script>

<main class="col-sm-9 col-lg-10">
    <?php require('../partials/meeting.overview.navbar.php'); 
    
    $db = new Database();
    $pdo = $db->connect();

    $sql = "SELECT * FROM `users` INNER JOIN teams_users ON users.id=teams_users.user_id WHERE team_id =".$_GET['id'];
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $mod = $stmt->Fetch(PDO::FETCH_ASSOC);

    
    $sql = "SELECT * FROM `teams` WHERE id =".$_GET['id'];
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $status = $stmt->Fetch(PDO::FETCH_ASSOC);
    

    if(!$status['deactivated']) {
    ?>


    
    <div class="col-lg-6 col-xl-10 mt-3 w-400 round-border">
                <h4 class="text-center">Team bearbeiten</h4>
                <form action="../../controller/updateTeam.php?name=<?php echo $_GET['name'].'&id='.$_GET['id'];?>" method="POST">
                    <div class="form-group">
                        <label for="teamname" class="my-0 text-left pl-2">Team-Name:</label>
                        <input id="teamname" type="text" class="form-control" value="<?php echo $_GET['name']; ?>" name="teamname" class="mw-400">
                    </div>  

                    <div class="form-group">
                        <label for="moderator" class="my-0 text-left pl-2">Moderator</label>
                        <select class="form-control" id="moderator" name="moderator">
                        <option value="none">Neuer Moderator</option>

                        <?php

                            $sql = "SELECT * FROM `users` INNER JOIN teams_users ON users.id=teams_users.user_id WHERE team_id =".$_GET['id'];
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();

                            while ($row = $stmt->Fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="'.$row['email'].'">'.$row['firstname'].' '.$row['lastname'].' ('.$row['email'].')</option>';
                            }
                        ?>                       
                        </select>
                    </div>
                    <button class="btn btn-green mb-3" name="saveTeamChanges" type="submit">Änderungen speichern</button>
                </form>
                        <a href="./teams.deactivate.view.php?name=<?php echo $_GET['name'].'&id='.$_GET['id'];?>">
                    <button class="btn btn-red mb-3" name="saveTeamChanges">Team deaktivieren</button>
                    </a>
        </div>

    <div class="row">

    <?php

        if(isset($_GET['uid'])) {
                $sql = "SELECT * FROM `users` WHERE id =".$_GET['uid'];
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $eluser = $stmt->Fetch(PDO::FETCH_ASSOC);
        }

    ?>
        <div class="col-lg-6 col-xl-5 mt-3">
            <div class="container-fluid w-400 round-border">
                <h4 class="text-center">Mitarbeiter hinzufügen</h4>
                <form action="" method="POST">   

                    <div class="form-group">
                        <label for="mitarbeiter" class="my-0 text-left pl-2">Mitarbeiter hinzufügen</label>
                            <div class="input-group">
                                <input name="mitarbeiter" type="text" class="form-control mw-400" value="<?php if(isset($_GET['action'])) { if($_GET['action'] == "add") { echo $eluser['email']; } } ?>" readonly>
                                <div class="input-group-append">
                                    <a <?php if(isset($_GET['uid'])) { ?>href="../../controller/addMember.php?<?php echo 'name='.$_GET['name'].'&id='.$_GET['id'].'&uid='.$_GET['uid'].'&action='.$_GET['action'].'"';} ?>" >
                                        <button class="btn btn-green" type="button"><i class="fa fa-plus"></i></button>
                                    </a>
                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                <input id="user-searchbar" onkeyup="search_users()" type="search" class="form-control mw-400" placeholder="Filtere Nutzer">                                
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>

        

        <div class="row">            
            <!-- QUERY all Teams inclusive their Users and show them via cards -->
            <?php
                
                $sql = "SELECT DISTINCT users.`id`, firstname, lastname, email FROM `users` WHERE users.`id` NOT IN (SELECT users.`id` FROM users INNER JOIN teams_users ON users.`id` = teams_users.user_id WHERE `teams_users`.`team_id` = ?) OR users.`id` NOT IN (SELECT user_id FROM `teams_users`)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array($_GET['id']));
                $users = $stmt->FetchAll(PDO::FETCH_ASSOC);


                foreach($users as $user){
                    echo '<div class="col my-3 text-center user-content">
                        <a href="teams.edit.view.php?name='.$_GET['name'].'&id='.$_GET['id'].'&uid='.$user['id'].'&action=add">
                            <img src="../pictures/anonymous_user.png" class="rounded-circle" alt="Profilbild">
                             <p>'.$user['firstname']." ".$user['lastname'].'<br>
                            '.$user['email'].'</p>
                        </a>
                    </div>';
                }   
            ?>
                    </div>   
                    
                </form>
            </div>
        </div>
        <div class="col-lg-6 col-xl-5 mt-3">
            <div class="container-fluid w-400 round-border">
                <h4 class="text-center">Mitarbeiter entfernen</h4>
                <div class="form-group">
                        <label for="mitarbeiter" class="my-0 text-left pl-2">Mitarbeiter entfernen </label><?php if(isset($_GET['empty'])) {echo "<label style='color:red'>Das Team muss mindestens <b>einen</b> Mitarbeiter haben.";} ?></label>
                    <div class="form-group">
                    <form action="../../controller/removeMember.php?<?php echo 'name='.$_GET['name'].'&id='.$_GET['id']; ?>" method="POST">
                        <select class="form-control" id="rem" name="rem">
                        
                        <option value="none">Mitarbeiter entfernen</option>

                        <?php

                            
                            $sql = "SELECT * FROM `users` INNER JOIN teams_users ON users.id=teams_users.user_id WHERE NOT local_role = 'moderator' AND team_id =".$_GET['id'];
                            $stmt2 = $pdo->prepare($sql);
                            $stmt2->execute();

                            while ($member = $stmt2->Fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="'.$member['email'].'">'.$member['firstname'].' '.$member['lastname'].' ('.$member['email'].')</option>';
                            }
                        ?>   
                        </select>
                        </div>
                            <button class="btn btn-red" type="submit"><i class="fa fa-minus"></i></button>
                    </div>   
                </form>
                </div>
            </div>
        </div>
    </div>
<?php } else {
    echo "<br><h2 style='color:red'>Team deaktiviert</h2>";
}
?>

</main>
<?php require('../partials/footer.php'); ?>