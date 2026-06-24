<?php
/**
 * Render Special Issues Component
 * Filters articles where is_special_issue = 'yes' OR article_type = 'Special Issue' (case-insensitive)
 * Supports grouping by special_issue_id when no specific issue is selected
 */

ob_start();

header("Cache-Control: public, max-age=3600"); 
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 3600) . " GMT");
include __DIR__."/helpers.php";

function renderArticleSI($row, $authorsName) {
    $coverImage = getCoverImage($row);
    $formattedDate = formatTimestamp(!empty($row['date_published']) ? $row['date_published'] : $row['date_uploaded']);
    
    $specialIssuesBadge = '<span class="special-issues-badge inline-flex items-center gap-1 text-[11px] md:text-sm text-purple-700 bg-purple-50 px-1.5 md:px-2 py-0.5 rounded-full whitespace-nowrap">
        <svg width="14" height="14" class="md:w-4 md:h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Special Issue
    </span>';
    
    $editorsChoiceBadge = ($row['is_editors_choice'] === "yes") 
        ? '<span class="editchoice inline-flex items-center gap-1 text-[11px] md:text-sm text-blue-700 bg-blue-50 px-1.5 md:px-2 py-0.5 rounded-full whitespace-nowrap"><svg width="14" height="14" class="md:w-4 md:h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19.965 8.521C19.988 8.347 20 8.173 20 8c0-2.379-2.143-4.288-4.521-3.965C14.786 2.802 13.466 2 12 2s-2.786.802-3.479 2.035C6.138 3.712 4 5.621 4 8c0 .173.012.347.035.521C2.802 9.215 2 10.535 2 12s.802 2.785 2.035 3.479A3.976 3.976 0 0 0 4 16c0 2.379 2.138 4.283 4.521 3.965C9.214 21.198 10.534 22 12 22s2.786-.802 3.479-2.035C17.857 20.283 20 18.379 20 16c0-.173-.012-.347-.035-.521C21.198 14.785 22 13.465 22 12s-.802-2.785-2.035-3.479z" fill="#4d91f7"/></svg> Editor\'s Choice</span>'
        : "";
    
    $openAccessBadge = ($row['is_open_access'] === "yes")
        ? '<span class="openaccess inline-flex items-center gap-1 text-[11px] md:text-sm text-green-700 bg-green-50 px-1.5 md:px-2 py-0.5 rounded-full whitespace-nowrap"><img src="../images/20181007070735!Open_Access_logo_PLoS_white.svg" style="width:14px;" alt=""> Open Access</span>'
        : "";
    
    $articleType = htmlspecialchars($row['article_type']);
    $buffer = htmlspecialchars($row['buffer']);
    $title = htmlspecialchars($row['manuscript_full_title']);
    $viewsCount = (int)$row['views_count'];
    $downloadsCount = (int)$row['downloads_count'];
    $manuscriptFileURL = getManuscriptURL($row);
    
    return '
    <div class="w-full bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 mb-6">
        <div class="relative h-56 md:h-72 w-full overflow-hidden bg-gray-100">
            <img src="' . $coverImage . '" alt="' . $title . '" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
            <div class="absolute top-3 left-3 flex gap-1">
                ' . $specialIssuesBadge . '
            </div>
            <div class="absolute top-3 right-3 flex gap-1">
                ' . $openAccessBadge . '
                ' . $editorsChoiceBadge . '
            </div>
        </div>
        
        <div class="p-4 md:p-6">
            <a href="/content?sid=' . $buffer . '" class="hover:text-purple-600 transition-colors">
                <h3 class="text-base md:text-2xl font-semibold text-gray-900 mb-2 md:mb-3 line-clamp-2 leading-tight">' . $title . '</h3>
            </a>
            
            <div class="mb-3 md:mb-4">
                <p class="text-xs md:text-base text-gray-600 line-clamp-2">by ' . htmlspecialchars($authorsName) . '</p>
            </div>
            
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
            
            <div class="flex flex-wrap items-center gap-2">
                <a href="/content?sid=' . $buffer . '#abstract" class="px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-purple-100 text-purple-600 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Abstract
                </a>
                <a href="/content?sid=' . $buffer . '#fulltext" class="px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-purple-100 text-purple-600 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Full Text
                </a>
                <a href="' . $manuscriptFileURL . '" target="_blank" class="downloadLink px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-purple-100 text-purple-600 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    PDF
                </a>
                <button class="shareButton px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-purple-100 text-purple-600 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium cursor-pointer" 
                        data-id="' . htmlspecialchars($buffer, ENT_QUOTES) . '" 
                        data-title="' . htmlspecialchars($title, ENT_QUOTES) . '">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684z"></path></svg>
                    Share
                </button>
            </div>
        </div>
    </div>';
}

