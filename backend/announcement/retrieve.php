<?php 
include "../db.php";

if(isset($_GET["priority"])){
    $priority = $_GET["priority"];
    
    // Prepare the SQL statement
    $stmt = $con->prepare("SELECT * FROM `announcements` WHERE `priority` = ?");
    $stmt->bind_param("s", $priority);
    // Execute the statement
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $announcements = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($announcements);
        }
    } else {
        $response = array("error"=>$stmt->error);
        echo json_encode($response);
    }
} else {
    // Default to retrieving all announcements
    $stmt = $con->prepare("SELECT * FROM `announcements`");
    if(!$stmt){
        $response = array("error"=>$con->error);
        echo json_encode($response);
        exit;
    }
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $announcements = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($announcements);
        } else {
            $response = array("error"=>"No announcements found");
            echo json_encode($response);
        }
    } else {
        $response = array("error"=>$stmt->error);
        echo json_encode($response);
    }
}

