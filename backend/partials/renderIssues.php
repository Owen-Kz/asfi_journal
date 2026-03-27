<?php
/**
 * Render Issues Component with Advanced Filtering and Modern Two-Column Layout
 */

// Enable output buffering for better performance
ob_start();

// Set caching headers for better performance
header("Cache-Control: public, max-age=3600"); 
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 3600) . " GMT");

// Function to get cover image URL
function getCoverImage($row) {
    static $defaultImage = "https://res.cloudinary.com/dvm0bs013/image/upload/v1738234900/asfischolar_asbtdc.jpg";
    
    $photo = $row['manuscriptPhoto'] ?? null;
    $isOld = $row['is_old_publication'] ?? 'no';
    
    if (empty($photo)) return $defaultImage;
    
    return $isOld === "yes" 
        ? "https://asfirj.org/useruploads/article_images/" . $photo
        : "https://process.asfirj.org/useruploads/article_images/" . $photo;
}

// Function to format timestamp
function formatTimestamp($date) {
    if (empty($date)) return "";
    return date("j M Y", strtotime($date));
}

// Function to get authors HTML
function getAuthorsHTML($articleId, $con) {
    $authorsHTML = "";
    $stmt = $con->prepare("SELECT authors_fullname FROM authors WHERE article_id = ? ORDER BY id ASC");
    $stmt->bind_param("s", $articleId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $authors = [];
    while ($row = $result->fetch_assoc()) {
        $authors[] = $row['authors_fullname'];
    }
    
    if (!empty($authors)) {
        $authorsHTML = implode(", ", $authors);
    } else {
        $authorsHTML = "Research Team";
    }
    
    return $authorsHTML;
}

// Function to render a single article with two-column layout
function renderArticle($row, $authorsName) {
    $coverImage = getCoverImage($row);
    $formattedDate = formatTimestamp(!empty($row['date_published']) ? $row['date_published'] : $row['date_uploaded']);
    
    // Badges
    $editorsChoiceBadge = ($row['is_editors_choice'] === "yes") 
        ? '<span class="ml-2 inline-flex items-center px-2 py-1 font-medium rounded"><svg style="width:20px;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19.965 8.521C19.988 8.347 20 8.173 20 8c0-2.379-2.143-4.288-4.521-3.965C14.786 2.802 13.466 2 12 2s-2.786.802-3.479 2.035C6.138 3.712 4 5.621 4 8c0 .173.012.347.035.521C2.802 9.215 2 10.535 2 12s.802 2.785 2.035 3.479A3.976 3.976 0 0 0 4 16c0 2.379 2.138 4.283 4.521 3.965C9.214 21.198 10.534 22 12 22s2.786-.802 3.479-2.035C17.857 20.283 20 18.379 20 16c0-.173-.012-.347-.035-.521C21.198 14.785 22 13.465 22 12s-.802-2.785-2.035-3.479zm-9.01 7.895-3.667-3.714 1.424-1.404 2.257 2.286 4.327-4.294 1.408 1.42-5.749 5.706z" fill="#4d91f7"/></svg> Editor\'s Choice</span>'
        : "";
    
    $openAccessBadge = ($row['is_open_access'] === "yes")
        ? '<span class="ml-2 inline-flex items-center px-2 py-1 font-medium rounded"><img src="./images/20181007070735!Open_Access_logo_PLoS_white.svg" style="width:10px;" alt=""> Open Access</span>'
        : "";
    
    // Escape output
    $articleType = htmlspecialchars($row['article_type']);
    $buffer = htmlspecialchars($row['buffer']);
    $title = htmlspecialchars($row['manuscript_full_title']);
    $manuscriptFile = htmlspecialchars($row['manuscript_file']);
    $viewsCount = (int)$row['views_count'];
    $downloadsCount = (int)$row['downloads_count'];
    
    return '
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow mb-6">
        <div class="flex flex-col md:flex-row">
            <!-- Left Column: Image -->
            <div class="w-full md:w-64 h-48 md:h-auto bg-cover bg-center relative" style="background-image: url(\'' . $coverImage . '\'); background-color: #f3f4f6;">
                <div class="w-full h-full bg-gradient-to-r from-purple-900/70 to-transparent flex items-end p-4">
                    <span class="text-white text-sm font-medium bg-purple-600 px-2 py-1 rounded">' . $articleType . '</span>
                </div>
            </div>
            
            <!-- Right Column: Content -->
            <div class="flex-1 p-6">
                <div class="flex items-start justify-between mb-2">
                    <div class="flex-1">
                        <a href="./content?sid=' . $buffer . '" class="hover:text-purple-700 transition-colors">
                            <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">' . $title . '</h3>
                        </a>
                        <p class="text-gray-600">by ' . htmlspecialchars($authorsName) . '</p>
                    </div>
                    <div class="flex flex-col items-end gap-1">
                        ' . $openAccessBadge . '
                        ' . $editorsChoiceBadge . '
                    </div>
                </div>

               
                
                <!-- Stats Row -->
                <div class="flex flex-wrap items-center gap-4 text-gray-500 mb-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 mr-1"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect><line x1="16" x2="16" y1="2" y2="6"></line><line x1="8" x2="8" y1="2" y2="6"></line><line x1="3" x2="21" y1="10" y2="10"></line></svg>
                        ' . $formattedDate . '
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 mr-1"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        ' . $viewsCount . ' Views
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 mr-1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>
                        ' . $downloadsCount . ' Downloads
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-2">
                    <a href="./content?sid=' . $buffer . '" class="px-3 py-1.5 bg-gray-100 text-[#80078b] font-medium rounded-lg transition-colors flex items-center gap-1 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        View
                    </a>
                    <a href="https://asfirj.org/useruploads/manuscripts/' . $manuscriptFile . '" target="_blank" class="px-3 py-1.5 bg-gray-100 text-[#80078b] font-medium rounded-lg transition-colors flex items-center gap-1 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>
                        PDF
                    </a>
                    <button data-id="' . $buffer . '" data-title="' . $title . '" class="shareButton px-3 py-1.5 bg-gray-100 text-[#80078b] font-medium rounded-lg transition-colors flex items-center gap-1 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"></line><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"></line></svg>
                        Share
                    </button>
                </div>
            </div>
        </div>
    </div>';
}

function renderIssues($con, $page = 1, $filters = []) {
    $items_per_page = 6;
    $offset = ($page - 1) * $items_per_page;
    $totalPages = 0;
    
    // Build WHERE clause based on filters
    $whereClauses = ["`journals`.`is_publication` = 'yes'"];
    $params = [];
    $types = "";
    
    // Search by title
    if (!empty($filters['search'])) {
        $whereClauses[] = "(LOWER(`journals`.`manuscript_full_title`) LIKE CONCAT('%', LOWER(?), '%') 
                           OR LOWER(`journals`.`manuscript_running_title`) LIKE CONCAT('%', LOWER(?), '%'))";
        $params[] = $filters['search'];
        $params[] = $filters['search'];
        $types .= "ss";
    }
    
    // Filter by article type
    if (!empty($filters['type'])) {
        $whereClauses[] = "`journals`.`article_type` = ?";
        $params[] = $filters['type'];
        $types .= "s";
    }
    
    // Filter by author (requires join with authors table)
    $hasAuthorFilter = !empty($filters['author']);
    $authorJoin = "";
    
    if ($hasAuthorFilter) {
        $authorJoin = " INNER JOIN `authors` ON `journals`.`buffer` = `authors`.`article_id`";
        $whereClauses[] = "`authors`.`authors_fullname` = ?";
        $params[] = $filters['author'];
        $types .= "s";
    }
    
    $whereSQL = implode(" AND ", $whereClauses);
    
    try {
        // Count total matching journals
        $countSQL = "SELECT COUNT(DISTINCT `journals`.`id`) AS `totalJournals` 
                     FROM `journals` 
                     $authorJoin 
                     WHERE $whereSQL";
        
        $stmtCount = $con->prepare($countSQL);
        
        if (!empty($params)) {
            $stmtCount->bind_param($types, ...$params);
        }
        
        $stmtCount->execute();
        $resultC = $stmtCount->get_result();
        $rowC = mysqli_fetch_assoc($resultC);
        $journalCount = $rowC["totalJournals"];
        $totalPages = ceil($journalCount / $items_per_page);
        
        // Get paginated results
        $mainSQL = "SELECT DISTINCT `journals`.* 
                    FROM `journals` 
                    $authorJoin 
                    WHERE $whereSQL 
                    ORDER BY `journals`.`id` DESC 
                    LIMIT ? OFFSET ?";
        
        $stmt = $con->prepare($mainSQL);
        
        // Add pagination parameters
        $params[] = $items_per_page;
        $params[] = $offset;
        $types .= "ii";
        
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (mysqli_num_rows($result) > 0) {
            // Collect all articles for batch processing
            $articles = [];
            $articleIds = [];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $articles[] = $row;
                $articleIds[] = $row['buffer'];
            }
            
            // Batch fetch authors
            $authorsMap = getAuthorsBatch($con, $articleIds);
            
            // Render each article
            foreach ($articles as $row) {
                $articleId = $row['buffer'];
                $authorsName = isset($authorsMap[$articleId]) 
                    ? implode(", ", $authorsMap[$articleId]) 
                    : "Research Team";
                
                echo renderArticle($row, $authorsName);
            }
            
            // Pagination
            if ($totalPages > 1) {
                echo '<div class="flex justify-center gap-2 mt-8">';
                
                // Previous button
                if ($page > 1) {
                    $prevUrl = buildPaginationUrl($filters, $page - 1);
                    echo '<a href="' . $prevUrl . '" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">&laquo; Prev</a>';
                }
                
                // Page numbers
                $startPage = max(1, $page - 2);
                $endPage = min($totalPages, $page + 2);
                
                if ($startPage > 1) {
                    $firstUrl = buildPaginationUrl($filters, 1);
                    echo '<a href="' . $firstUrl . '" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">1</a>';
                    if ($startPage > 2) echo '<span class="px-4 py-2 text-gray-500">...</span>';
                }
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $activeClass = ($i == $page) ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300';
                    $pageUrl = buildPaginationUrl($filters, $i);
                    echo '<a href="' . $pageUrl . '" class="px-4 py-2 rounded-lg ' . $activeClass . ' transition-colors">' . $i . '</a>';
                }
                
                if ($endPage < $totalPages) {
                    if ($endPage < $totalPages - 1) echo '<span class="px-4 py-2 text-gray-500">...</span>';
                    $lastUrl = buildPaginationUrl($filters, $totalPages);
                    echo '<a href="' . $lastUrl . '" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">' . $totalPages . '</a>';
                }
                
                // Next button
                if ($page < $totalPages) {
                    $nextUrl = buildPaginationUrl($filters, $page + 1);
                    echo '<a href="' . $nextUrl . '" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Next &raquo;</a>';
                }
                
                echo '</div>';
            }
            
        } else {
            echo '<div class="text-center py-12 bg-gray-50 rounded-xl">
                    <h3 class="font-semibold text-gray-700 mb-2">No articles found</h3>
                    <p class="text-gray-500">Try adjusting your search filters or browse all issues.</p>
                  </div>';
        }
        
    } catch (Exception $e) {
        error_log("Error in renderIssues: " . $e->getMessage());
        echo '<div class="text-center py-12 bg-red-50 rounded-xl">
                <h3 class="font-semibold text-red-700 mb-2">Error loading articles</h3>
                <p class="text-red-500">Please try again later.</p>
              </div>';
    }
}

