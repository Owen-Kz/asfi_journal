<?php
include "../CORS-setup.php";
include "../db.php";

session_start();

$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$items_per_page = 6;
$offset = ($page - 1) * $items_per_page;

$totalPages = 0;

if (isset($_GET["k"])) {
    $searchQuery = $_GET["k"];

    try {
        // Count total matching journals for search
        $stmtCount = $con->prepare("SELECT COUNT(`id`) AS `totalJournals` FROM `journals` 
                                   WHERE `is_publication` = 'yes' 
                                   AND (LOWER(`manuscript_full_title`) LIKE CONCAT('%', LOWER(?), '%') 
                                   OR LOWER(`manuscript_running_title`) LIKE CONCAT('%', LOWER(?), '%')) 
                                   COLLATE utf8mb4_general_ci");
        
        if (!$stmtCount) {
            throw new Exception("Failed to prepare Count statement: " . $con->error);
        }
        
        $stmtCount->bind_param("ss", $searchQuery, $searchQuery);
        $stmtCount->execute();
        $resultC = $stmtCount->get_result();
        $rowC = mysqli_fetch_assoc($resultC);
        $journalCount = $rowC["totalJournals"];
        $totalPages = ceil($journalCount / $items_per_page);

        // Get paginated results
        $stmt = $con->prepare("SELECT * FROM `journals` 
                              WHERE `is_publication` = 'yes' 
                              AND (LOWER(`manuscript_full_title`) LIKE CONCAT('%', LOWER(?), '%') 
                              OR LOWER(`manuscript_running_title`) LIKE CONCAT('%', LOWER(?), '%')) 
                              COLLATE utf8mb4_general_ci 
                              ORDER BY `id` DESC 
                              LIMIT ? OFFSET ?");

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $con->error);
        }

        $stmt->bind_param("ssii", $searchQuery, $searchQuery, $items_per_page, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = mysqli_num_rows($result);

        $articlesList = array();
        while ($row = $result->fetch_assoc()) {
            $articlesList[] = $row;
        }

        $response = array(
            'status' => 'success', 
            'articlesList' => $articlesList, 
            'totalPages' => $totalPages, 
            'currentPage' => $page
        );
        echo json_encode($response);

    } catch (Exception $e) {
        $response = array(
            'status' => 'internalError', 
            'message' => "Error: " . $e->getMessage(), 
            'articlesList' => [], 
            'totalPages' => 0, 
            'currentPage' => 0
        );
        echo json_encode($response);
    }

} else {
    try {
        // Count total journals
        $stmtCount = $con->prepare("SELECT COUNT(`id`) AS `totalJournals` FROM `journals` WHERE `is_publication` = 'yes'");
        if (!$stmtCount) {
            throw new Exception("Failed to prepare Count statement: " . $con->error);
        }
        
        $stmtCount->execute();
        $resultC = $stmtCount->get_result();
        $rowC = mysqli_fetch_assoc($resultC);
        $journalCount = $rowC["totalJournals"];
        $totalPages = ceil($journalCount / $items_per_page);

        // Get paginated results
        $stmt = $con->prepare("SELECT * FROM `journals` WHERE `is_publication` = 'yes' ORDER BY `id` DESC LIMIT ? OFFSET ?");

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $con->error);
        }

        $stmt->bind_param("ii", $items_per_page, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = mysqli_num_rows($result);

        $articlesList = array();
        while ($row = $result->fetch_assoc()) {
            $articlesList[] = $row;
        }

        $response = array(
            'status' => 'success', 
            'articlesList' => $articlesList, 
            'totalPages' => $totalPages, 
            'currentPage' => $page
        );
        echo json_encode($response);

    } catch (Exception $e) {
        $response = array(
            'status' => 'internalServerError', 
            'message' => "Error: " . $e->getMessage(), 
            'articlesList' => [], 
            'totalPages' => 0, 
            'currentPage' => 0
        );
        echo json_encode($response);
    }
}
