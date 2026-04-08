<?php
/**
 * Render Supplements Component
 * For articles with is_publication = 'no' (supplements, conference proceedings, etc.)
 * Modern card layout matching home page style
 */

// Enable output buffering for better performance
ob_start();

// Set caching headers for better performance
header("Cache-Control: public, max-age=3600");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 3600) . " GMT");
include_once("./helpers.php");

// Function to get cover image URL
function getCoverImageSupplements($row) {
    static $defaultImage = "https://res.cloudinary.com/dvm0bs013/image/upload/v1738234900/asfischolar_asbtdc.jpg";
    
    $photo = $row['manuscriptPhoto'] ?? null;
    $isOld = $row['is_old_publication'] ?? 'no';
    
    if (empty($photo)) return $defaultImage;
    
    return $isOld === "yes" 
        ? "https://asfirj.org/useruploads/article_images/" . $photo
        : "https://process.asfirj.org/useruploads/article_images/" . $photo;
}

// Function to format timestamp
function formatTimestampSupplements($date) {
    if (empty($date)) return "";
    return date("j M Y", strtotime($date));
}

// Function to render a single supplement article with modern card layout
function renderSupplementArticle($row, $authorsName) {
    $coverImage = getCoverImageSupplements($row);
    $formattedDate = formatTimestampSupplements(!empty($row['date_published']) ? $row['date_published'] : $row['date_uploaded']);
    
    // Badges
    $editorsChoiceBadge = ($row['is_editors_choice'] === "yes") 
        ? '<span class="inline-flex items-center gap-1 text-xs text-blue-700 bg-blue-50 px-2 py-0.5 rounded-full"><svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M19.965 8.521C19.988 8.347 20 8.173 20 8c0-2.379-2.143-4.288-4.521-3.965C14.786 2.802 13.466 2 12 2s-2.786.802-3.479 2.035C6.138 3.712 4 5.621 4 8c0 .173.012.347.035.521C2.802 9.215 2 10.535 2 12s.802 2.785 2.035 3.479A3.976 3.976 0 0 0 4 16c0 2.379 2.138 4.283 4.521 3.965C9.214 21.198 10.534 22 12 22s2.786-.802 3.479-2.035C17.857 20.283 20 18.379 20 16c0-.173-.012-.347-.035-.521C21.198 14.785 22 13.465 22 12s-.802-2.785-2.035-3.479z" fill="#4d91f7"/></svg> Editor\'s Choice</span>'
        : "";
    
    $openAccessBadge = ($row['is_open_access'] === "yes")
        ? '<span class="inline-flex items-center gap-1 text-xs text-green-700 bg-green-50 px-2 py-0.5 rounded-full"><svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg> Open Access</span>'
        : "";
    
    // Supplement badge
    $supplementBadge = '<span class="inline-flex items-center gap-1 text-xs text-orange-700 bg-orange-50 px-2 py-0.5 rounded-full"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg> Supplement</span>';
    
    // Escape output
    $articleType = htmlspecialchars($row['article_type']);
    $buffer = htmlspecialchars($row['buffer']);
    $title = htmlspecialchars($row['manuscript_full_title']);
    $manuscriptFile = htmlspecialchars($row['manuscript_file']);
    $viewsCount = (int)$row['views_count'];
    $downloadsCount = (int)$row['downloads_count'];
    $manuscriptFileURL = getManuscriptURL($row);
    
    return '
    <div class="w-full bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 mb-6">
        <!-- Cover Image -->
        <div class="relative h-56 md:h-72 w-full overflow-hidden bg-gray-100">
            <img src="' . $coverImage . '" alt="' . $title . '" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
            <div class="absolute top-3 left-3 flex gap-1">
                <span class="text-xs font-semibold text-orange-700 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full">' . $articleType . '</span>
                ' . $supplementBadge . '
            </div>
            <div class="absolute top-3 right-3 flex gap-1">
                ' . $openAccessBadge . '
                ' . $editorsChoiceBadge . '
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-4 md:p-5">
            <!-- Title -->
            <a href="/content?sid=' . $buffer . '" class="hover:text-orange-600 transition-colors">
                <h3 class="text-lg md:text-xl font-semibold text-gray-900 mb-2 line-clamp-2">' . $title . '</h3>
            </a>
            
            <!-- Authors -->
            <div class="mb-3">
                <p class="text-sm text-gray-600">' . htmlspecialchars($authorsName) . '</p>
            </div>
            
            <!-- Stats -->
            <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500 mb-4 pb-3 border-b border-gray-100">
                <div class="flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>' . $formattedDate . '</span>
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <span>' . number_format($viewsCount) . '</span> Views
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    <span>' . number_format($downloadsCount) . '</span> Downloads
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="/content?sid=' . $buffer . '#abstract" class="px-3 py-1.5 bg-gray-100 hover:bg-orange-100 text-orange-600 rounded-lg transition-colors flex items-center gap-1 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Abstract
                </a>
                <a href="/content?sid=' . $buffer . '#fulltext" class="px-3 py-1.5 bg-gray-100 hover:bg-orange-100 text-orange-600 rounded-lg transition-colors flex items-center gap-1 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Full Text
                </a>
                <a href="' . $manuscriptFileURL . '" target="_blank" class="px-3 py-1.5 bg-gray-100 hover:bg-orange-100 text-orange-600 rounded-lg transition-colors flex items-center gap-1 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    PDF
                </a>
                <a href="#" class="px-3 py-1.5 bg-gray-100 hover:bg-orange-100 text-orange-600 rounded-lg transition-colors flex items-center gap-1 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    References
                </a>
                <button class="shareButton px-3 py-1.5 bg-gray-100 hover:bg-orange-100 text-orange-600 rounded-lg transition-colors flex items-center gap-1 text-sm font-medium cursor-pointer" 
                        data-id="' . htmlspecialchars($buffer, ENT_QUOTES) . '" 
                        data-title="' . htmlspecialchars($title, ENT_QUOTES) . '">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684z"></path></svg>
                    Share
                </button>
            </div>
        </div>
    </div>';
}