// Helper function to build pagination URL
function buildPaginationUrl($filters, $page) {
    $params = [];
    
    if (!empty($filters['search'])) $params['k'] = urlencode($filters['search']);
    if (!empty($filters['author'])) $params['author'] = urlencode($filters['author']);
    if (!empty($filters['type'])) $params['type'] = urlencode($filters['type']);
    $params['page'] = $page;
    
    return '?' . http_build_query($params);
}

// Helper function to batch fetch authors
function getAuthorsBatch($con, $articleIds) {
    $authorsMap = [];
    
    if (empty($articleIds)) return $authorsMap;
    
    $placeholders = implode(',', array_fill(0, count($articleIds), '?'));
    $types = str_repeat('s', count($articleIds));
    
    $stmt = $con->prepare("SELECT article_id, authors_fullname FROM authors WHERE article_id IN ($placeholders) ORDER BY id ASC");
    $stmt->bind_param($types, ...$articleIds);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $articleId = $row['article_id'];
        if (!isset($authorsMap[$articleId])) {
            $authorsMap[$articleId] = [];
        }
        $authorsMap[$articleId][] = $row['authors_fullname'];
    }
    
    return $authorsMap;
}

// If called directly, render issues with GET parameters
if (basename($_SERVER['PHP_SELF']) == 'renderIssues.php') {
    // Collect filters from GET parameters
    $filters = [
        'search' => isset($_GET['k']) ? trim($_GET['k']) : null,
        'author' => isset($_GET['author']) ? trim($_GET['author']) : null,
        'type' => isset($_GET['type']) ? trim($_GET['type']) : null
    ];
    
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    
    renderIssues($con, $page, $filters);
}

// End output buffering
ob_end_flush();
?>