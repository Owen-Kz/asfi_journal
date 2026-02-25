<?php
// Define target directory for file upload
include "db.php";
include "./CORS-setup.php";
session_start();

// Receive all data from form inputs
$token = $_POST["token"];
$manuscript = $_POST["title"];
$quillContent = json_decode($_POST['article_content'], true);
$abstract = json_encode($quillContent);

$targetDir = "../useruploads/manuscripts/";
$targetDirImage = "../useruploads/article_images/";

// Initialize file variables
$manuscriptFile = "";
$targetFile = "";
$newFileName = "";
$coverImageName = "";
$newFileNameImage = "";
$uploadOk = 1;

// Check if manuscript file was uploaded
if(isset($_FILES["manuscript_file"]) && $_FILES["manuscript_file"]["error"] == 0){
    $manuscriptFile = basename($_FILES["manuscript_file"]["name"]);
    $targetFile = $targetDir . $manuscriptFile;
    $newFileName = time() . '_' . $manuscriptFile;
}

// Check if cover image was uploaded
if(isset($_FILES["manuscriptCover"]) && $_FILES["manuscriptCover"]["error"] == 0){
    $manuscriptFileImage = basename($_FILES["manuscriptCover"]["name"]);
    $targetFileImage = $targetDirImage . $manuscriptFileImage;
    $coverPhotoExtension = pathinfo($manuscriptFileImage, PATHINFO_EXTENSION);
    $newFileNameImage = time() . '_coverImage.' . $coverPhotoExtension;
}

// Check if files should be removed
$removeCover = isset($_POST["remove_cover"]) && $_POST["remove_cover"] === "true";
$removeManuscript = isset($_POST["remove_manuscript"]) && $_POST["remove_manuscript"] === "true";

// Initialize variables
if($targetFile != "") {
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
}

$abstractDiscussion = "";
if(isset($_POST["article_abstract"])){
    $abstractContent = json_decode($_POST["article_abstract"], true);
    $abstractDiscussion = json_encode($abstractContent);
}
 
