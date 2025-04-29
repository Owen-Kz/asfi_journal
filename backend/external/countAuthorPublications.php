<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include "../db.php";

$author = $_GET["author"] ?? null;

if ($author) {
    try {
        // Find all authors matching the search parameter
        $stmt = $con->prepare("SELECT article_id FROM `authors` WHERE `authors_fullname` LIKE ?");
        if (!$stmt) {
            error_log("Prepare failed: " . $con->error);
            echo json_encode(['status' => 'internalError', 'message' => "Database error", 'count' => 0]);
            exit();
        }

        $searchParam = "%" . $author . "%";
        $stmt->bind_param("s", $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
        $articleIDs = [];

        while ($row = $result->fetch_assoc()) {
            $articleIDs[] = $row["article_id"];
        }

        if (!empty($articleIDs)) {
            // Dynamic placeholders
            $placeholders = implode(',', array_fill(0, count($articleIDs), '?'));
            $types = str_repeat('i', count($articleIDs)); // assuming article_id is INT

            $query = "SELECT COUNT(*) as count FROM `journals` WHERE `buffer` IN ($placeholders)";
            $stmtArticles = $con->prepare($query);
            if (!$stmtArticles) {
                error_log("Prepare failed: " . $con->error);
                echo json_encode(['status' => 'internalError', 'message' => "Database error", 'count' => 0]);
                exit();
            }

            $stmtArticles->bind_param($types, ...$articleIDs);
            $stmtArticles->execute();
            $articlesResult = $stmtArticles->get_result();
            $row = $articlesResult->fetch_assoc();
            $count = (int) $row['count'];

            echo json_encode(['status' => 'success', 'count' => $count]);
        } else {
            echo json_encode(['status' => 'error', 'message' => "Author '$author' not found", 'count' => 0]);
        }
    } catch (Exception $e) {
        error_log("Exception: " . $e->getMessage());
        echo json_encode(['status' => 'internalError', 'message' => "Exception: " . $e->getMessage(), 'count' => 0]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing author parameter', 'count' => 0]);
}
?>
