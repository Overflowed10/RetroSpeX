<?php 
require('../partials/head.php');
require('../partials/navbar.php');?>

<main class="col-sm-9 col-lg-10">
                    <div class="row justify-content-between">
                        <div class="col-6 my-auto">
                            <h3><b>Einstellungen</b></h3>
                        </div>
                        <div class="col-3 col-lg-2">
                            <img class="float-right" src="../pictures/Logo.png" alt="RetroSpeX Logo" width="90" height="60">
                        </div>
                    </div>
                    <div class="row">
                        <!-- Passwort ändern-->
                        <div class="col-lg-6 col-xl-5 mt-3">
                            <div class="container-fluid w-400 round-border">
                                <h4 class="text-center">Passwort ändern</h4>
                                <form action="../../controller/change_password.php" method="POST">
                                    <div class="form-group">
                                        <label class="pl-2" for="pw_alt">Altes Passwort eingeben:</label> 
                                        <input type="password" class="form-control" name = "old_pw" id = "old_pw" placeholder="Altes Passwort" required>
                                        <label class="pl-2" for="pw_neu1">Neues Passwort eingeben:</label> 
                                        <input type="password" class="form-control" name = "new_pw1" id = "newpw1" placeholder="Neues Passwort" required>
                                        <label class="pl-2 mt-1" for="pw_neu2">Neues Passwort wiederholen:</label> 
                                        <input type="password" class="form-control" name = "new_pw2" id = "newpw2"placeholder="Neues Passwort" required>
                                        <div class="text-left mx-auto mt-2">
                                            <button class="btn btn-green" type="submit">Bestätigen</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
<?php 
require('../partials/footer.php'); 
?>