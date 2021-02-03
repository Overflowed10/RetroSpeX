<?php 
require('../partials/meeting.head.php'); 
require('../partials/meeting.top_navbar.php');
require('../partials/progressbar/progressbar.phase2.php');
require('../../controller/answerController.php');

$db = new Database();
$pdo = $db->connect();
  
$meetingId = $_GET['retroId'];


$sql = "SELECT m.number_of_cards, q.id, q.question FROM `meeting` as m  INNER JOIN `question` as q ON m.retrotype_id = q.retrotype_id WHERE m.id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute(array($meetingId));
$result = $stmt->fetchAll();

$questionCount = count($result);
$answerCardCount = $result[0]["number_of_cards"];


$newIndex = intval($_GET['qIdx']) + 1;
$currentQuestion = $result[$newIndex]["question"];
$currentQuestionCount = intval($newIndex) + 1;
$questionId = $result[$newIndex]["id"];

if(isset($_POST['nextQuestion'])){
  if(intval($newIndex) < intval($questionCount)-1){
    for($i = 0; $i < $answerCardCount; $i++){
      $index = "answerCard".$i;
      $content = $_POST[$index];
      if($content){
          if(trim($content) != ""){
            saveAnswer($_SESSION['user']->id, $_GET['retroId'], $_POST['questionId'], $content);
          }
        }
      }
    header("Location: meeting.fill_in_cards.redirection.php?id=".$_GET['id']."&name=".$_GET['name']."&retroId=".$_GET['retroId']."&retroName=".$_GET['retroName']."&qIdx=".$newIndex);
  }else{
    for($i = 0; $i < $answerCardCount; $i++){
      $index = "answerCard".$i;
      $content = $_POST[$index];
      if($content){
          if(trim($content) != ""){
            saveAnswer($_SESSION['user']->id, $_GET['retroId'], $_POST['questionId'], $content);
          }
        }
      }
      if(isset($_SESSION['ref'])){
        setCurrentState($_GET['retroId'], 3);
      }else{
        $_SESSION['autorefresh'] = true;
      }
    header("Location: meeting.erkenntnisse_entwickeln.view.php?id=".$_GET['id']."&name=".$_GET['name']."&retroId=".$_GET['retroId']."&retroName=".$_GET['retroName']);
  }
}

?>

<main>
  <div class="container mt-3 ">
    <div class="slidedown"></div>
    <h4 id='askedQuestion' name ='askedQuestion' class='text-white'><?php echo $currentQuestion ?></h4>
    

    <form action="" method="POST">
      <input type="hidden" name="questionId" value="<?php echo $questionId;?>">
      <!-- Carousel basierend auf: https://www.w3schools.com/bootstrap4/bootstrap_carousel.asp -->
      <div id="myCarousel" class="carousel slide " data-interval="false">

        <ul class="carousel-indicators">

          <?php
          for($i = 0; $i < $answerCardCount; $i++){
            if($i == 0){
              echo "<li data-target='#myCarousel' data-slide-to='$i' class='active'></li>";
            } else {
              echo "<li data-target='#myCarousel' data-slide-to='$i'</li>";
            }
          }
          ?>
        </ul>

        <div class="carousel-inner bg-customdark">

          <?php
          for($i=0; $i < $answerCardCount; $i++){
            if($i == 0){
              echo "<div class='carousel-item active'>";
            } else {
              echo "<div class='carousel-item'>";
            }
              ?>
          <div class='card'>
            <div class='card-header'>
              Ihre Antwort:
            </div>
            <div class='card-body'>
              <div class='form-group'>
                <textarea maxlength='500' class='form-control' name='answerCard<?php echo $i ?>' rows='7'></textarea>
              </div>
            </div>
          </div>
        </div>
        <?php
           }
        ?>

           <style>
             .questionNumber {
                color: lightgrey;
                text-align: center;
            }
            </style>

      <!-- Left and right controls -->
      <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
  </div>
</main>

<div class="container justify-content-center">
<p class="questionNumber">  <span id="questionNumber">Frage <?php echo $currentQuestionCount?>/<?php echo $questionCount?></span> </p>
</div>
  <div id="buttonOnBottomRight">
    <button type="submit" class="btn btn-green" id="nextQuestion" name="nextQuestion">
      <?php if($currentQuestionCount != $questionCount){
          echo "Nächste Frage";
      } else {
          echo "Weiter";
      }?></button>
  </div>

  </form>
</main>


<?php require('../partials/footer.php'); ?>