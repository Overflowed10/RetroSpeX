<?php require('../partials/head.php');
require('../partials/navbar.php');
require('../../controller/checkAdminStatus.php'); ?>

<main class="col-sm-9 col-lg-10">
    <div class="row justify-content-between">
        <div class="col-6 my-auto">
            <h3><b>Nutzer registrieren</b></h3>
        </div>
        <div class="col-3 col-lg-2">
            <img class="float-right" src="../pictures/Logo.png" alt="RetroSpeX Logo" width="90" height="60">
        </div>
        <div class="container-fluid mt-3 ml-3">
            <form action="../../controller/users_registerUser.php" method="GET">
                <div class="form-group">
                    <label for="vorname" class="my-0 pl-2">Vorname</label>
                    <input name="firstname" type="text" class="form-control rounded mw-400" placeholder="Vorname eingeben" required>

                    <label for="nachname" class="my-0 text-left pl-2">Nachname</label>
                    <input name="lastname" type="text" class="form-control rounded mw-400" placeholder="Nachname eingeben" required>

                    <label for="email" class="my-0 text-left pl-2">E-Mail</label>
                    <input name="email" type="email" class="form-control rounded mw-400" placeholder="Email Adresse eingeben" required>

                    <label for="globaleRolle" class="my-0 text-left pl-2">Globale Rolle</label>
                    <select class="form-control rounded mw-400" name="globalRole">
                        <option>Mitarbeiter</option>
                        <option>Administrator</option>
                    </select>
                    <button class="btn btn-green text-left mt-5" onsubmit="lockoutSubmit(this)" type="submit">Bestätigen</button>
                </div>
            </form>                     
        </div>
        <div class="container-fluid mt-5">
            <a href="users.view.php" >
                <button class="btn btn-green text-left"><i class="fa fa-angle-left"></i></button>
            </a>   
        </div>

        <!-- Success / Error Msg after user creation -->
        <?php 
            if (strpos($_SERVER['REQUEST_URI'], "?userCreated")){
                $url_status = explode('?', $_SERVER['REQUEST_URI'])[1];
                if ($url_status == "userCreated=True"){
                    echo '<div class="ml-3 mt-3 alert alert-success alert-dismissible fade show">
                        Nutzer wurde erstellt!
                        </div>';
                } else if ($url_status == "userCreated=False"){
                    echo '<div class="ml-3 mt-3 alert alert-danger alert-dismissible fade show">
                        Email existiert bereits!
                        </div>';
                }
            }
        ?> 
    </div>
</main>
<script src="../js/autoclose_alert.js"> </script>
<?php require('../partials/footer.php'); ?>