<?php require('../partials/head.php'); 
require('../partials/navbar.php');
include('../../core/Database.php'); ?>

<script src="../js/teams.search.js"></script>

<main class="col-sm-9 col-lg-10">
                    <!-- php-script zum laden der Teams hier -->
                    <div class="row justify-content-between">
                        <div class="col-6 my-auto">
                            <h3><b>Teams</b></h3>
                        </div>
                        <div class="col-3 col-lg-2">
                            <img class="float-right" src="../pictures/Logo.png" alt="RetroSpeX Logo" width="90" height="60">
                        </div>
                    </div>
                    <div class="container-fluid mt-3">
                        <!-- Suchfeld, um Zusammenfassungen zu filtern -->
                        <div class="container-fluid">
                        <div class="container-fluid mt-5">
                            <!-- Suchfeld, um Nutzer zu filtern -->
                            <div class="input-group">
                               <input id="team-searchbar" onkeyup="search_teams()" type="search" class="form-control mw-400" placeholder="Filtere Teams">                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    <?php 
                    if($_SESSION['user']->globalRole=="admin") {
                        echo "<div class='col-sm-6 col-md-4 col-lg-3 col-xl-2 my-3'>
                            <!-- Hier: html-Link zu Team-erstellen-Seite -->
                            <a href='teams.register.view.php'>
                                <div class='card'>
                                    <div class='card-header'>
                                    <img class='img-fluid d-block mx-auto' src='../pictures/new_team.png' alt='New Teams Img'>
                                    </div>
                                <div class='card-body text-center'>Neues Team hinzufügen</div>
                                </div>
                            </a>                            
                        </div>";
                    } ?>
                        <?php 
                        $db = new Database();
                        $pdo = $db->connect();


                        if($_SESSION['user']->globalRole=="admin") {
                            $sql = "SELECT * FROM `teams` ORDER BY deactivated";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $teams = $stmt->FetchAll(PDO::FETCH_ASSOC);
                        } else {
                            $sql = "SELECT * FROM `teams` INNER JOIN  teams_users ON teams.id = team_id WHERE user_id =".$_SESSION['user']->id;
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $teams = $stmt->FetchAll(PDO::FETCH_ASSOC);
                        }

                        

                        foreach($teams as $team) : 
                            $sql = "SELECT * FROM `teams` WHERE id =".$team['id'];
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $status = $stmt->Fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 my-3">
                            <a href="meeting.view.php?name=<?php echo $team['name']?>&id=<?php echo $team['id']?>">
                                <div class="card team-content">
                                    <div class="card-header">
                                        <img class="img-fluid d-block mx-auto" src="../pictures/anonymous_team.png" alt="Dummy Team pic">
                                    </div>
                                <div class="card-body text-center"><?php if($status['deactivated']) { echo "<span style='color:red'>Deaktiviert: </span>"; }echo $team['name']?></div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>


                    </div>
                </main>
<?php require('../partials/footer.php'); ?>