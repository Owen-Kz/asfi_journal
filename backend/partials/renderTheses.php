<?php
/**
 * Render Career Corner Component
 * Filters articles where article_type = 'Career Corner'
 */

// Enable output buffering for better performance
ob_start();

// Set caching headers for better performance
header("Cache-Control: public, max-age=3600"); 
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 3600) . " GMT");
include __DIR__."/helpers.php";



// Function to render a single article
function renderArticleLC($row, $authorsName) {
    $coverImage = getCoverImage($row);
    $formattedDate = formatTimestamp(!empty($row['date_published']) ? $row['date_published'] : $row['date_uploaded']);
    
    // Theses Badge (distinct color)
    // $thesesBadge = '<span class="theses-badge inline-flex items-center gap-1 text-[11px] md:text-sm text-purple-700 bg-purple-50 px-1.5 md:px-2 py-0.5 rounded-full whitespace-nowrap">
    //     <svg width="14" height="14" class="md:w-4 md:h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    //         <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    //     </svg>
    //     Career Corner
    // </span>';
    
    // Original badge icons
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
    // $manuscriptFile = htmlspecialchars($row['manuscript_file']);
    $viewsCount = (int)$row['views_count'];
    $downloadsCount = (int)$row['downloads_count'];
    $doi = htmlspecialchars($row['doi_number']);
    $manuscriptFileURL = getManuscriptURL($row);

    
    return '
    <div class="w-full bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 mb-6">
        <!-- Cover Image -->
        <div class="relative h-56 md:h-72 w-full overflow-hidden bg-gray-100">
            <img src="' . $coverImage . '" alt="' . $title . '" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
            <div class="absolute top-3 left-3 flex gap-1">
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
            <a href="/content?sid=' . $buffer . '" class="hover:text-orange-600 transition-colors">
                <h3 class="text-base md:text-2xl font-semibold text-gray-900 mb-2 md:mb-3 line-clamp-2 leading-tight">' . $title . '</h3>
            </a>
            
            <!-- Authors -->
            <div class="mb-3 md:mb-4">
                <p class="text-xs md:text-base text-gray-600 line-clamp-2">by ' . htmlspecialchars($authorsName) . '</p>
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
                <a href="/content?sid=' . $buffer . '#abstract" class="px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-orange-100 text-orange-600 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Abstract
                </a>
                <a href="/content?sid=' . $buffer . '#fulltext" class="px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-orange-100 text-orange-600 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Full Text
                </a>
                <a href="' . $manuscriptFileURL . '" target="_blank" class="downloadLink px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-orange-100 text-orange-600 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    PDF
                </a>
          
                <button class="shareButton px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-orange-100 text-orange-600 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium cursor-pointer" 
                        data-id="' . htmlspecialchars($buffer, ENT_QUOTES) . '" 
                        data-title="' . htmlspecialchars($title, ENT_QUOTES) . '">
                    <svg class="w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684z"></path></svg>
                    Share
                </button>
                <button class="citationButton px-2 md:px-4 py-1 md:py-2 bg-gray-100 hover:bg-amber-100 text-amber-600 rounded-lg transition-colors flex items-center gap-1 text-[10px] md:text-sm font-medium cursor-pointer" 
                        data-doi="' . $doi . '">
                    <svg class="citation-icon w-2.5 h-2.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <svg class="citation-spinner w-2.5 h-2.5 md:w-4 md:h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" stroke-dasharray="31.4 31.4" stroke-linecap="round"></circle></svg>
                    <span class="citation-count">0</span> Citations
                </button>
            </div>
        </div>
    </div>';
}

