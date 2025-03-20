<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include "../db.php";

$author = $_GET["author"];

if (isset($author)) {
    try {
        // Find all authors matching the search parameter
        $stmt = $con->prepare("SELECT article_id FROM `authors` WHERE `authors_fullname` LIKE ?");
        
        if (!$stmt) {
            echo json_encode(['status' => 'internalError', 'message' => "Error: " . $con->error, 'articlesList' => []]);
            exit();
        }

        $searchParam = "%" . $author . "%"; // Partial match
        $stmt->bind_param("s", $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
        $authorsCount = $result->num_rows;

        if ($authorsCount > 0) {
            $articlesList = [];

            // Collect all article IDs from matching authors
            $articleIDs = [];
            while ($row = $result->fetch_assoc()) {
                $articleIDs[] = $row["article_id"];
            }

            if (!empty($articleIDs)) {
                // Convert array to comma-separated values for SQL query
                $placeholders = implode(',', array_fill(0, count($articleIDs), '?'));

                // Prepare statement to find all related articles
                $stmtArticles = $con->prepare("SELECT * FROM `journals` WHERE `buffer` IN ($placeholders)");
                if (!$stmtArticles) {
                    echo json_encode(['status' => 'internalError', 'message' => "Error: " . $con->error, 'articlesList' => []]);
                    exit();
                }

                // Bind parameters dynamically
                $stmtArticles->bind_param(str_repeat('s', count($articleIDs)), ...$articleIDs);
                $stmtArticles->execute();
                $articlesResult = $stmtArticles->get_result();

                while ($article = $articlesResult->fetch_assoc()) {
                    $articlesList[] = $article;
                }
            }

            if (!empty($articlesList)) {
                echo json_encode(['status' => 'success', 'articlesList' => $articlesList]);
            } else {
                echo json_encode(['status' => 'error', 'message' => "No articles found for author: $author", 'articlesList' => []]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => "Author '$author' not found", 'articlesList' => []]);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'internalError', 'message' => "Error: " . $e->getMessage(), 'articlesList' => []]);
    }
}
?>