function renderSupplements($con, $page = 1, $filters = []) {
    $items_per_page = 6;
    $offset = ($page - 1) * $items_per_page;
    $totalPages = 0;
    
    // Build WHERE clause based on filters (is_publication = 'no' for supplements)
    $whereClauses = ["`journals`.`is_publication` = 'no'"];
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
        // Count total matching supplements
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
            $authorsMap = getAuthorsBatchSupplements($con, $articleIds);
            
            // Render each article
            foreach ($articles as $row) {
                $articleId = $row['buffer'];
                $authorsName = isset($authorsMap[$articleId]) 
                    ? implode(", ", $authorsMap[$articleId]) 
                    : "Research Team";
                
                echo renderSupplementArticle($row, $authorsName);
            }
            
            // Pagination
            if ($totalPages > 1) {
                echo '<div class="flex justify-center gap-2 mt-8 flex-wrap">';
                
                // Previous button
                if ($page > 1) {
                    $prevUrl = buildPaginationUrlSupplements($filters, $page - 1);
                    echo '<a href="' . $prevUrl . '" class="px-4 py-2 rounded-lg text-sm bg-gray-200 text-gray-700 hover:bg-orange-100 transition-colors">&laquo; Prev</a>';
                }
                
                // Page numbers
                $startPage = max(1, $page - 2);
                $endPage = min($totalPages, $page + 2);
                
                if ($startPage > 1) {
                    $firstUrl = buildPaginationUrlSupplements($filters, 1);
                    echo '<a href="' . $firstUrl . '" class="px-4 py-2 rounded-lg text-sm bg-gray-200 text-gray-700 hover:bg-orange-100 transition-colors">1</a>';
                    if ($startPage > 2) echo '<span class="px-3 py-2 text-gray-500">...</span>';
                }
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $activeClass = ($i == $page) ? 'bg-orange-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-orange-100';
                    $pageUrl = buildPaginationUrlSupplements($filters, $i);
                    echo '<a href="' . $pageUrl . '" class="px-4 py-2 rounded-lg text-sm ' . $activeClass . ' transition-colors">' . $i . '</a>';
                }
                
                if ($endPage < $totalPages) {
                    if ($endPage < $totalPages - 1) echo '<span class="px-3 py-2 text-gray-500">...</span>';
                    $lastUrl = buildPaginationUrlSupplements($filters, $totalPages);
                    echo '<a href="' . $lastUrl . '" class="px-4 py-2 rounded-lg text-sm bg-gray-200 text-gray-700 hover:bg-orange-100 transition-colors">' . $totalPages . '</a>';
                }
                
                // Next button
                if ($page < $totalPages) {
                    $nextUrl = buildPaginationUrlSupplements($filters, $page + 1);
                    echo '<a href="' . $nextUrl . '" class="px-4 py-2 rounded-lg text-sm bg-gray-200 text-gray-700 hover:bg-orange-100 transition-colors">Next &raquo;</a>';
                }
                
                echo '</div>';
            }
            
        } else {
            echo '<div class="text-center py-12 bg-gray-50 rounded-xl">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">No supplements found</h3>
                    <p class="text-sm text-gray-500">Check back soon for conference proceedings and special issues.</p>
                  </div>';
        }
        
    } catch (Exception $e) {
        error_log("Error in renderSupplements: " . $e->getMessage());
        echo '<div class="text-center py-12 bg-red-50 rounded-xl">
                <h3 class="text-lg font-semibold text-red-700 mb-2">Error loading supplements</h3>
                <p class="text-sm text-red-500">Please try again later.</p>
              </div>';
    }
}

// Helper function to build pagination URL
function buildPaginationUrlSupplements($filters, $page) {
    $params = [];
    
    if (!empty($filters['search'])) $params['k'] = urlencode($filters['search']);
    if (!empty($filters['author'])) $params['author'] = urlencode($filters['author']);
    if (!empty($filters['type'])) $params['type'] = urlencode($filters['type']);
    $params['page'] = $page;
    
    return '?' . http_build_query($params);
}

// Helper function to batch fetch authors
function getAuthorsBatchSupplements($con, $articleIds) {
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

// If called directly, render supplements with GET parameters
if (basename($_SERVER['PHP_SELF']) == 'renderSupplements.php') {
    // Collect filters from GET parameters
    $filters = [
        'search' => isset($_GET['k']) ? trim($_GET['k']) : null,
        'author' => isset($_GET['author']) ? trim($_GET['author']) : null,
        'type' => isset($_GET['type']) ? trim($_GET['type']) : null
    ];
    
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    
    renderSupplements($con, $page, $filters);
}

// End output buffering
ob_end_flush();
?>