<?php 
require('../partials/head.php'); 
require('../partials/navbar.php');
include('../../core/Database.php'); ?>
<script src="../js/teams.search.js"></script>

<main class="col-sm-9 col-lg-10">
                    <div class="row justify-content-between">
                        <div class="col-6 my-auto">
                            <h3><b>Übersicht</b></h3>
                        </div>
                        <div class="col-3 col-lg-2">
                            <img class="float-right" src="../pictures/Logo.png" alt="RetroSpeX Logo" width="90" height="60">
                        </div>
                    </div>
                    <div class="container-fluid mt-3"><div class="container-fluid">
                        <div class="container-fluid mt-5">
                            <!-- Suchfeld, um Nutzer zu filtern -->
                            <div class="input-group">
                               <input id="team-searchbar" onkeyup="search_teams()" class="form-control mw-40()" type="sea0" placeholder="Filtere Teams">                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-columns mt-3">
                        
                    <?php 
                        
                        $db = new Database();
                        $pdo = $db->connect();

                        
                        $sql = "SELECT * FROM `teams` WHERE deactivated = false";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $teams = $stmt->FetchAll(PDO::FETCH_ASSOC);

                        
                        $sql = "SELECT * FROM `teams_users`";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $teams_users = $stmt->FetchAll(PDO::FETCH_ASSOC);

                        foreach($teams as $team) {
                        $sql = "SELECT `firstname`, `lastname`, `local_role` FROM `teams_users` INNER JOIN `users` ON `teams_users`.user_id=`users`.id WHERE team_id = ". $team['id'];
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $table = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        ?>  
                        <div class="card team-content">
                            <div class="card-header"><div><h6><b><?php echo $team['name'];?></b></h6></div></div>
                            <div class="card-body"><p>
                            <?php
                            foreach($table as $name) {
                                echo $name['firstname'] . " " . $name['lastname'];
                                if($name['local_role'] == 'moderator') {
                                    echo "<span class='badge badge-primary'> Mod</span>";
                                }?><br>
                                <?php }?>
                            </p>
                            
                            </div>
                        </div>
                        <?php }?>

                        <script>colorCardBackground();</script>
                        

                    </div>
                </main>

<?php require('../partials/footer.php'); ?>