// Get all Authors information 
try {
    $stmt = $con->prepare("SELECT * FROM `journals` WHERE `buffer` =? ");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $con->error);
    }

    $stmt->bind_param("s", $token);

    if (!$stmt->execute()) {
        throw new Exception("Failed to execute statement Author: " . $stmt->error);
    } else {
        $result = $stmt->get_result();
        $run_query = $result;
        $count = mysqli_num_rows($run_query);

        if($count > 0){
            // Get current article data to know existing files
            $currentData = $result->fetch_assoc();
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $authorsArray = $_POST["authorsArray"];
                $explodeAuthors = explode(",", $authorsArray);
                $explodeAuthorsArray = array_map('trim', $explodeAuthors);
                $authors = $explodeAuthorsArray;
                
                $correspondingAuthorsEmail = $_POST["corresponding_author"];
                
                // First Delete the Authors 
                $delete = $con->prepare("DELETE FROM `authors` WHERE `article_id` = ?");
                if(!$delete){
                    throw new Exception("Failed to prepare statement: " . $con->error);
                }
                $delete->bind_param("s", $token);
                
                if (!$delete->execute()) {
                    throw new Exception("Failed to execute statement Author: " . $delete->error);
                }
                
                // Insert new authors
                for ($i = 0; $i < count($authors); $i++){
                    $authorsFullname = $authors[$i];
                    
                    try {
                        $stmt = $con->prepare("INSERT INTO `authors`(`authors_fullname`, `article_id`) VALUES(?, ?)");
                        if (!$stmt) {
                            throw new Exception("Failed to prepare statement: " . $con->error);
                        }
                        $stmt->bind_param("ss", $authorsFullname, $token);
                        if (!$stmt->execute()) {
                            throw new Exception("Failed to execute statement Author: " . $stmt->error);
                        }          
                    } catch (Exception $e) {
                        $response = array('status'=> 'error', 'message' => 'ErrorAuthor:' . $e->getMessage());
                        echo json_encode($response);
                        exit;
                    }
                }
                
                // Prepare base update query
                $updateQuery = "UPDATE `journals` SET `manuscript_full_title` = ?, `unstructured_abstract` = ?, `abstract_discussion` = ?, `corresponding_authors_email` = ?";
                $updateParams = array($manuscript, $abstract, $abstractDiscussion, $correspondingAuthorsEmail);
                $paramTypes = "ssss";
                
                // Handle manuscript file upload (new file replaces old one)
                if(isset($_FILES["manuscript_file"]) && $_FILES["manuscript_file"]["error"] == 0){
                    if (move_uploaded_file($_FILES["manuscript_file"]["tmp_name"], $targetDir . $_FILES["manuscript_file"]["name"])) {
                        rename($targetDir . $_FILES["manuscript_file"]["name"], $targetDir . $newFileName);
                        $updateQuery .= ", `manuscript_file` = ?";
                        $updateParams[] = $newFileName;
                        $paramTypes .= "s";
                        
                        // Delete old manuscript file if it exists
                        if (!empty($currentData['manuscript_file']) && file_exists($targetDir . $currentData['manuscript_file'])) {
                            unlink($targetDir . $currentData['manuscript_file']);
                        }
                    }
                } 
                // Handle manuscript removal (without new upload)
                else if ($removeManuscript) {
                    $updateQuery .= ", `manuscript_file` = NULL";
                    
                    // Delete old manuscript file if it exists
                    if (!empty($currentData['manuscript_file']) && file_exists($targetDir . $currentData['manuscript_file'])) {
                        unlink($targetDir . $currentData['manuscript_file']);
                    }
                }
                
                // Handle cover image upload (new file replaces old one)
                if(isset($_FILES["manuscriptCover"]) && $_FILES["manuscriptCover"]["error"] == 0){
                    if (move_uploaded_file($_FILES["manuscriptCover"]["tmp_name"], $targetDirImage . $_FILES["manuscriptCover"]["name"])) {
                        rename($targetDirImage . $_FILES["manuscriptCover"]["name"], $targetDirImage . $newFileNameImage);
                        $updateQuery .= ", `manuscriptPhoto` = ?";
                        $updateParams[] = $newFileNameImage;
                        $paramTypes .= "s";
                        
                        // Delete old cover image if it exists
                        if (!empty($currentData['manuscriptPhoto']) && file_exists($targetDirImage . $currentData['manuscriptPhoto'])) {
                            unlink($targetDirImage . $currentData['manuscriptPhoto']);
                        }
                    }
                }
                // Handle cover image removal (without new upload)
                else if ($removeCover) {
                    $updateQuery .= ", `manuscriptPhoto` = NULL";
                    
                    // Delete old cover image if it exists
                    if (!empty($currentData['manuscriptPhoto']) && file_exists($targetDirImage . $currentData['manuscriptPhoto'])) {
                        unlink($targetDirImage . $currentData['manuscriptPhoto']);
                    }
                }
                
                // Complete the update query
                $updateQuery .= " WHERE `buffer` = ?";
                $updateParams[] = $token;
                $paramTypes .= "s";
                
                // Prepare and execute the update
                $update = $con->prepare($updateQuery);
                if (!$update) {
                    throw new Exception("Failed to prepare update: " . $con->error);
                }
                
                $update->bind_param($paramTypes, ...$updateParams);
                
                if($update->execute()){
                    $response = array("status" => "success", "message" => "Article Updated Successfully");
                    echo json_encode($response);
                } else {
                    throw new Exception("Failed to update article: " . $update->error);
                }
            } else {
                $response = array('status'=> 'error', 'message' => "Bad request format");
                echo json_encode($response);
            }
        } else {
            $response = array('status'=> 'error', 'message' => 'This Manuscript does not exist');
            echo json_encode($response);
        }
    }
} catch (Exception $e) {
    $response = array('status'=> 'internalError', 'message' => "Error: " . $e->getMessage());
    echo json_encode($response);
}
?>