<?php 
require('../partials/head.php');
require('../partials/navbar.php'); 
require('../../controller/checkAdminStatus.php');
include('../../core/Database.php'); ?>

<main class="col-sm-9 col-lg-10">
    <div class="row justify-content-between">
        <div class="col-6 my-auto">
            <h3><b>Nutzer bearbeiten</b></h3>
        </div>
        <div class="col-3 col-lg-2">
            <img class="float-right" src="../pictures/Logo.png" alt="RetroSpeX Logo" width="90" height="60">
        </div>
     
        <?php 
            // CHECK if userId valid 
            if (strpos($_SERVER['REQUEST_URI'], "?userId")){
                $url_explode = explode('?', $_SERVER['REQUEST_URI']);
                if (count($url_explode)==2 && strpos($url_explode[1], "userId=") !== False){
                    try {
                        // Create DB con and Query all users with Email
                        $user_id = intval(explode("=", $url_explode[1])[1]);
                        $db = new Database();
                        $pdo = $db->connect();   
                        
                        
                        $sql = "SELECT * FROM `users` WHERE id = ?;";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array($user_id));
                        $user = $stmt->fetchAll()[0];
                        if ($user == NULL) {
                            header('Location: ../php/users.view.php');
                        }
                        // FILL OUT Form according to query
                        echo '<div class="container-fluid mt-3 ml-3">
                                <form action="../../controller/users_editUser.php" method="GET">
                                    <div class="form-group">
                                        <input type="hidden" name="userId" value="'.$user["id"].'">

                                        <label for="firstname" class="my-0 pl-2">Vorname</label>
                                        <input name="firstname" type="text" class="form-control rounded mw-400" value="'.$user["firstname"].'" required>
        
                                        <label for="lastname" class="my-0 text-left pl-2">Nachname</label>
                                        <input name="lastname" type="text" class="form-control rounded mw-400" value="'.$user["lastname"].'" required>
    
                                        <label for="email" class="my-0 text-left pl-2">E-Mail</label>
                                        <input name="email" type="email" class="form-control rounded mw-400" value="'.$user["email"].'" required>
    
                                        <label for="globalRole" class="my-0 text-left pl-2">Globale Rolle</label>
                                        <select class="form-control rounded mb-2 mw-400" name="globalRole">';
                        if ($user["global_role"]=="admin"){
                            echo '<option>Administrator</option>
                                    <option>Mitarbeiter</option>';
                        } else {
                            echo '<option>Mitarbeiter</option>
                                    <option>Administrator</option>';
                        }
                    } catch (Exception $ex) {
                        header('Location: ../php/users.view.php');
                    }                               
                }
            } else {
                header('Location: ../php/users.view.php');	
            }
            ?>
                        </select>                  
                        <button class="btn btn-green text-right" name="edit-user-btn" type="submit">Bestätigen</button>
                    </div>
                </form>
                <div class="container-fluid my-5 pl-0">      
                    <form action="../../controller/users_editUser.php" method="GET">              
                    <?php echo '<input type="hidden" name="userId" value="'.$user_id.'">' ?>
                    <button name="delete-user-btn" class="btn btn-red" type="submit">Nutzer löschen</button>
                    </form>
                </div>
            </div>
        <div class="container-fluid mt-5">
            <a href="users.view.php" >
                <button class="btn btn-green"><i class="fa fa-angle-left"></i></button>
            </a>   
        </div>  
    </div>
</main>
<?php require('../partials/footer.php'); ?>
