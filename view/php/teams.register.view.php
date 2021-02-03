<?php require('../partials/head.php'); 

if(isset($_GET['teamId'])) {
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
<?php
 } else {
 require('../partials/navbar.php'); 
} ?>
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
        <?php if (isset($_GET['teamId'])) { ?>
        <form action="../../controller/addTeam.php?teamId=<?php echo $_GET['teamId']; ?>&modId=<?php echo $_GET['modId']; ?>" method="GET">
        <input name="teamId" id="teamId" type="hidden" value="<?php echo $_GET['teamId']?>">
        <input name="modId" id="modId" type="hidden" value="<?php echo $_GET['modId']?>">
        <?php } else { ?>
        <form action="../../controller/addTeam.php" method="GET">
        <?php } ?>
            <div class="form-group">
                <label for="name" class="my-0 pl-2">Name</label>
                <input name="name" id="name" type="text" class="form-control rounded mw-400" onkeyup='saveValue(this);' required><br>


                <script src="../js/retainname.js"></script>


                <label for="moderator" class="my-0 text-left pl-2">Moderator </label>

                <?php
                if(isset($_GET['modId'])){
                    $modid = intval($_GET['modId']);
                }

                $modemail = null;
                 if(isset($modid)) {
                    $db = new Database();
                    $pdo = $db->connect();
                    
                    $sql = "SELECT email FROM `users` WHERE id = ". $modid;
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->Fetch(PDO::FETCH_ASSOC);
                    $_POST['modId'] = $modid;
                    $modemail = $row['email'];
                 }
                
                ?>

                <div class="input-group">
                <input name="moderator" id="moderator" placeholder="Bitte einen Nutzer unten auswählen" type="text" value= "<?php echo $modemail; ?>" class="form-control mw-400 d-none" required onkeypress="return false;" >
                </div>
                <div>
                    <?php if (isset($_GET['modId'])) {?><span class='badge badge-primary' style="color:white"><h6><?php echo $modemail; ?></h6></span><?php } else { echo "<label></label>"; }?>
                </div>
                <br>
                    
            <div>
                <button class="btn btn-green text-left mt-3" type="submit">Weiter</button>
            </div>
            <br>
            <!-- Suchfeld, um Nutzer zu filtern -->
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
            if (isset($_GET['teamId'])) {

                $db = new Database();
                $pdo = $db->connect();
                    
                $sql = "SELECT * FROM `users`";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $users = $stmt->FetchAll(PDO::FETCH_ASSOC);

                foreach($users as $user){
                    echo '<div class="col my-3 text-center user-content">
                        <a href="teams.register.view.php?teamId='.$_GET['teamId'].'&modId='.$user['id'].'">
                            <img src="../pictures/anonymous_user.png" class="rounded-circle" alt="Profilbild">
                             <p>'.$user['firstname']." ".$user['lastname'].'<br>
                            '.$user['email'].'</p>
                        </a>
                    </div>';
                }
            } else {

                $db = new Database();
                $pdo = $db->connect();
                    
                $sql = "SELECT * FROM `users`";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $users = $stmt->FetchAll(PDO::FETCH_ASSOC);


                foreach($users as $user){
                    echo '<div class="col my-3 text-center user-content">
                        <a href="teams.register.view.php?modId='.$user['id'].'">
                            <img src="../pictures/anonymous_user.png" class="rounded-circle" alt="Profilbild">
                            <p>'.$user['firstname']." ".$user['lastname'].'<br>
                           '.$user['email'].'</p>
                        </a>
                    </div>';
                }    
            }     
            ?>
    </div>
    <script src=""></script>
    <script src="../js/autoclose_alert.js"> </script>
        </form>
    </div>
    <div class="container-fluid mt-5">
    <a href="../../controller/teams.register.abort.php?destination=2<?php if(isset($_GET['teamId'])) {echo '&teamId='.$_GET['teamId'];}?>">
            <button class="btn btn-green text-left"><i class="fa fa-angle-left fa-2x"></i></button>
        </a>
    </div>
</main>

<?php require('../partials/footer.php'); ?>