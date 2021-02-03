<?php 
require('../partials/head.php');
require('../partials/navbar.php');
require('../../controller/checkAdminStatus.php');
require('../../core/Database.php'); ?>

<script src="../js/users.js"></script>

<main class="col-sm-9 col-lg-10">
    <div class="row justify-content-between">
        <div class="col-6 my-auto">
            <h3><b>Nutzer</b></h3>
        </div>
        <div class="col-3 col-lg-2">
            <img class="float-right" src="../pictures/Logo.png" alt="RetroSpeX Logo" width="90" height="60">
        </div>
    </div>
    <div class="container-fluid mt-3">
        <a href="users_register.view.php">
            <img src="../pictures/anonymous_user.png" class="rounded-circle" alt="Nutzer registrieren">
            <p class="pl-4">Nutzer registrieren</p>
        </a>
    </div>
   
    <div class="container-fluid">
        <div class="container-fluid mt-5">
            <!-- Suchfeld, um Nutzer zu filtern -->
            <div class="input-group">
                <input id="user-searchbar" onkeyup="search_users()" type="search" class="form-control mw-400" placeholder="Filtere Nutzer">                                
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>

        <!-- Success / Error Msg after user creation -->
        <?php 
            if (strpos($_SERVER['REQUEST_URI'], "?userDeleted")){
                $url_status = explode('?', $_SERVER['REQUEST_URI'])[1];
                if ($url_status == "userDeleted=True"){
                    echo '<div class="ml-3 mt-3 alert alert-success alert-dismissible fade show">
                        Nutzer wurde erfolgreich gelöscht!
                        </div>';
                }
            }
        ?>
        
        <div class="row">            
            <!-- QUERY all Teams inclusive their Users and show them via cards -->
            <?php
                $db = new Database();
                $pdo = $db->connect();

                
                $sql = "SELECT * FROM `users`";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $users = $stmt->FetchAll(PDO::FETCH_ASSOC);

                foreach($users as $user){
                    echo '<div class="col my-3 text-center user-content">
                        <a href="users_edit.view.php?userId='.$user['id'].'">
                            <img src="../pictures/anonymous_user.png" class="rounded-circle" alt="Profilild">
                             <p>'.$user['firstname']." ".$user['lastname'].'<br>
                            '.$user['email'].'</p>
                        </a>
                    </div>';
                }     
            ?>
        </div>
    </div>

    <script src="../js/autoclose_alert.js"> </script>
</main>

<?php require('../partials/footer.php'); ?>

