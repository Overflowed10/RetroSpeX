<?php require('../partials/head.php'); ?>


<body class="custom-page">
        <div class="container-fluid my-4 w-450">
            <img class="img-fluid d-block mx-auto" src="../pictures/Logo.png" alt="RetroSpeX Logo">
        </div>
        <div class="container mx-auto">
            <form action="../../controller/forgotten_password.php" method="POST">
                <div class="container-fluid w-450">
                    <div class="form-group">
                        <label for="email" class="my-0 pl-2">E-Mail</label>
                        <input type="email" class="form-control my-2" placeholder="Email eingeben" name = 'email' id="email" required>
                    </div>
                    <div class="row">
                        <div class="col text-left">
                            <a href="login.view.php">
                                <button type="button" class="btn btn-green"><i class="fa fa-caret-left text-left"></i> Zurück</button>
                            </a>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-green" type="submit">Bestätigen</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>


<?php require('../partials/footer.php'); ?>