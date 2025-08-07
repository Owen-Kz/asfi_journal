<?php

include "../db.php";
$data = json_decode(file_get_contents("php://input"), true);
$targetDir = "../useruploads/announcements/";

if(isset($data["id"]) && isset($data["title"]) && isset($data["content"])){
    $verifyCode = $data["verifyCode"]; 
    $stmtCode = $con->prepare("SELECT * FROM `verificationcodes` WHERE `code` = ?");
    $stmtCode->bind_param("s", $verifyCode);    
    if ($stmtCode->execute()) {
        $resultCode = $stmtCode->get_result();
        $count = mysqli_num_rows($resultCode);

        if($count == 0){
            $response = array("error"=>"Invalid verification code");
            echo json_encode($response);
            exit;
        }
    } else {
        $response = array("error"=>$stmtCode->error);
        echo json_encode($response);
        exit;
    }
    $announcementId = $data["id"];
    $newTitle = $data["title"];
    $newContent = $data["content"];
    $newPriority = $data["priority"] ?? 0; // Default to '0' if not set

    // Prepare the SQL statement
    $stmt = $con->prepare("UPDATE `announcements` SET `title` = ?, `data` = ?, `priority` = ? WHERE `id` = ?");
    $stmt->bind_param("ssii", $newTitle, $newContent, $newPriority, $announcementId);

    // Execute the statement
    if($stmt->execute()){
        $response = array("success"=>"Announcement updated");
        echo json_encode($response);
    }else{
        $response = array("error"=>$stmt->error);
        echo json_encode($response);
    }
}else{
    $response = array("error"=>"Invalid request");
    echo json_encode($response);
}
