<?php 
require("../model/User.php");
require("../fpdf/fpdf.php"); 
require("../core/Database.php");
require("isRole.php");
session_start();

$meeting_id = $_GET["id"];

// SELECT all summaries corresponding to the meeting_id
$db = new Database();
$pdo = $db->connect();   
$sql = 'SELECT `summary`.`id` as "summary_id", `summary`.`target_state`, `summary`.`todo`, `category`.`name` as "category_name", `summary`.`category_id` 
        FROM `summary` 
            INNER JOIN `category` ON `category`.`id` = `summary`.`category_id`
        WHERE `summary`.`meeting_id` = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($meeting_id));
$summaries = $stmt->fetchAll();

// SELECT Team and Meeting name
$sql = 'SELECT `meeting`.`name` as "meetingName", `teams`.`name` as "teamName", `meeting`.`date` FROM `meeting` INNER JOIN `teams` ON `meeting`.`team_id` = `teams`.`id` WHERE `meeting`.`id` = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($meeting_id));
$metainfo = $stmt->fetchAll()[0];

// SELECT isMod?
$sql = 'SELECT * FROM `meeting` INNER JOIN `teams_users` ON `meeting`.`team_id` = `teams_users`.`team_id` WHERE `meeting`.`id` = ? AND `teams_users`.`user_id` = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($meeting_id, $_SESSION['user']->id));
$isMod = $stmt->fetch();

$isMod = $isMod["local_role"] == "moderator";

// SETUP for pdf-file
$nl = "\n";
$pdf = new FPDF();
$pdf->AddPage("P", "A4");
$pdf->SetFont("Arial", "B", 24);
$quarter_page_width = $pdf->GetPageWidth()/4;

// TITLE
$pdf->Write(0, str_repeat(" ", 24)."Zusammenfassung".$nl, 0, 0, "C");
// TEAM
$pdf->SetFont("Arial", "",16);
$pdf->Write(20, "Team: ");
$pdf->SetFont("Arial", "i", 16);
$pdf->Write(20, iconv('utf-8','cp1252',$metainfo["teamName"].$nl));
// RETROSPECTIVE
$pdf->SetFont("Arial", "",16);
$pdf->Write(0, "Retrospektive: ");
$pdf->SetFont("Arial", "i",16);
$pdf->Write(0, iconv('utf-8','cp1252',$metainfo["meetingName"].$nl));
// DATE
$pdf->SetFont("Arial", "",16);
$pdf->Write(20, "Datum: ");
$pdf->SetFont("Arial", "i",16);
$date = date('d.m.Y H:i:s', strtotime($metainfo["date"]));
$pdf->Write(20, $date.$nl);


// New Line for formatting reasons
$pdf->Write(0, $nl);

foreach ($summaries as $summary){
    $targetHead = str_repeat(" ", $quarter_page_width+5)."Soll-Zustand".$nl.$nl;
    $targetContent = $summary["target_state"].$nl;
    $todoHead = str_repeat(" ", $quarter_page_width+5)."ToDo".$nl.$nl;
    $todoContent = $summary["todo"].$nl;

    // WRITE category
    $pdf->SetFont("Arial", "B", 16);
    $pdf->MultiCell(0,10, iconv('utf-8','cp1252',$summary["category_name"]), 1, "l", false);

    // WRITE target-state and todo
    $pdf->SetFont("Arial", "", 16);
    $pdf->MultiCell(0,8, iconv('utf-8','cp1252',$todoHead.$todoContent), 1, "l", false);
    $pdf->MultiCell(0,8, iconv('utf-8','cp1252',$targetHead.$targetContent), 1, "l", false);

    if (isAdmin() || $isMod){
        // SELECT Answers 
        $sql = "SELECT question, firstname, lastname, content FROM `answer` a JOIN `users` u ON u.id=a.user_id JOIN question q ON q.id=a.question_id WHERE a.meeting_id=? AND a.category_id=? ORDER BY a.question_id ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($meeting_id, $summary["category_id"]));
        $data = $stmt->fetchAll(); 

        foreach ($data as $row){
            $nameContent = "Name: ".$row[1]." ".$row[2].$nl;
            $qContent = "Frage: ".$row[0].$nl;
            $aContent = "Antwort: ".$row[3].$nl;
            $content = iconv('utf-8','cp1252',$nameContent.$qContent.$aContent);

            $pdf->SetFont("Arial", "", 16);
            $pdf->MultiCell(0,8, $content, 1, "l", false);
        }
    }

    // New Line for formatting reasons
    $pdf->Write(8, $nl);
}
$pdf->Output("", $metainfo["teamName"]."_".$metainfo["date"]."pdf");
?>