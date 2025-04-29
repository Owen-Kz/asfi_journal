<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include "../db.php";

$author = $_GET["author"];

if (isset($author)) {
    try {
        $stmt = $con->prepare("SELECT article_id FROM `authors` WHERE `authors_fullname` LIKE ?");
        if (!$stmt) {
            echo json_encode(['status' => 'internalError', 'message' => "Error: " . $con->error, 'articlesList' => []]);
            exit();
        }

        $searchParam = "%" . $author . "%";
        $stmt->bind_param("s", $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
        $authorsCount = $result->num_rows;

        if ($authorsCount > 0) {
            $articlesList = [];
            $articleIDs = [];

            while ($row = $result->fetch_assoc()) {
                $articleIDs[] = $row["article_id"];
            }

            if (!empty($articleIDs)) {
                $placeholders = implode(',', array_fill(0, count($articleIDs), '?'));
                $stmtArticles = $con->prepare("SELECT * FROM `journals` WHERE `buffer` IN ($placeholders)");
                if (!$stmtArticles) {
                    echo json_encode(['status' => 'internalError', 'message' => "Error: " . $con->error, 'articlesList' => []]);
                    exit();
                }

                $stmtArticles->bind_param(str_repeat('s', count($articleIDs)), ...$articleIDs);
                $stmtArticles->execute();
                $articlesResult = $stmtArticles->get_result();

                while ($article = $articlesResult->fetch_assoc()) {
                    $articleID = $article['buffer'];

                    // Fetch co-authors for this article
                    $coAuthorsStmt = $con->prepare("SELECT authors_fullname FROM `authors` WHERE article_id = ?");
                    $coAuthorsStmt->bind_param("s", $articleID);
                    $coAuthorsStmt->execute();
                    $coAuthorsResult = $coAuthorsStmt->get_result();

                    $coAuthors = [];
                    while ($coAuthorRow = $coAuthorsResult->fetch_assoc()) {
                        $coAuthors[] = $coAuthorRow['authors_fullname'];
                    }

                    $article['co_authors'] = $coAuthors;
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
