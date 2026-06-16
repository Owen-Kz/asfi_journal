<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include "../db.php";

function cleanAuthorName($name) {
    if ($name === null || $name === '') return '';
    $cleaned = trim($name);
    $cleaned = preg_replace('/[\s\-\.\,]*[\d\-\_]+$/', '', $cleaned);
    $cleaned = preg_replace('/[^a-zA-Z\s\-\'\.\,]/', '', $cleaned);
    $cleaned = trim($cleaned, '- ');
    $cleaned = preg_replace('/[\s\-]+/', ' ', $cleaned);
    $cleaned = preg_replace('/\s*-\s*/', '-', $cleaned);
    $cleaned = mb_convert_case($cleaned, MB_CASE_TITLE, 'UTF-8');
    $cleaned = preg_replace_callback('/\b\w+-\w+\b/', function($matches) {
        return $matches[0];
    }, $cleaned);

    return $cleaned;
}

$author = $_GET["author"] ?? null;

if (!$author) {
    echo json_encode(['status' => 'error', 'message' => 'No author provided', 'articlesList' => []]);
    exit;
}

try {
    $cleanedQuery = cleanAuthorName($author);
    $lowerQuery = strtolower(preg_replace('/\s+/', ' ', trim($cleanedQuery)));

    $nameParts = explode(' ', $lowerQuery);
    $nameParts = array_filter($nameParts);
    $nameParts = array_values($nameParts);

    if (empty($lowerQuery) || empty($nameParts)) {
        echo json_encode(['status' => 'error', 'message' => "Invalid author name: $author", 'articlesList' => []]);
        exit;
    }

    $conditions = [];
    $params = [];
    foreach ($nameParts as $part) {
        $conditions[] = '`authors_fullname` LIKE ?';
        $params[] = '%' . $part . '%';
    }

    $sql = "SELECT article_id, authors_fullname FROM `authors` WHERE " . implode(' AND ', $conditions);
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        echo json_encode(['status' => 'internalError', 'message' => "Error: " . $con->error, 'articlesList' => []]);
        exit;
    }

    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    $authorMap = [];
    while ($row = $result->fetch_assoc()) {
        $cleanedName = cleanAuthorName($row['authors_fullname']);
        $lowerKey = strtolower(preg_replace('/\s+/', ' ', trim($cleanedName)));
        if ($lowerKey === $lowerQuery) {
            $authorMap[$row['article_id']] = true;
        }
    }

    if (empty($authorMap)) {
        echo json_encode(['status' => 'error', 'message' => "Author '$author' not found", 'articlesList' => []]);
        exit;
    }

    $articleIDs = array_keys($authorMap);
    $placeholders = implode(',', array_fill(0, count($articleIDs), '?'));

    $stmtArticles = $con->prepare("SELECT * FROM `journals` WHERE `buffer` IN ($placeholders)");
    if (!$stmtArticles) {
        echo json_encode(['status' => 'internalError', 'message' => "Error: " . $con->error, 'articlesList' => []]);
        exit;
    }

    $stmtArticles->bind_param(str_repeat('s', count($articleIDs)), ...$articleIDs);
    $stmtArticles->execute();
    $articlesResult = $stmtArticles->get_result();

    $articlesList = [];
    while ($article = $articlesResult->fetch_assoc()) {
        $articleID = $article['buffer'];

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

    if (!empty($articlesList)) {
        echo json_encode(['status' => 'success', 'articlesList' => $articlesList]);
    } else {
        echo json_encode(['status' => 'error', 'message' => "No articles found for author: $author", 'articlesList' => []]);
    }

} catch (Exception $e) {
    echo json_encode(['status' => 'internalError', 'message' => "Error: " . $e->getMessage(), 'articlesList' => []]);
}
?>
