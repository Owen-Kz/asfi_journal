<?php

include "../db.php";

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data["id"])){
    $announcementId = $data["id"];
    $verifyCode = $data["verifyCode"];
    if(!empty($verifyCode)){
        // Verify the code if provided
        $stmtCode = $con->prepare("SELECT * FROM `verificationcodes` WHERE `code` = ?");
        $stmtCode->bind_param("s", $verifyCode);
        if ($stmtCode->execute()) {
            $resultCode = $stmtCode->get_result();
            if($resultCode->num_rows == 0){
                $response = array("error"=>"Invalid verification code");
                echo json_encode($response);
                exit;
            }
        } else {
            $response = array("error"=>$stmtCode->error);
            echo json_encode($response);
            exit;
        }
    }
    
    if(empty($announcementId)){
        $response = array("error"=>"Announcement ID cannot be empty");
        echo json_encode($response);
        exit;
    }
    // Check if the announcement exists
    $stmtCheck = $con->prepare("SELECT * FROM `announcements` WHERE `id` = ?");
    $stmtCheck->bind_param("i", $announcementId);   
    if(!$stmtCheck->execute()){
        $response = array("error"=>$stmtCheck->error);
        echo json_encode($response);
        exit;
    }
    $resultCheck = $stmtCheck->get_result();
    if($resultCheck->num_rows == 0){
        $response = array("error"=>"Announcement not found");
        echo json_encode($response);
        exit;
    }

    // Prepare the SQL statement
    $stmt = $con->prepare("DELETE FROM `announcements` WHERE `id` = ?");
    $stmt->bind_param("i", $announcementId);

    // Execute the statement
    if($stmt->execute()){
        $response = array("success"=>"Announcement deleted");
        echo json_encode($response);
    }else{
        $response = array("error"=>$stmt->error);
        echo json_encode($response);
    }
}else{
    $response = array("error"=>"Announcement ID not Provided");
    echo json_encode($response);
}
