<?php
include "../CORS-setup.php";
include "../db.php";

session_start();

// Validate and sanitize input parameters
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$items_per_page = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 10; // Default to 10 items per page
$offset = ($page - 1) * $items_per_page;

$totalPages = 0;

if (isset($_GET['k'])) {
    $searchQuery = $_GET['k'];

    try {
        // Count total matching journals for search
        $countQuery = "SELECT COUNT(`id`) AS `totalJournals` FROM `journals` 
                      WHERE (LOWER(`manuscript_full_title`) LIKE CONCAT('%', LOWER(?), '%') 
                      OR LOWER(`manuscript_running_title`) LIKE CONCAT('%', LOWER(?), '%')) 
                      COLLATE utf8mb4_general_ci";
        
        $stmtCount = $con->prepare($countQuery);
        if (!$stmtCount) {
            throw new Exception("Failed to prepare count statement: " . $con->error);
        }

        $stmtCount->bind_param("ss", $searchQuery, $searchQuery);
        $stmtCount->execute();
        $resultC = $stmtCount->get_result();
        $rowC = $resultC->fetch_assoc();
        $journalCount = $rowC['totalJournals'];
        $totalPages = ceil($journalCount / $items_per_page);

        // Get paginated results
        $searchQuery = "%$searchQuery%";
        $dataQuery = "SELECT * FROM `journals` 
                     WHERE (LOWER(`manuscript_full_title`) LIKE LOWER(?) 
                     OR LOWER(`manuscript_running_title`) LIKE LOWER(?)) 
                     COLLATE utf8mb4_general_ci 
                     ORDER BY `id` DESC 
                     LIMIT ? OFFSET ?";

        $stmt = $con->prepare($dataQuery);
        if (!$stmt) {
            throw new Exception("Failed to prepare data statement: " . $con->error);
        }

        $stmt->bind_param("ssii", $searchQuery, $searchQuery, $items_per_page, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $articlesList = array();
        while ($row = $result->fetch_assoc()) {
            $articlesList[] = $row;
        }

        $response = array(
            'status' => 'success', 
            'articlesList' => $articlesList, 
            'totalPages' => $totalPages, 
            'currentPage' => $page,
            'totalItems' => $journalCount
        );
        echo json_encode($response);

    } catch (Exception $e) {
        $response = array(
            'status' => 'error', 
            'message' => $e->getMessage(), 
            'articlesList' => [], 
            'totalPages' => 0, 
            'currentPage' => 0
        );
        echo json_encode($response);
    }
} else {
    try {
        // Count total journals
        $stmtCount = $con->prepare("SELECT COUNT(`id`) AS `totalJournals` FROM `journals`");
        if (!$stmtCount) {
            throw new Exception("Failed to prepare count statement: " . $con->error);
        }

        $stmtCount->execute();
        $resultC = $stmtCount->get_result();
        $rowC = $resultC->fetch_assoc();
        $journalCount = $rowC['totalJournals'];
        $totalPages = ceil($journalCount / $items_per_page);

        // Get paginated results
        $stmt = $con->prepare("SELECT * FROM `journals` ORDER BY `id` DESC LIMIT ? OFFSET ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare data statement: " . $con->error);
        }

        $stmt->bind_param("ii", $items_per_page, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $articlesList = array();
        while ($row = $result->fetch_assoc()) {
            $articlesList[] = $row;
        }

        $response = array(
            'status' => 'success', 
            'articlesList' => $articlesList, 
            'totalPages' => $totalPages, 
            'currentPage' => $page,
            'totalItems' => $journalCount
        );
        echo json_encode($response);

    } catch (Exception $e) {
        $response = array(
            'status' => 'error', 
            'message' => $e->getMessage(), 
            'articlesList' => [], 
            'totalPages' => 0, 
            'currentPage' => 0
        );
        echo json_encode($response);
    }
}
