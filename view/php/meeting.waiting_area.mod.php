<?php 
require('../partials/meeting.head.php');
require('../partials/meeting.top_navbar.php');
require('../partials/progressbar/progressbar.phase1.php');

$db = new Database();
$pdo = $db->connect();
 
if(isset($_POST['next'])){ 
    if(isset($_SESSION['ref'])){
        setCurrentState($_GET['retroId'], 2);
    }
    $sql = "SELECT * FROM meeting WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($_GET['retroId']));
    $meeting = $stmt->fetch();
    if($meeting['current_state'] === "2"){
        unset($_SESSION['autorefresh']);
        header('Location: meeting.fill_in_cards.php?id='.$_GET['id'].'&name='.$_GET['name'].'&retroId='.$_GET['retroId'].'&retroName='.$_GET['retroName'].'&qIdx='.-1);
    }
    
 }
?>
<form action="" method="POST">
    <div class="container-fluid text-right mt-3">
    <input type="hidden" name="next">
    <button type="submit" class="btn btn-green">Nächste Phase</a>
    </div> 
</form>
<main>
    <div class="container-fluid">
    <div class="row justify-content-md-center align-items-center">
        <div class="col-md-auto">
            <div id="reminder" class="card">
                <img class="card-img-top" src="../pictures/lightbulb.jpg"
                    alt="https://de.vecteezy.com/gratis-vektor/lampe | Lampe Vektoren von Vecteezy">
                    <div class="card-body">
                            <?php 
                            switch(rand(0,4)) {
                                case 0: echo '<p class="card-text"><i>„Nur wer etwas leistet, kann sich etwas leisten.“</i> <br>(Michail Gorbatschow)</p>'; break;
                                case 1: echo '<p class="card-text"><i>„Der höchste Lohn für unsere Bemühungen ist nicht das, was wir dafür bekommen, sondern das, was wir dadurch werden.“</i> <br> (John Ruskin)</p>'; break;
                                case 2: echo '<p class="card-text"><i>„Es gibt zwei Arten, Schwierigkeiten zu begegnen: Entweder du änderst die Schwierigkeiten oder du änderst dich.“</i><br> (Phyllis Bottome)</p>'; break;
                                case 3: echo '<p class="card-text"><i>„Der sicherste Weg zum Erfolg ist immer, es noch einmal zu versuchen.“</i><br> (Thomas Alva Edison)</p>'; break;
                                case 4: echo '<p class="card-text"><i>„Ein Problem ist halb gelöst, wenn es klar formuliert ist.“</i> <br>(John Dewey)</p>'; break;
                            }
                            ?>
                    </div>   
            </div>
        </div>
        <div class="col-md-auto">
            <div class="card-body">
                    <h5 class="card-title">Denken Sie dran!</h5>
                    <p class="card-text">Warten Sie auf weitere Teilnehmer. <br>Die Meetingleitung beginnt die Retrospektive
                        in Kürze.</p>
                    <p class="card-text">Schaffen Sie eine offene Atmosphäre.</p>
                    <p class="card-text">Alle Teilnehmer sollen sich wohlfühlen.</p> 
                    <p class="card-text">Nehmen Sie immer an, dass jeder die
                        bestmögliche Arbeit geleistet hat.</p><br>
                    
            </div>
        </div>
    </div>
        

        </main>
<?php require('../partials/footer.php');?>