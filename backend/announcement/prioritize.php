<?php

include "../db.php";
$data = json_decode(file_get_contents("php://input"), true);

if(isset($data["id"]) && isset($data["priority"])){
    $announcementId = $data["id"];
    $newPriority = $data["priority"];

    // Prepare the SQL statement
    $stmt = $con->prepare("UPDATE `announcements` SET `priority` = ? WHERE `id` = ?");
    $stmt->bind_param("si", $newPriority, $announcementId);

    // Depriotize other announcements 
    $stmtDeprioritize = $con->prepare("UPDATE `announcements` SET `priority` = 0 WHERE `id` != ?");
    $stmtDeprioritize->bind_param("i", $announcementId);
    $stmtDeprioritize->execute();

    // Execute the statement
    if($stmt->execute()){
        $response = array("success"=>"Announcement prioritized");
        echo json_encode($response);
    }else{
        $response = array("error"=>$stmt->error);
        echo json_encode($response);
    }
}else{
    $response = array("error"=>"Invalid request");
    echo json_encode($response);
}