function renderTheses($con, $page = 1, $filters = []) {
    $items_per_page = 6;
    $offset = ($page - 1) * $items_per_page;
    $totalPages = 0;
    
    // Build WHERE clause - ONLY articles with article_type = 'Career Corner'
    $whereClauses = ["`journals`.`is_publication` = 'yes'", "`journals`.`article_type` = 'ASFIRJ THESES'"];
    $params = [];
    $types = "";
    
    // Search by title (optional filter)
    if (!empty($filters['search'])) {
        $whereClauses[] = "(LOWER(`journals`.`manuscript_full_title`) LIKE CONCAT('%', LOWER(?), '%') 
                           OR LOWER(`journals`.`manuscript_running_title`) LIKE CONCAT('%', LOWER(?), '%'))";
        $params[] = $filters['search'];
        $params[] = $filters['search'];
        $types .= "ss";
    }
    
    // Filter by author (optional)
    if (!empty($filters['author'])) {
        $whereClauses[] = "`authors`.`authors_fullname` = ?";
        $params[] = $filters['author'];
        $types .= "s";
    }
    
    $whereSQL = implode(" AND ", $whereClauses);
    
    // Handle author join if needed
    $hasAuthorFilter = !empty($filters['author']);
    $authorJoin = $hasAuthorFilter ? " INNER JOIN `authors` ON `journals`.`buffer` = `authors`.`article_id`" : "";
    
    try {
        // Count total matching articles
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
            
            $authorsMap = getAuthorsBatchLC($con, $articleIds);
            
            foreach ($articles as $row) {
                $articleId = $row['buffer'];
                $authorsName = isset($authorsMap[$articleId]) 
                    ? implode(", ", $authorsMap[$articleId]) 
                    : "Research Team";
                
                echo renderArticleLC($row, $authorsName);
            }
            
            // Pagination
            if ($totalPages > 1) {
                echo '<div class="flex justify-center gap-2 mt-8 flex-wrap">';
                
                if ($page > 1) {
                    $prevUrl = buildPaginationUrlLC($filters, $page - 1);
                    echo '<a href="' . $prevUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm bg-gray-200 text-gray-700 hover:bg-orange-100 transition-colors">&laquo; Prev</a>';
                }
                
                $startPage = max(1, $page - 2);
                $endPage = min($totalPages, $page + 2);
                
                if ($startPage > 1) {
                    $firstUrl = buildPaginationUrlLC($filters, 1);
                    echo '<a href="' . $firstUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm bg-gray-200 text-gray-700 hover:bg-orange-100 transition-colors">1</a>';
                    if ($startPage > 2) echo '<span class="px-2 md:px-3 py-1.5 text-gray-500">...</span>';
                }
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $activeClass = ($i == $page) ? 'bg-orange-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-orange-100';
                    $pageUrl = buildPaginationUrlLC($filters, $i);
                    echo '<a href="' . $pageUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm ' . $activeClass . ' transition-colors">' . $i . '</a>';
                }
                
                if ($endPage < $totalPages) {
                    if ($endPage < $totalPages - 1) echo '<span class="px-2 md:px-3 py-1.5 text-gray-500">...</span>';
                    $lastUrl = buildPaginationUrlLC($filters, $totalPages);
                    echo '<a href="' . $lastUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm bg-gray-200 text-gray-700 hover:bg-orange-100 transition-colors">' . $totalPages . '</a>';
                }
                
                if ($page < $totalPages) {
                    $nextUrl = buildPaginationUrlLC($filters, $page + 1);
                    echo '<a href="' . $nextUrl . '" class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-[10px] md:text-sm bg-gray-200 text-gray-700 hover:bg-orange-100 transition-colors">Next &raquo;</a>';
                }
                
                echo '</div>';
            }
            
        } else {
            echo '<div class="text-center py-12 bg-gray-50 rounded-xl">
                    <h3 class="text-lg md:text-xl font-semibold text-gray-700 mb-2">No theses found</h3>
                    <p class="text-sm md:text-base text-gray-500">Check back soon for new theses.</p>
                  </div>';
        }
        
    } catch (Exception $e) {
        error_log("Error in renderTheses: " . $e->getMessage());
        echo '<div class="text-center py-12 bg-red-50 rounded-xl">
                <h3 class="text-lg md:text-xl font-semibold text-red-700 mb-2">Error loading articles</h3>
                <p class="text-sm md:text-base text-red-500">Please try again later.</p>
              </div>';
    }
}

function buildPaginationUrlLC($filters, $page) {
    $params = [];
    if (!empty($filters['search'])) $params['k'] = urlencode($filters['search']);
    if (!empty($filters['author'])) $params['author'] = urlencode($filters['author']);
    $params['page'] = $page;
    return '?' . http_build_query($params);
}

