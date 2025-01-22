<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include "../../backend/db.php";



$data = json_decode(file_get_contents("php://input"), true);

$article_id = $data["article_id"];

if($article_id){
    try{
        $stmt = $con->prepare("DELETE FROM `journals` WHERE `buffer` = ?");
    
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $con->error);
        }
    
        $stmt->bind_param("s", $article_id);
    
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }else{
            $stmt = $con->prepare("DELETE FROM `authors` WHERE `article_id` = ?");
    
            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $con->error);
            }
        
            $stmt->bind_param("s", $article_id);
            $stmt->execute();
            
            $response = array("status" => 'success', "message" => "Item Deleted Successfully");
            echo Json_encode($response);
            // header("Location:https://asfirj.org/manuscriptPortal/manage");
        }
    }
 catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

}else{
$response = array('status' => 'error', 'articleData' => '[]', 'message' => 'Query Not Set');
echo json_encode($response);
}