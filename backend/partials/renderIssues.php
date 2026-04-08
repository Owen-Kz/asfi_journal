<?php
/**
 * Render Issues Component with Advanced Filtering and Modern Card Layout
 */

// Enable output buffering for better performance
ob_start();

// Set caching headers for better performance
header("Cache-Control: public, max-age=3600"); 
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 3600) . " GMT");
include "./helpers.php";

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

// function getClientIp() {
//     if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
//     if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
//     return $_SERVER['REMOTE_ADDR'];
// }

// function updateDownloadsCount($row) {
//     global $con;

//     $articleId = $row["id"];
//     $clientIp = getClientIp(); // Get client IP

//     try {
//         // Check if user already downloaded
//         $stmtCheck = $con->prepare("
//             SELECT id FROM view_download_count 
//             WHERE user_ip = ? AND article_id = ? AND type = 'downloaded'
//         ");

//         if (!$stmtCheck) {
//             throw new Exception("Prepare failed (check): " . $con->error);
//         }

//         $stmtCheck->bind_param("si", $clientIp, $articleId);
//         $stmtCheck->execute();
//         $result = $stmtCheck->get_result();

//         if ($result->num_rows === 0) {
//             // Not downloaded before → update count
//             $stmtUpdate = $con->prepare("
//                 UPDATE journals 
//                 SET downloads_count = downloads_count + 1 
//                 WHERE id = ?
//             ");

//             if (!$stmtUpdate) {
//                 throw new Exception("Prepare failed (update): " . $con->error);
//             }

//             $stmtUpdate->bind_param("i", $articleId);
//             $stmtUpdate->execute();
//             $stmtUpdate->close();

//             // Insert tracking record
//             $stmtInsert = $con->prepare("
//                 INSERT INTO view_download_count (user_ip, article_id, type)
//                 VALUES (?, ?, 'downloaded')
//             ");

//             if (!$stmtInsert) {
//                 throw new Exception("Prepare failed (insert): " . $con->error);
//             }

//             $stmtInsert->bind_param("si", $clientIp, $articleId);
//             $stmtInsert->execute();
//             $stmtInsert->close();

//             $stmtCheck->close();
//             return "Download updated";

//         } else {
//             $stmtCheck->close();
//             return "Already downloaded";
//         }

//     } catch (Exception $e) {
//         error_log($e->getMessage());
//         return false;
//     }
// }
// function getManuscriptURL($row) {
//     static $defaultImage = "https://res.cloudinary.com/dvm0bs013/image/upload/v1738234900/asfischolar_asbtdc.jpg";
    
//     $manuscript = $row['manuscript_file'] ?? null;
//     $isOld = $row['is_old_publication'] ?? 'no';
    
//     if (empty($manuscript)) return $defaultImage;
//     return $isOld === "yes" 
//         ? "https://asfirj.org/useruploads/manuscripts/" . $manuscript
//         : "https://process.asfirj.org/useruploads/manuscripts/" . $manuscript;
// }

// Function to format timestamp
function formatTimestamp($date) {
    if (empty($date)) return "";
    return date("j M Y", strtotime($date));
}