function renderSpecialIssues($con, $page = 1, $filters = [], $selectedSpecialIssueId = null, $specialIssues = []) {
    $items_per_page = 6;
    $offset = ($page - 1) * $items_per_page;
    $totalPages = 0;
    
    $whereClauses = ["id IS NOT NULL"];
    $params = [];
    $types = "";
    
    if (!empty($selectedSpecialIssueId)) {
        $whereClauses[] = "`journals`.`special_issue_id` = ?";
        $params[] = $selectedSpecialIssueId;
        $types .= "s";
    } else {
        $whereClauses[] = "(`journals`.`is_special_issue` = 'yes' OR UPPER(`journals`.`article_type`) = 'SPECIAL ISSUE' OR `journals`.`special_issue_id` IS NOT NULL)";
    }
    
    if (!empty($filters['search'])) {
        $whereClauses[] = "(LOWER(`journals`.`manuscript_full_title`) LIKE CONCAT('%', LOWER(?), '%') 
                           OR LOWER(`journals`.`manuscript_running_title`) LIKE CONCAT('%', LOWER(?), '%'))";
        $params[] = $filters['search'];
        $params[] = $filters['search'];
        $types .= "ss";
    }
    
    if (!empty($filters['author'])) {
        $whereClauses[] = "`authors`.`authors_fullname` = ?";
        $params[] = $filters['author'];
        $types .= "s";
    }
    
    $whereSQL = implode(" AND ", $whereClauses);
    
    $hasAuthorFilter = !empty($filters['author']);
    $authorJoin = $hasAuthorFilter ? " INNER JOIN `authors` ON `journals`.`buffer` = `authors`.`article_id`" : "";
    
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
        
        $mainSQL = "SELECT DISTINCT `journals`.*, `special_issues`.`special_issue_name` AS `si_name`
                    FROM `journals` 
                    LEFT JOIN `special_issues` ON `journals`.`special_issue_id` = `special_issues`.`special_issue_id`
                    $authorJoin 
                    WHERE $whereSQL 
                    ORDER BY `journals`.`special_issue_id` ASC, `journals`.`id` DESC 
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
            
            $authorsMap = getAuthorsBatchSI($con, $articleIds);
            
            if (!empty($selectedSpecialIssueId)) {
                $siName = $specialIssues[$selectedSpecialIssueId] ?? 'Special Issue';
                echo '<div class="mb-6">';
                echo '<h3 class="text-xl font-bold text-purple-800 mb-4 flex items-center gap-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        ' . htmlspecialchars($siName) . '
                      </h3>';
                echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
                foreach ($articles as $row) {
                    $articleId = $row['buffer'];
                    $authorsName = isset($authorsMap[$articleId]) 
                        ? implode(", ", $authorsMap[$articleId]) 
                        : "Research Team";
                    echo renderArticleSI($row, $authorsName);
                }
                echo '</div></div>';
            } else {
                $lastSI = null;
                $groupOutput = '';
                foreach ($articles as $row) {
                    $siId = $row['special_issue_id'];
                    $siName = $row['si_name'] ?? '';
                    
                    if ($siId !== $lastSI) {
                        if ($groupOutput) {
                            echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">' . $groupOutput . '</div></div>';
                            $groupOutput = '';
                        }
                        echo '<div class="mb-6">';
                        if ($siId) {
                            echo '<h3 class="text-xl font-bold text-purple-800 mb-4 flex items-center gap-2">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    ' . htmlspecialchars($siName) . '
                                  </h3>';
                        } else {
                            echo '<h3 class="text-xl font-bold text-gray-700 mb-4 flex items-center gap-2 border-b pb-2">Other Special Issues</h3>';
                        }
                        $lastSI = $siId;
                    }
                    
                    $articleId = $row['buffer'];
                    $authorsName = isset($authorsMap[$articleId]) 
                        ? implode(", ", $authorsMap[$articleId]) 
                        : "Research Team";
                    
                    $groupOutput .= renderArticleSI($row, $authorsName);
                }
                if ($groupOutput) {
                    echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">' . $groupOutput . '</div></div>';
                }
            }
            
            if ($totalPages > 1) {
                echo '<div class="flex justify-center gap-2 mt-8 flex-wrap">';
                
                if ($page > 1) {
                    $prevUrl = buildPaginationUrlSI($filters, $page - 1, $selectedSpecialIssueId);
                    echo '<a href="' . $prevUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm bg-gray-200 text-gray-700 hover:bg-purple-100 transition-colors">&laquo; Prev</a>';
                }
                
                $startPage = max(1, $page - 2);
                $endPage = min($totalPages, $page + 2);
                
                if ($startPage > 1) {
                    $firstUrl = buildPaginationUrlSI($filters, 1, $selectedSpecialIssueId);
                    echo '<a href="' . $firstUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm bg-gray-200 text-gray-700 hover:bg-purple-100 transition-colors">1</a>';
                    if ($startPage > 2) echo '<span class="px-2 md:px-3 py-1.5 text-gray-500">...</span>';
                }
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $activeClass = ($i == $page) ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-purple-100';
                    $pageUrl = buildPaginationUrlSI($filters, $i, $selectedSpecialIssueId);
                    echo '<a href="' . $pageUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm ' . $activeClass . ' transition-colors">' . $i . '</a>';
                }
                
                if ($endPage < $totalPages) {
                    if ($endPage < $totalPages - 1) echo '<span class="px-2 md:px-3 py-1.5 text-gray-500">...</span>';
                    $lastUrl = buildPaginationUrlSI($filters, $totalPages, $selectedSpecialIssueId);
                    echo '<a href="' . $lastUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm bg-gray-200 text-gray-700 hover:bg-purple-100 transition-colors">' . $totalPages . '</a>';
                }
                
                if ($page < $totalPages) {
                    $nextUrl = buildPaginationUrlSI($filters, $page + 1, $selectedSpecialIssueId);
                    echo '<a href="' . $nextUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm bg-gray-200 text-gray-700 hover:bg-purple-100 transition-colors">Next &raquo;</a>';
                }
                
                echo '</div>';
            }
            
        } else {
            echo '<div class="text-center py-12 bg-gray-50 rounded-xl">
                    <h3 class="text-lg md:text-xl font-semibold text-gray-700 mb-2">No Special Issues articles found</h3>
                    <p class="text-sm md:text-base text-gray-500">Check back soon for special issue content.</p>
                  </div>';
        }
        
    } catch (Exception $e) {
        error_log("Error in renderSpecialIssues: " . $e->getMessage());
        echo '<div class="text-center py-12 bg-red-50 rounded-xl">
                <h3 class="text-lg md:text-xl font-semibold text-red-700 mb-2">Error loading articles</h3>
                <p class="text-sm md:text-base text-red-500">Please try again later.</p>
              </div>';
    }
}

