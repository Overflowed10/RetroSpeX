<?php

function saveSummaries(){
    $categorie_arr = $_POST["category"];
    $target_state_arr = $_POST["target_state"];
    $todo_arr = $_POST["todo"];
    $meeting_id =  $_POST["retroId"];

    // GET category names and ids corresponding to meeting_id
    $db = new Database();
    $pdo = $db->connect();
    $sql = 'SELECT `category`.`id`, `category`.`name` FROM `category` INNER JOIN `answer` ON `category`.`id` = `answer`.`category_id` WHERE `answer`.meeting_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($meeting_id));          
    $categories_sql = $stmt->fetchall();
    
    // ITERATE over GET[categories] and INSERT INTO Database each category summary that is unique
    $used_category_names = array();
    // FOR EACH submitted category...  
    for ($i=0; $i<(count($categorie_arr)-1); $i++){
        // SKIP empty categories 
        if ($categorie_arr[$i]=="Überkategorie auswählen"){
            continue;
        }
        // IF NOT duplicate category...
        if (!in_array($categorie_arr[$i], $used_category_names)){
            // GET category_id of said category
            for ($j=0; $j<count($categories_sql); $j++){
                if ($categories_sql[$j]["name"] == $categorie_arr[$i]){
                    echo "Team Chemie"==$categories_sql[$j]["name"];
                    $category_id = $categories_sql[$j]["id"];
                    break;
                }
            }
            
            // INSERT INTO Database
            $sql = 'INSERT INTO `summary`(`category_id`, `meeting_id`, `target_state`, `todo`) VALUES (?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($category_id, $meeting_id, $target_state_arr[$i], $todo_arr[$i]));            
        }
            // ADD category name to used_category_names array to avoid double summarys to same category
            $used_category_names[] = $categorie_arr[$i];
    }
    header('Location: meeting.metaquestions.php?id='.$_POST['id'].'&name='.$_POST["name"].'&retroId='.$_POST["retroId"].'&retroName='.$_POST["retroName"].'');
}
?>