<?php require('../partials/head.php'); ?>
        <div class="container-fluid my-4 w-450">
            <img class="img-fluid d-block mx-auto" src="../pictures/Logo.png" alt="RetroSpeX Logo">
        </div>
        <div class="container mx-auto">
            <form action="../../controller/process_login.php" method="POST">
                <div class="container-fluid w-450">
                    <div class="form-group">
                        <label for="email" class="my-0 pl-2">E-Mail</label>
                        <input id="email" name="email" type="email" class="form-control mt-1 rounded" placeholder="Email eingeben" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="my-0 pl-2">Passwort</label>
                        <input id="pwd" name="pwd" type="password" class="form-control mt-1" placeholder="Passwort eingeben" required>
                    </div>
                    <button type="submit" name="loginBtn" class="btn btn-green text-center">Absenden</button><span style="color:red;"><?php if(isset($_GET['password']) && $_GET['password'] == 'false') {echo "       Das eingegebene Passwort ist falsch.";}?></span>
                </div>
            </form>
            <div class="col-sm-6 text-center mx-auto">
                <a class="text-primary" href="login_pw_vergessen.view.php">Passwort vergessen</a>

<?php require('../partials/footer.php'); ?>
