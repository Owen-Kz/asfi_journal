<?php

include "../db.php";

if(isset($_GET["xid"])){
    $announcementId = $_GET["xid"];

    // Prepare the SQL statement
    $stmt = $con->prepare("SELECT * FROM `announcements` WHERE `slug` = ? OR id = ?");
    $stmt->bind_param("ss", $announcementId, $announcementId);

    // Execute the statement
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $announcement = $result->fetch_assoc();
            echo json_encode($announcement);
        }else{
            $response = array("error"=>"Announcement not found");
            echo json_encode($response);
        }
    }else{
        $response = array("error"=>$stmt->error);
        echo json_encode($response);
    }
}else{
    $response = array("error"=>"Invalid request");
    echo json_encode($response);
}