// Function to render a single article
function renderArticle($row, $authorsName) {
    $coverImage = getCoverImage($row);
    $formattedDate = formatTimestamp(!empty($row['date_published']) ? $row['date_published'] : $row['date_uploaded']);
    $manuscriptFileURL = getManuscriptURL($row);
    // Original badge icons - keep exactly as they were
    $editorsChoiceBadge = ($row['is_editors_choice'] === "yes") 
        ? '<span class="editchoice inline-flex items-center gap-1 text-[11px] md:text-sm text-blue-700 bg-blue-50 px-1.5 md:px-2 py-0.5 rounded-full whitespace-nowrap"><svg width="14" height="14" class="md:w-4 md:h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19.965 8.521C19.988 8.347 20 8.173 20 8c0-2.379-2.143-4.288-4.521-3.965C14.786 2.802 13.466 2 12 2s-2.786.802-3.479 2.035C6.138 3.712 4 5.621 4 8c0 .173.012.347.035.521C2.802 9.215 2 10.535 2 12s.802 2.785 2.035 3.479A3.976 3.976 0 0 0 4 16c0 2.379 2.138 4.283 4.521 3.965C9.214 21.198 10.534 22 12 22s2.786-.802 3.479-2.035C17.857 20.283 20 18.379 20 16c0-.173-.012-.347-.035-.521C21.198 14.785 22 13.465 22 12s-.802-2.785-2.035-3.479z" fill="#4d91f7"/></svg> Editor\'s Choice</span>'
        : "";
    
    $openAccessBadge = ($row['is_open_access'] === "yes")
        ? '<span class="openaccess inline-flex items-center gap-1 text-[11px] md:text-sm text-green-700 bg-green-50 px-1.5 md:px-2 py-0.5 rounded-full whitespace-nowrap"><img src="../images/20181007070735!Open_Access_logo_PLoS_white.svg" style="width:14px;" alt=""> Open Access</span>'
        : "";
    
    // Escape output
    $articleType = htmlspecialchars($row['article_type']);
    $buffer = htmlspecialchars($row['buffer']);
    $title = htmlspecialchars($row['manuscript_full_title']);
    $manuscriptFile = htmlspecialchars($row['manuscript_file']);
    $viewsCount = (int)$row['views_count'];
    $downloadsCount = (int)$row['downloads_count'];
    
    return '
    <div class="w-full bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 mb-6">
        <!-- Cover Image -->
        <div class="relative h-56 md:h-72 w-full overflow-hidden bg-gray-100">
            <img src="' . $coverImage . '" alt="' . $title . '" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
            <div class="absolute top-3 left-3">
                <span class="text-[10px] md:text-sm font-semibold text-purple-700 bg-white/90 backdrop-blur-sm px-2 py-0.5 md:py-1 rounded-full shadow-sm">' . $articleType . '</span>
            </div>
            <div class="absolute top-3 right-3 flex gap-1">
                ' . $openAccessBadge . '
                ' . $editorsChoiceBadge . '
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-4 md:p-6">
            <!-- Title -->
            <a href="/content?sid=' . $buffer . '" class="hover:text-purple-700 transition-colors" onClick='.updateDownloadsCount($row).'>
                <h3 class="text-base md:text-2xl font-semibold text-gray-900 mb-2 md:mb-3 line-clamp-2 leading-tight">' . $title . '</h3>
            </a>
            
            <!-- Authors -->
            <div class="mb-3 md:mb-4">
                <p class="text-xs md:text-base text-gray-600 line-clamp-2">' . htmlspecialchars($authorsName) . '</p>
            </div>
            
            <!-- Stats -->
            <div class="flex flex-wrap items-center gap-2 md:gap-4 text-[10px] md:text-sm text-gray-500 mb-4 md:mb-5 pb-3 border-b border-gray-100">
                <div class="flex items-center gap-1">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>' . $formattedDate . '</span>
                </div>
                <div class="flex items-center gap-1" title="Views">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <span>' . number_format($viewsCount) . '</span> Views
                </div>
                <div class="flex items-center gap-1" title="Downloads">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    <span>' . number_format($downloadsCount) . '</span> Downloads
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="/content?sid=' . $buffer . '#abstract" class="px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-purple-100 text-purple-700 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Abstract
                </a>
                <a href="/content?sid=' . $buffer . '#fulltext" class="px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-purple-100 text-purple-700 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Full Text
                </a>
                <a href="'.$manuscriptFileURL.'" target="_blank" class="downloadLink px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-purple-100 text-purple-700 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    PDF
                </a>
                <a href="#" class="px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-purple-100 text-purple-700 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    References
                </a>
                <button class="shareButton px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-purple-100 text-purple-700 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium cursor-pointer" 
                        data-id="' . htmlspecialchars($buffer, ENT_QUOTES) . '" 
                        data-title="' . htmlspecialchars($title, ENT_QUOTES) . '">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684z"></path></svg>
                    Share
                </button>
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
    
    // Filter by author
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
        
        $mainSQL = "SELECT DISTINCT `journals`.* 
                    FROM `journals` 
                    $authorJoin 
                    WHERE $whereSQL 
                    ORDER BY `journals`.`id` DESC 
                    LIMIT ? OFFSET ?";
        
        $stmt = $con->prepare($mainSQL);
        
        $params[] = $items_per_page;
        $params[] = $offset;
        $types .= "ii";
        
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (mysqli_num_rows($result) > 0) {
            $articles = [];
            $articleIds = [];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $articles[] = $row;
                $articleIds[] = $row['buffer'];
            }
            
            $authorsMap = getAuthorsBatch($con, $articleIds);
            
            foreach ($articles as $row) {
                $articleId = $row['buffer'];
                $authorsName = isset($authorsMap[$articleId]) 
                    ? implode(", ", $authorsMap[$articleId]) 
                    : "Research Team";
                
                echo renderArticle($row, $authorsName);
            }
            
            // Pagination
            if ($totalPages > 1) {
                echo '<div class="flex justify-center gap-2 mt-8 flex-wrap">';
                
                if ($page > 1) {
                    $prevUrl = buildPaginationUrl($filters, $page - 1);
                    echo '<a href="' . $prevUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm bg-gray-200 text-gray-700 hover:bg-purple-100 transition-colors">&laquo; Prev</a>';
                }
                
                $startPage = max(1, $page - 2);
                $endPage = min($totalPages, $page + 2);
                
                if ($startPage > 1) {
                    $firstUrl = buildPaginationUrl($filters, 1);
                    echo '<a href="' . $firstUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm bg-gray-200 text-gray-700 hover:bg-purple-100 transition-colors">1</a>';
                    if ($startPage > 2) echo '<span class="px-2 md:px-3 py-1.5 text-gray-500">...</span>';
                }
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $activeClass = ($i == $page) ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-purple-100';
                    $pageUrl = buildPaginationUrl($filters, $i);
                    echo '<a href="' . $pageUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm ' . $activeClass . ' transition-colors">' . $i . '</a>';
                }
                
                if ($endPage < $totalPages) {
                    if ($endPage < $totalPages - 1) echo '<span class="px-2 md:px-3 py-1.5 text-gray-500">...</span>';
                    $lastUrl = buildPaginationUrl($filters, $totalPages);
                    echo '<a href="' . $lastUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm bg-gray-200 text-gray-700 hover:bg-purple-100 transition-colors">' . $totalPages . '</a>';
                }
                
                if ($page < $totalPages) {
                    $nextUrl = buildPaginationUrl($filters, $page + 1);
                    echo '<a href="' . $nextUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm bg-gray-200 text-gray-700 hover:bg-purple-100 transition-colors">Next &raquo;</a>';
                }
                
                echo '</div>';
            }
            
        } else {
            echo '<div class="text-center py-12 bg-gray-50 rounded-xl">
                    <h3 class="text-lg md:text-xl font-semibold text-gray-700 mb-2">No articles found</h3>
                    <p class="text-sm md:text-base text-gray-500">Try adjusting your search filters.</p>
                  </div>';
        }
        
    } catch (Exception $e) {
        error_log("Error in renderIssues: " . $e->getMessage());
        echo '<div class="text-center py-12 bg-red-50 rounded-xl">
                <h3 class="text-lg md:text-xl font-semibold text-red-700 mb-2">Error loading articles</h3>
                <p class="text-sm md:text-base text-red-500">Please try again later.</p>
              </div>';
    }
}

function buildPaginationUrl($filters, $page) {
    $params = [];
    if (!empty($filters['search'])) $params['k'] = urlencode($filters['search']);
    if (!empty($filters['author'])) $params['author'] = urlencode($filters['author']);
    if (!empty($filters['type'])) $params['type'] = urlencode($filters['type']);
    $params['page'] = $page;
    return '?' . http_build_query($params);
}

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
        $authorsMap[$row['article_id']][] = $row['authors_fullname'];
    }
    return $authorsMap;
}

if (basename($_SERVER['PHP_SELF']) == 'renderIssues.php') {
    $filters = [
        'search' => isset($_GET['k']) ? trim($_GET['k']) : null,
        'author' => isset($_GET['author']) ? trim($_GET['author']) : null,
        'type' => isset($_GET['type']) ? trim($_GET['type']) : null
    ];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    renderIssues($con, $page, $filters);
}

ob_end_flush();
?>