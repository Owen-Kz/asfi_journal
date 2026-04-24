<?php
header('Content-Type: application/json');
include "db.php";

function cleanAuthorName($name) {
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

function getFilterOptions($con, $tab) {
    $isPublication = ($tab === 'issues') ? 'yes' : 'no';
    
    // Get authors
    $authorsQuery = "SELECT DISTINCT a.authors_fullname 
                     FROM authors a
                     INNER JOIN journals j ON a.article_id = j.buffer
                     WHERE j.is_publication = '$isPublication'
                     AND a.authors_fullname IS NOT NULL 
                     AND a.authors_fullname != ''";
    
    $authorsResult = mysqli_query($con, $authorsQuery);
    $authorMap = [];
    
    while ($row = mysqli_fetch_assoc($authorsResult)) {
        $cleanedName = cleanAuthorName($row['authors_fullname']);
        if (!empty($cleanedName)) {
            $lowercaseKey = strtolower(preg_replace('/\s+/', ' ', trim($cleanedName)));
            $authorMap[$lowercaseKey] = $cleanedName;
        }
    }
    
    $authors = array_values($authorMap);
    usort($authors, 'strnatcasecmp');
    
    // Get article types
    $typesQuery = "SELECT DISTINCT article_type 
                   FROM journals 
                   WHERE article_type IS NOT NULL 
                   AND article_type != '' 
                   AND is_publication = '$isPublication'
                   ORDER BY article_type ASC";
    $typesResult = mysqli_query($con, $typesQuery);
    $types = [];
    while ($row = mysqli_fetch_assoc($typesResult)) {
        $types[] = $row['article_type'];
    }
    
    // Get years
    $yearsQuery = "SELECT DISTINCT YEAR(date_published) as year 
                   FROM journals 
                   WHERE date_published IS NOT NULL 
                   AND is_publication = '$isPublication'
                   ORDER BY year DESC";
    $yearsResult = mysqli_query($con, $yearsQuery);
    $years = [];
    while ($row = mysqli_fetch_assoc($yearsResult)) {
        $years[] = $row['year'];
    }
    
    return [
        'success' => true,
        'authors' => $authors,
        'types' => $types,
        'years' => $years
    ];
}

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'supplements';
$options = getFilterOptions($con, $tab);
echo json_encode($options);
?>