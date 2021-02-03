<?php 

function saveInsights(){

$db = new Database();
$pdo = $db->connect();

    if(!empty($_POST['selected_answerId']) && !empty($_POST['selected_category'])){
        $answer_Ids = $_POST["selected_answerId"];
        $category_Ids = $_POST["selected_category"];
        for ($i = 0; $i<count($answer_Ids); $i++){
            if ($category_Ids[$i] == ""){
                continue;
            }
            $sql = 'UPDATE `answer` SET `category_id`=? WHERE `answer`.`id` = ?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($category_Ids[$i], $answer_Ids[$i]));            
        }
    }
}