function buildPaginationUrlSI($filters, $page, $selectedSpecialIssueId = null) {
    $params = [];
    if (!empty($filters['search'])) $params['k'] = urlencode($filters['search']);
    if (!empty($filters['author'])) $params['author'] = urlencode($filters['author']);
    if (!empty($selectedSpecialIssueId)) $params['si'] = urlencode($selectedSpecialIssueId);
    $params['page'] = $page;
    return '?' . http_build_query($params);
}

function getAuthorsBatchSI($con, $articleIds) {
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

if (basename($_SERVER['PHP_SELF']) == 'renderSpecialIssues.php') {
    $filters = [
        'search' => isset($_GET['k']) ? trim($_GET['k']) : null,
        'author' => isset($_GET['author']) ? trim($_GET['author']) : null
    ];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $selectedSpecialIssueId = isset($_GET['si']) ? trim($_GET['si']) : null;
    
    $specialIssues = [];
    if ($selectedSpecialIssueId) {
        $stmt = $con->prepare("SELECT special_issue_id, special_issue_name FROM special_issues");
        $stmt->execute();
        $res = $stmt->get_result();
        while ($r = $res->fetch_assoc()) {
            $specialIssues[$r['special_issue_id']] = $r['special_issue_name'];
        }
    }
    
    renderSpecialIssues($con, $page, $filters, $selectedSpecialIssueId, $specialIssues);
}

ob_end_flush();
?>
