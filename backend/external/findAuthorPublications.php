<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include "../db.php";


// $data = json_decode(file_get_contents("php://input"),true);

$author = $_GET["author"];


if(isset($author)){
    
    try {
        $stmt = $con->prepare("SELECT * FROM `authors` WHERE `authors_fullname` LIKE ? ");

    
        if (!$stmt) {
            // throw new Exception("Failed to prepare statement: " . $con->error);
            $response = array('status'=> 'internalError', 'message' => "Error: " . $con->error, 'articlesList' => []);
            echo json_encode($response);
        }
    
        $stmt->bind_param("s",$author);
    
        if (!$stmt->execute()) {
            // throw new Exception("Failed to execute statement: " . $stmt->error);
               // throw new Exception("Failed to prepare statement: " . $con->error);
               $response = array('status'=> 'internalError', 'message' => "Error: " . $stmt->error, 'articlesList' => []);
               echo json_encode($response);
        }
        
        $result = $stmt->get_result();
        // $run_query = mysqli_query($con,$sql);
        $run_query = $result;    
        $count = mysqli_num_rows($run_query);
    
        if($count > 0){

            $row = mysqli_fetch_array($run_query);
            // Loop through each row in the result set and append it to the authorsList array
            $articlesID= $row["article_id"];

            // Find Article related to search parameter 
            $stmt = $con->prepare("SELECT * FROM `journals` WHERE `buffer` = ? ");
 
    
            if (!$stmt) {
                // throw new Exception("Failed to prepare statement: " . $con->error);
                $response = array('status'=> 'internalError', 'message' => "Error: " . $con->error, 'articlesList' => []);
                echo json_encode($response);
            }
        
            $stmt->bind_param("s",$articlesID);
        
            if (!$stmt->execute()) {
                // throw new Exception("Failed to execute statement: " . $stmt->error);
                $response = array('status'=> 'internalError', 'message' => "Error: " . $stmt->error, 'articlesList' => []);
                echo json_encode($response);
            }
            
            $result = $stmt->get_result();
            // $run_query = mysqli_query($con,$sql);
            $run_query = $result;    
            $count = mysqli_num_rows($run_query);
        
            if($count > 0){
                $articlesList = array();


            while ($row = $result->fetch_assoc()) {
                $articlesList[] = $row;
            }
            $response = array('status'=> 'success', 'articlesList' => $articlesList);
            echo json_encode($response);
            }else{
                $response = array('status'=> 'error', 'message' => "NO ARTICLES ISSUES with $author", 'articlesList' => []);
                echo json_encode($response);
            }
    
     
        }else{
            $response = array('status'=> 'success', 'message' => "Author, $author Not found",  'articlesList' => []);
        echo json_encode($response);
        }
        
    } catch (Exception $e) {
    
        $response = array('status'=> 'internalError', 'message' => "Error: " . $e->getMessage(), 'articlesList' => []);
        echo json_encode($response);
    }
    
}