function getAuthorsBatchLC($con, $articleIds) {
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

// If called directly, render Career Corner with GET parameters
if (basename($_SERVER['PHP_SELF']) == 'renderTheses.php') {
    $filters = [
        'search' => isset($_GET['k']) ? trim($_GET['k']) : null,
        'author' => isset($_GET['author']) ? trim($_GET['author']) : null
    ];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    renderTheses($con, $page, $filters);
}

ob_end_flush(); ?>
<!-- Citation List Modal -->
<div id="citationModal" class="citation-modal-overlay" style="display:none;">
  <div class="citation-modal-content">
    <div class="citation-modal-header">
      <h3>Citing Articles</h3>
      <button class="citation-modal-close">&times;</button>
    </div>
    <div class="citation-modal-body">
      <div class="citation-modal-info"></div>
      <div class="citation-modal-list"></div>
    </div>
  </div>
</div>

<style>
.citation-modal-overlay {
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10000;
  padding: 1rem;
}
.citation-modal-content {
  background: white;
  border-radius: 12px;
  max-width: 600px;
  width: 100%;
  max-height: 80vh;
  overflow-y: auto;
  box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}
.citation-modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 1.5rem;
  border-bottom: 1px solid #e5e7eb;
  position: sticky;
  top: 0;
  background: white;
  border-radius: 12px 12px 0 0;
}
.citation-modal-header h3 {
  font-size: 1.125rem;
  font-weight: 600;
  color: #111827;
  margin: 0;
}
.citation-modal-close {
  background: none;
  border: none;
  font-size: 1.5rem;
  color: #9ca3af;
  cursor: pointer;
  padding: 0 0.25rem;
  line-height: 1;
}
.citation-modal-close:hover { color: #6b7280; }
.citation-modal-body { padding: 1.5rem; }
.citation-modal-info {
  background: #f9fafb;
  border-radius: 8px;
  padding: 1rem;
  margin-bottom: 1rem;
}
.citation-modal-info .article-title {
  font-weight: 500;
  color: #374151;
  margin-bottom: 0.25rem;
}
.citation-modal-info .article-meta {
  font-size: 0.875rem;
  color: #6b7280;
}
.citation-modal-info .cited-by {
  font-size: 0.875rem;
  color: #d97706;
  font-weight: 600;
}
.citation-item {
  background: #f9fafb;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  padding: 0.75rem 1rem;
  margin-bottom: 0.75rem;
}
.citation-item:last-child { margin-bottom: 0; }
.citation-item-number {
  width: 1.5rem;
  height: 1.5rem;
  background: #fef3c7;
  color: #d97706;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
  font-weight: 700;
  flex-shrink: 0;
}
.citation-item-content { flex: 1; min-width: 0; }
.citation-doi-link {
  color: #2563eb;
  text-decoration: none;
  font-size: 0.875rem;
  word-break: break-all;
}
.citation-doi-link:hover { text-decoration: underline; }
.citation-doi-label {
  font-size: 0.75rem;
  font-weight: 500;
  color: #6b7280;
}
.citation-meta {
  font-size: 0.75rem;
  color: #6b7280;
}
.self-citation-badge {
  display: inline-flex;
  align-items: center;
  padding: 0.125rem 0.5rem;
  background: #fef3c7;
  color: #a16207;
  font-size: 0.7rem;
  font-weight: 500;
  border-radius: 9999px;
  margin-top: 0.25rem;
}
.no-doi-message {
  text-align: center;
  padding: 2rem;
  color: #9ca3af;
}
.no-doi-message p:first-child {
  font-weight: 500;
  color: #6b7280;
  margin-bottom: 0.5rem;
}
.citation-spinner { animation: cit-spin .8s linear infinite; display: none; }
.citationButton.is-loading .citation-icon { display: none; }
.citationButton.is-loading .citation-spinner { display: inline-block; }
@keyframes cit-spin { to { transform: rotate(360deg); } }
</style>
<script>
document.addEventListener('DOMContentLoaded', function(){
    var closeBtn = document.querySelector('.citation-modal-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', function(){
            var modal = document.getElementById('citationModal');
            if (modal) modal.style.display = 'none';
        });
    }
    var modalOverlay = document.getElementById('citationModal');
    if (modalOverlay) {
        modalOverlay.addEventListener('click', function(e){
            if(e.target === this) this.style.display = 'none';
        });
    }
    document.querySelectorAll('.citationButton').forEach(function(btn){
        var doi = btn.getAttribute('data-doi');
        if(!doi || doi === '') return;
        btn.classList.add('is-loading');
        var countSpan = btn.querySelector('.citation-count');
        fetch('https://process.asfirj.org/journal/public/fetch-citations', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({doi_number: doi})
        })
        .then(function(r){ return r.json(); })
        .then(function(data){
            var count = (data && data.data && data.data.total_citations) ? data.data.total_citations : 0;
            countSpan.textContent = count;
            btn.classList.remove('is-loading');
        })
        .catch(function(){
            countSpan.textContent = '0';
            btn.classList.remove('is-loading');
        });
        btn.addEventListener('click', function(e){
            e.preventDefault();
            var modal = document.getElementById('citationModal');
            if (!modal) return;
            var infoDiv = modal.querySelector('.citation-modal-info');
            var listDiv = modal.querySelector('.citation-modal-list');
            var articleEl = this.closest('.w-full');
            var titleEl = articleEl ? articleEl.querySelector('h3') : null;
            var title = titleEl ? titleEl.textContent.trim() : '';
            
            if(!doi || doi === '') {
                infoDiv.innerHTML = '<p class="article-title">' + title + '</p><p class="article-meta">No DOI assigned</p>';
                listDiv.innerHTML = '<div class="no-doi-message"><p>No DOI assigned</p><p>This article does not have a DOI number, so citation tracking is unavailable.</p></div>';
                modal.style.display = 'flex';
                return;
            }
            
            infoDiv.innerHTML = '<p class="article-title">' + title + '</p><p class="article-meta">DOI: ' + doi + '</p><p class="cited-by">Fetching citation data...</p>';
            listDiv.innerHTML = '<div style="text-align:center;padding:2rem;"><div class="citation-spinner" style="display:inline-block;width:24px;height:24px;border-width:3px;border-color:#d97706;border-top-color:transparent;"></div></div>';
            modal.style.display = 'flex';
            
            fetch('https://process.asfirj.org/journal/public/fetch-citations', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({doi_number: doi})
            })
            .then(function(r){ return r.json(); })
            .then(function(data){
                if(data.success && data.data) {
                    var total = data.data.total_citations || 0;
                    var citations = data.data.citations || [];
                    infoDiv.innerHTML = '<p class="article-title">' + title + '</p><p class="article-meta">DOI: ' + doi + '</p><p class="cited-by">Cited by ' + total + ' ' + (total === 1 ? 'article' : 'articles') + '</p>';
                    
                    if(citations.length === 0) {
                        listDiv.innerHTML = '<div style="text-align:center;padding:2rem;color:#9ca3af;"><p>No citation details available</p></div>';
                    } else {
                        var html = '';
                        citations.forEach(function(cit, i){
                            html += '<div class="citation-item"><div style="display:flex;align-items:flex-start;gap:0.75rem;">';
                            html += '<span class="citation-item-number">' + (i + 1) + '</span>';
                            html += '<div class="citation-item-content">';
                            if(cit.citing_doi) {
                                html += '<div><span class="citation-doi-label">Citing DOI:</span> <a href="https://doi.org/' + encodeURIComponent(cit.citing_doi) + '" target="_blank" class="citation-doi-link" rel="noopener">' + cit.citing_doi + '</a></div>';
                            }
                            if(cit.publication_date) {
                                html += '<div class="citation-meta"><span style="font-weight:500;">Date:</span> ' + cit.publication_date + '</div>';
                            }
                            if(cit.timespan) {
                                html += '<div class="citation-meta"><span style="font-weight:500;">Timespan:</span> ' + cit.timespan + '</div>';
                            }
                            if(cit.journal_self_citation === 'true') {
                                html += '<span class="self-citation-badge">Journal Self-Citation</span>';
                            }
                            html += '</div></div></div>';
                        });
                        listDiv.innerHTML = html;
                    }
                } else {
                    listDiv.innerHTML = '<div style="text-align:center;padding:2rem;color:#9ca3af;"><p>Failed to load citation data</p></div>';
                }
            })
            .catch(function(){
                listDiv.innerHTML = '<div style="text-align:center;padding:2rem;color:#9ca3af;"><p>Failed to load citation data</p></div>';
            });
        });
    });
});
</script>