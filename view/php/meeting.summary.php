<?php 
require('../partials/meeting.head.php'); 
require('../partials/meeting.top_navbar.php');
require('../partials/progressbar/progressbar.phase4.php');
include('../../controller/meeting.save_summary.php');?>

<script src="../js/meeting.summary.js"></script>


<?php  
$db = new Database();
$pdo = $db->connect();

if(isset($_POST['next'])){ 
    if(isset($_SESSION['ref'])){
        setCurrentState($_GET['retroId'], 5);
        saveSummaries();
    }
    $sql = "SELECT * FROM meeting WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($_GET['retroId']));
    $meeting = $stmt->fetch();
    if($meeting['current_state'] === "6"){
        header('Location: meeting.metaanswers.php?id='.$_GET['id'].'&name='.$_GET['name'].'&retroId='.$_GET['retroId'].'&retroName='.$_GET['retroName']);     
    }   
}
 
$team_id = $_GET["id"];
$team_name = $_GET['name'];
$retro_id = $_GET["retroId"];
$retro_name = $_GET["retroName"];


// GET Answers
$sql = "SELECT * FROM answer a
            INNER JOIN category c ON a.category_id = c.`id`
            INNER JOIN question q ON q.`id` = a.question_id
        WHERE a.meeting_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($retro_id));
$answers = $stmt->fetchall(PDO::FETCH_ASSOC);

// GET category names of corresponding answers
$sql = 'SELECT `name` FROM `category` INNER JOIN `answer` ON `category`.`id` = `answer`.`category_id` WHERE `answer`.meeting_id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($retro_id));
$sql_categories_notUnique = $stmt->fetchall(PDO::FETCH_NUM);
?>

<?php
// EACH category only once 
$sql_categories = array();
foreach ($sql_categories_notUnique as $row){ if(!in_array($row, $sql_categories)){$sql_categories[] = $row;}}
?>

<main>    
    <?php
    // IF Referent
    if(isset($_SESSION['ref'])){ ?>

    <div class="container-fluid text-right">
            <button class="btn btn-green mr-5" form="summary_form" type="submit">
                Abschicken und weiter
            </button>
    </div>
    <form id="summary_form" action="" method="POST">
        <input type="hidden" name="next">
        <div class="form-group container summary-box mt-5">
            <h2 class="text-center">Zusammenfassung</h2>
            <select id="custom-select" name="category[]" onchange="show_relevant_Answers()" class="custom-select">
                <option selected>Überkategorie auswählen</option>
                <?php
                    foreach($sql_categories as $option){
                    echo "<option>".$option[0]."</option>";
                    }
                ?>
            </select>   
            <input type="hidden" name="id" value="<?php echo $team_id; ?>">
            <input type="hidden" name="name" value="<?php echo $team_name; ?>">
            <input type="hidden" name="retroId" value="<?php echo $retro_id; ?>">
            <input type="hidden" name="retroName" value="<?php echo $retro_name; ?>">
            <div class="row justify-content-center">
                <div class="col text-center">
                    <label>Soll Zustand</label><br>
                    <textarea name="target_state[]" id="textarea" class="mb-2" cols="50" rows="6"
                        placeholder="Schreibe etwas ..."></textarea>
                </div>
                <div class="col text-center">
                    <label>ToDo's:</label><br>
                    <textarea name="todo[]" id="textarea" class="mb-3" cols="50" rows="6"
                        placeholder="Schreibe etwas ..."></textarea>
                </div>
            </div>
            <div class="card-columns justify-content-center">
                <?php                     
                        foreach ($answers as $row){
                            $answer_title = $row["name"];
                            $klebepunkte = $row["number_of_points"];
                            echo '<div class="card bg-warning">
                            <div class="card-header">
                                <span class="d-none"> <b>'.$answer_title.'</b> </span>
                                <p class="text-center"><b>'.$row["question"].'</b></p>
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text">'.$row["content"].'</p>
                                <p><small><i>'.$answer_title.'</i></small></p>
                            </div>
                        </div>';
                        }
                        ?>
            </div>
        </div>
        <div class="after-summary"></div>
        <div class="copy hidden-summary">
            <div class="form-group container summary-box mt-5">
                <h2 class="text-center">Zusammenfassung</h2>
                <select id="custom-select" name="category[]" onchange="show_relevant_Answers()" class="custom-select">
                    <option selected>Überkategorie auswählen</option>
                    <?php
                    foreach($sql_categories as $option){
                    echo "<option>".$option[0]."</option>";
                    }
                ?>
                </select>
                <div class="row justify-content-center">
                    <div class="col text-center">
                        <label>Soll Zustand</label><br>
                        <textarea name="target_state[]" id="textarea" class="mb-2" cols="50" rows="6"
                            placeholder="Schreibe etwas ..."></textarea>
                    </div>
                    <div class="col text-center">
                        <label>ToDo's:</label><br>
                        <textarea name="todo[]" id="textarea" class="mb-3" cols="50" rows="6"
                            placeholder="Schreibe etwas ..."></textarea>
                    </div>
                </div>
                <div class="card-columns">
                    <?php                     
                        foreach ($answers as $row){
                            $answer_title = $row["name"];
                            $klebepunkte = $row["number_of_points"];
                            echo '<div class="card bg-warning">
                            <div class="card-header">
                                <span class="d-none"> <b>'.$answer_title.'</b> </span>
                                <p class="text-center"><b>'.$row["question"].'</b></p>
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text">'.$row["content"].'</p>
                                <p><small><i>'.$answer_title.'</i></small></p>
                            </div>
                        </div>';
                        }
                        ?>
                </div>
            </div>
        </div>
    </form>

    <div class="container my-4 text-center">
        <button id="summary-hinzufuegen" type="button" class="btn btn-primary">+</button>
    </div>

    <?php
    // IF NOT referent
    } else { ?>
    <form action="" method="POST">
        <div class="container-fluid text-right">
            <input type="hidden" name="next">
            <button type="submit" class="btn btn-green mr-5">Weiter</button>
        </div> 
    </form>
        <div class="container-fluid m-3">        
            <?php foreach ($sql_categories as $category){ $i = 0?>
                <div class="container-fluid p-3 border text-center round-border my-3">
                    <?php echo '<h1>'.$category[$i].'</h1>'; ?>
                    <div class="row">

                        <?php foreach($answers as $answer){ ?>
                            <?php if ($answer["name"] == $category[$i]){ ?>
                                <?php                     
                                    echo '<div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 p-2">
                                            <div class="card bg-warning">
                                                <div class="card-header">
                                                    <p class="text-center"><b>'.$answer["question"].'</b></p>
                                                </div>
                                                <div class="card-body text-center">
                                                    <p class="card-text">'.$answer["content"].'</p>
                                                </div>
                                            </div>
                                        </div>';
                                ?>
                            <?php }
                            }
                        $i++;?>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
</main>

</body>
</html>