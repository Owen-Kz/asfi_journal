<?php
/**
 * Batch author fetching helper for better performance
 */

function getAuthorsBatch($con, $articleIds) {
    if (empty($articleIds)) return [];
    
    $placeholders = implode(',', array_fill(0, count($articleIds), '?'));
    $stmt = $con->prepare("SELECT article_id, authors_fullname FROM authors WHERE article_id IN ($placeholders) ORDER BY id ASC");
    
    $types = str_repeat('s', count($articleIds));
    $stmt->bind_param($types, ...$articleIds);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $authorsMap = [];
    while ($row = $result->fetch_assoc()) {
        if (!isset($authorsMap[$row['article_id']])) {
            $authorsMap[$row['article_id']] = [];
        }
        $authorsMap[$row['article_id']][] = $row['authors_fullname'];
    }
    
    return $authorsMap;
}

function formatAuthorsHTML($authorsArray) {
    if (empty($authorsArray)) return "Research Team";
    return implode(", ", $authorsArray);
}
?>