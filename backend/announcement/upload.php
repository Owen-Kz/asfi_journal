<?php

include "../db.php";

$targetDir = "../useruploads/announcements/";
$data = json_decode(file_get_contents("php://input"), true);

$announcementTitle = $data["title"] ?? "";
$announcementContent = $data["content"] ?? "";
$priority = $data["priority"] ?? 0; // Default to '0' if not set
$verifyCode = $data["verifyCode"];
$slug = strtolower(str_replace(" ", "-", $announcementTitle));
$adminEmail = $data["adminEmail"] ?? ""; // Optional admin email

if(isset($data["title"]) && isset($data["content"]) && isset($data["priority"])){

    // First verify that the code is correct 
    $stmtCode = $con->prepare("SELECT * FROM `verificationcodes` WHERE `code` =?");
    $stmtCode->bind_param("s", $verifyCode);
    if ($stmtCode->execute()) {
        $resultCode = $stmtCode->get_result();
        $count = mysqli_num_rows($resultCode);

        if($count > 0){
            // Code is valid, proceed with announcement creation
        } else {
            $response = array("error"=>"Invalid verification code");
            echo json_encode($response);
            exit;
        }
    } else {
        $response = array("error"=>$stmtCode->error);
        echo json_encode($response);
        exit;
    }

if(isset($data["title"]) && isset($data["content"]) && isset($data["priority"])){

    // Prepare the SQL statement
    $stmt = $con->prepare("INSERT INTO `announcements` (`title`, `data`, `priority`, `slug`, `admin_email`) VALUES (?, ?, ?, ?, ?)");
    if(!$stmt){
        $response = array("error"=>$stmt->error);
        echo json_encode($response);
        exit;
    }

    // Bind parameters
    $stmt->bind_param("sssss", $announcementTitle, $announcementContent, $priority, $slug, $adminEmail);

    // Execute the statement
    if($stmt->execute()){
        $response = array("success"=>"Announcement Created");
        echo json_encode($response);
    }else{
        $response = array("error"=>$stmt->error);
        echo json_encode($response);
    }
        exit;
        }else{
    $response = array("error"=>"Required fields are missing");
    echo json_encode($response);
    exit;
    }
}